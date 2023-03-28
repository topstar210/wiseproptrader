<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Admin_setting;

/**
 * Class GlobalComposer.
 */
class GlobalComposer {
  /**
   * Bind data to the view.
   *
   * @param View $view
   */
  public function compose(View $view) {
    $app_settings = [];

    $AppSettings = Admin_setting::where('name', 'AppSettings')->first();
    if ($AppSettings) {
      $app_settings['maintenance_switch'] = $AppSettings->value1 ?? '';
      $app_settings['maintenance_message'] = $AppSettings->value2 ?? '';
      $app_settings['app_title'] = $AppSettings->value3 ?? '';
      $app_settings['app_description'] = $AppSettings->value4 ?? '';
      $app_settings['logo_path'] = $AppSettings->value5 ?? '';
    }

    $PageSettings = Admin_setting::where('name', 'PageSettings')->first();
    if ($PageSettings) {
        $app_settings['contact_email'] = $PageSettings->value1 ?? '';
        $app_settings['contact_phone'] = $PageSettings->value2 ?? '';
        $app_settings['contact_address'] = $PageSettings->value3 ?? '';
        $app_settings['contact_license'] = $PageSettings->value4 ?? '';
    }

    $view->with('app_settings', $app_settings);
  }
}
