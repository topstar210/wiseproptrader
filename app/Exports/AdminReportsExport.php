<?php

namespace App\Exports;

use App\Deposit_history;
use App\Withdraw;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AdminReportsExport implements FromQuery, WithHeadings, WithMapping {

  use Exportable;

  public function __construct($request) {
    $this->request = $request;
  }

  public function headings(): array
  {
    return [
      'User Id',
      'Client Name',
      'Manager Name',
      'Amount',
      'Payment Gateway',
      'Created Date',
    ];
  }

  public function map($query): array
  {
    return [
      $query->user_id,
      $query->client_name,
      $query->manager_name,
      $query->amount,
      $query->mode,
      Date::dateTimeToExcel($query->created_at),
    ];
  }

  public function columnFormats(): array
  {
    return [
      'A' => NumberFormat::FORMAT_NUMBER,
      'D' => NumberFormat::FORMAT_NUMBER_00,
      // 'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
      'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
    ];
  }

  public function query() {

    $filter_manager_id = (int) $this->request->get('manager', 0);
    $filter_client_name = $this->request->get('client_name', '');
    $filter_date_from = $this->request->get('date_from', '');
    $filter_date_to = $this->request->get('date_to', '');
    $filter_deposit_type = $this->request->get('deposit_type', 'deposit');

    if ($filter_date_from != '' || $filter_date_to != '') {
      $validator = \Validator::make($this->request->all(), [
        'date_from' => 'required|date_format:d/m/Y',
        'date_to' => 'required|date_format:d/m/Y|after_or_equal:date_from',
      ]);
      if ($validator->fails()) {
        return redirect($this->request->path())->withErrors($validator);
      }
      $filter_date_from = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_from))) . ' 00:00:01';
      $filter_date_to = date('Y-m-d', strtotime(str_replace('/', '-', $filter_date_to))) . ' 23:59:59';
    }

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

    }

    return $query;

  }
}