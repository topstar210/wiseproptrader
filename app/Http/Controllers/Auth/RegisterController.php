<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Corcel\WooCommerce\Model\Order as Corcel;
use Corcel\WooCommerce\Model\Item as Item;
use App\Personal_info;
use App\Balance;
use App\WpPack;
use App\Deposit_history;
use App\Manager_user_relation;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $created_user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 5
        ]);
        if (!$created_user) {
            return back()->withInput();
        }

        $person_con = new Personal_info;
        $person_con->user_id = $created_user->id;
        $person_con->phone = $data['phone'];
        $person_con->address = $data['address'];
        $person_con->country = $data['country'];
        $person_con->city = "";
        $person_con->zip = "";
        $person_con->photo = "";
        $person_con->birth = "";
        $person_con->lang = "";
        $person_con->referalCode = $data['referalCode'];
        $person_con->userCurrency = $data['userCurrency'];
        $person_con->save();
        
        

        if (isset($data['referalCode']) && $data['referalCode'] !== '') {
            $manager_id = User::leftJoin('personal_infos', 'personal_infos.user_id', '=', 'users.id')
                ->where('personal_infos.referalCode', $data['referalCode'])
                ->where('users.role', 3)
                ->select('users.id')
                ->first();
            if ($manager_id) {
                $manager_user_con = new Manager_user_relation;
                $manager_user_con->user_id = $created_user->id;
                $manager_user_con->manager_id = $manager_id->id;
                $manager_user_con->save();
            }
        }
        // $wp = Corcel::find($data['orderid']);
        // $wpitem = Item::where('order_id',$data['orderid'])->first();
         $amount = WpPack::where('buy',$data['orderid'])->first();
        // dd($wp);
        $order= new Balance;
        $order->user_id = $created_user->id;
        $order->balance = $amount->amount;
        $order->margin = 0;
        $order->currency = "USD";
        $order->ticket = "";
        $order->mode = "MetaMask Deposit";
        $order->save();
        
        $user = User::find($created_user->id);
        $user->plan_id = $amount->id;
        $user->save();

        return $created_user;
    }
}
