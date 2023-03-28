<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClientStatementExport implements FromQuery, WithHeadings, WithMapping {

  use Exportable;

  public function __construct($request) {
    $this->request = $request;
  }

  public function headings(): array
  {
    return [
      'Ticket',
      'Open Time',
      'Type',
      'Units',
      'Instrument',
      'Open Rate',
      'Market Rate',
      'Profit/Loss',
      'Take/Profit',
      'Stop/Loss',
    ];
  }

  public function map($query): array
  {
    return [
      $query->ticket,
      $query->open_time,
      $query->type,
      $query->trade_amount,
      $query->base_symbol . '/' . $query->quote_symbol,
      $query->open_rate,
      $query->close_rate,
      $query->pro_loss,
      $query->profit,
      $query->loss,
    ];
  }

  public function columnFormats(): array
  {
    return [
      'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      'F' => NumberFormat::FORMAT_NUMBER_00,
      'G' => NumberFormat::FORMAT_NUMBER_00,
      'H' => NumberFormat::FORMAT_NUMBER_00,
      'I' => NumberFormat::FORMAT_NUMBER_00,
      'J' => NumberFormat::FORMAT_NUMBER_00,
      // 'D' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
    ];
  }

  public function query() {

    $user_id = (int) $this->request->user()->id;
    $filter_date_from = $this->request->get('date_from', '');
    $filter_date_to = $this->request->get('date_to', '');

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

    $query_trade_statement = Order::where('orders.status', 'closed')
      ->where('orders.user_id', $user_id)
      ->orderBy('orders.open_time', 'desc');
    if ($filter_date_from != '' || $filter_date_to != '') {
      $query_trade_statement->whereBetween('orders.open_time', array($filter_date_from, $filter_date_to));
    }

    return $query_trade_statement;

  }
}