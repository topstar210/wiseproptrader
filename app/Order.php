<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JamesMills\LaravelTimezone\Timezone;
use Carbon\Carbon;

class Order extends Model {
  //

  // public function getOpenTimeAttribute($value) {
  //   return Timezone::convertToLocal(Carbon::parse($value));
  // }

  // public function getCloseTimeAttribute($value) {
  //   return Timezone::convertToLocal(Carbon::parse($value));
  // }

  // public function getCreatedAtAttribute($value) {
  //   return Timezone::convertToLocal(Carbon::parse($value));
  // }

  // public function getUpdatedAtAttribute($value) {
  //   return Timezone::convertToLocal(Carbon::parse($value));
  // }
}
