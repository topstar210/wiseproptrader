<?php

namespace App;

use App\Personal_info;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
use Corcel\Model\User as Corcel;

class User extends Authenticatable {
  use Notifiable,
    Impersonate;

  protected $appends = ['userCurrency'];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'role',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  public function isAdmin() {
    return $this->role === 1;
  }

  public function isManager() {
    return $this->role === 3;
  }

  public function isClient() {
    return $this->role === 5;
  }

  /**
   * Return true or false if the user can impersonate an other user.
   *
   * @param void
   * @return  bool
   */
  public function canImpersonate() {
    return $this->isAdmin() || $this->isManager();
  }

  /**
   * Return true or false if the user can be impersonate.
   *
   * @param void
   * @return  bool
   */
  public function canBeImpersonated() {
    return $this->isClient();
  }

  public function getUserCurrency() {
    $res_profile = Personal_info::where('user_id', $this->id)->first();
    return $res_profile ? $res_profile->userCurrency : 'USD';
  }
  
  public function plan()
  {
      return $this->belongsTo(WpPack::class);
  }

}
