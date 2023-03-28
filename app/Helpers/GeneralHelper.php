<?php

if (!function_exists('handle_query_string')) {
  function handle_query_string($add_query, array $existing_query) {
    if (!empty($existing_query)) {
      //   parse_str($existing_query, $existing_query_arr);
      parse_str($add_query, $add_query_arr);
      return '?' . http_build_query(array_merge($existing_query, $add_query_arr));
    } else {
      return '?' . $add_query;
    }
  }
}

if (!function_exists('remove_query_string_var')) {
  function remove_query_string_var($key, $existing_query) {
    if (!empty($existing_query)) {
      // parse_str($existing_query, $existing_query_arr);
      unset($existing_query[$key]);
      return (empty($existing_query_arr)) ? '?' : '?' . http_build_query($existing_query_arr);
    } else {
      return '';
    }
  }
}

if (!function_exists('curr_to_symbol')) {
  function curr_to_symbol($currency = 'USD') {
    $curr_symbol = [
      'USD' => '$',
      'GBP' => '£',
      'EUR' => '€',
    ];

    return isset($curr_symbol[$currency]) ? $curr_symbol[$currency] : '$';
  }
}

if (!function_exists('get_exchange_rate_cryptocompare')) {
  function get_exchange_rate_cryptocompare($from = 'BTC', $to = "EUR") {

    $cryptocompare_switch = App\Trade_setting::where('name', 'cryptocompare_switch')->value('value');
    if ($cryptocompare_switch != 'on') return ['status' => 'success', 'rate' => 1];
    $cryptocompare_api_key = App\Trade_setting::where('name', 'cryptocompare_api_key')->value('value');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://min-api.cryptocompare.com/data/price?fsym=$from&tsyms=$to&api_key=$cryptocompare_api_key",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        "Apikey: $cryptocompare_api_key"
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      $response_array['status'] = 'danger';
      $response_array['message'] = "cURL Error #: $err";
      return $response_array;
    } else {
      if (isset($response->Response) && $response->Response == 'Error') {
        $response_array['status'] = 'danger';
        $response_array['message'] = $response->Message;
        return $response_array;
      } else {
        $response_array['status'] = 'success';
        $response_array['rate'] = round($response->$to, 8);
        return $response_array;
      }
    }

  }
}

if (!function_exists('get_exchange_rate_fixerio')) {
  function get_exchange_rate_fixerio($from = 'USD', $to = "EUR") {

    $fixerio_switch = App\Trade_setting::where('name', 'fixerio_switch')->value('value');
    if ($fixerio_switch != 'on') return ['status' => 'success', 'rate' => 1];
    $fixerio_api_key = App\Trade_setting::where('name', 'fixerio_api_key')->value('value');

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://data.fixer.io/api/latest?access_key=$fixerio_api_key&base=$to&symbols=$from&amount=1&format=1",
      CURLOPT_RETURNTRANSFER => true,
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
      $response_array['status'] = 'danger';
      $response_array['message'] = "cURL Error #: $err";
      return $response_array;
    } else {
      if (isset($response->success) && !$response->success) {
        $response_array['status'] = 'danger';
        $response_array['message'] = $response->error->info ?? $response->error->type;
        return $response_array;
      } else {
        $response_array['status'] = 'success';
        $response_array['rate'] = round($response->rates->$from, 8);
        return $response_array;
      }
    }

  }
}