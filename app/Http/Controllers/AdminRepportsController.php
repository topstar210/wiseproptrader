<?php

namespace App\Http\Controllers;

use App\Deposit_history;
use App\Withdraw;
use App\Exports\AdminReportsExport;
use Illuminate\Http\Request;

class AdminRepportsController extends Controller {

  public function withdraw_deposit_repport(Request $request) {

    $per_page = (int) $request->get('per_page', 15);
    $filter_manager_id = (int) $request->get('manager', 0);
    $filter_client_name = $request->get('client_name', '');
    $filter_date_from = $request->get('date_from', '');
    $filter_date_to = $request->get('date_to', '');
    $filter_deposit_type = $request->get('deposit_type', 'deposit');

    if ($filter_date_from != '' || $filter_date_to != '') {
      $validator = \Validator::make($request->all(), [
        'date_from' => 'required|date_format:d/m/Y',
        'date_to' => 'required|date_format:d/m/Y|after_or_equal:date_from',
      ]);
      if ($validator->fails()) {
        return redirect($request->path())->withErrors($validator);
      }
      $filter_date_from = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_from))) . ' 00:00:01';
      $filter_date_to = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_to))) . ' 23:59:59';
    }
    // \DB::enableQueryLog();
    if ($filter_deposit_type == 'withdraw') {
      $query = Withdraw::leftJoin('users as client', 'withdraws.user_id', '=', 'client.id')
      ->leftJoin('manager_user_relations', 'manager_user_relations.user_id', '=', 'client.id')
      ->leftJoin('users as manager', 'manager_user_relations.manager_id', '=', 'manager.id')
      ->where('client.name', 'like', '%' . $filter_client_name . '%');
      if ($filter_manager_id) {
        $query->where('manager.id', $filter_manager_id);
      }
      if ($filter_date_from != '' || $filter_date_to != '') {
        $query->whereBetween('withdraws.created_at', array($filter_date_from, $filter_date_to));
      }
      $query->select('withdraws.user_id', 'client.name as client_name', 'manager.name as manager_name', 'withdraws.amount', 'withdraws.bank as mode', 'withdraws.created_at');
      $records = $query->paginate($per_page);
    } else {
      $query = Deposit_history::leftJoin('users as client', 'deposit_history.user_id', '=', 'client.id')
      ->leftJoin('manager_user_relations', 'manager_user_relations.user_id', '=', 'client.id')
      ->leftJoin('users as manager', 'manager_user_relations.manager_id', '=', 'manager.id')
      ->where('client.name', 'like', '%' . $filter_client_name . '%');
      if ($filter_manager_id) {
        $query->where('manager.id', $filter_manager_id);
      }
      if ($filter_date_from != '' || $filter_date_to != '') {
        $query->whereBetween('deposit_history.created_at', array($filter_date_from, $filter_date_to));
      }
      $query->select('deposit_history.user_id', 'client.name as client_name', 'manager.name as manager_name', 'deposit_history.amount', 'deposit_history.mode', 'deposit_history.created_at');
      $records = $query->paginate($per_page);
    }
    // $querys = \DB::getQueryLog();
    //  dd($querys);

    return view('admin.repports.withdraw-deposit')->with('records', $records);
  }

  public function download_withdraw_deposit_repport(Request $request) {
    return (new AdminReportsExport($request))->download('withdraw_deposit_repport.xlsx');
  }

}
?>