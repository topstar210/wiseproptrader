@php
    use \App\Admin_setting;
    use \App\User;
    use \App\User_verify_setting;

    use \App\Http\Controllers\Controller;
    use \Illuminate\Http\Request;

    $res = Admin_setting::where('name', 'LogoSetting')->get();
    if (count($res) == 0) {
        $data['logoPath'] = asset('landingAssets/images/logo.jpg');
    } else {
        $logoPath = Admin_setting::where('name', 'LogoSetting')->value('value1');
        $data['logoPath'] = asset('uploads/' . $logoPath);
    }

    $user_id = auth()->user()->id;
    $role = auth()->user()->role;
    $verify_res = User_verify_setting::where('user_id', $user_id)->get();
    if ($role < 5) {
        $verify = true;
    } else if (count($verify_res) == 0) {
        $verify = false;
    } else {
        $res = User_verify_setting::where('user_id', $user_id)->value("verify_approved");
        if ($res == "Approved") {
            $verify = true;
        } else {
            $verify = false;
        }
    }
    if ($role < 5) {
        $is_admin = true;
    } else {
        $is_admin = false;
    }


    $user_name = auth()->user()->name;

@endphp

<header>
    <div class="container-full-width">
        <div class="crypt-header">
            <div class="row">
                <div class="col-md-5 col-xl-6">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="crypt-logo"><img src="{{url('uploads', $app_settings['logo_path']??'')}}" alt="" style="width:188px; height:70px; margin-left: 17px"></div>
                        </div>
                    </div>
                </div>


                <div class="col-md-7 col-xl-6 d-none d-md-block d-lg-block ">
                    <a href="{{ route('profile') }}" class="crypt-box-menu btn btn-success mt-3 mr-1 float-right">Deposit</a>

                    <div class="crypt-mega-dropdown-menu">
                        <a href="" class="crypt-mega-dropdown-toggle " style="display: flex;">
                            <div>
                                <div id="username" style="margin-left: 13px;">{{ mb_strimwidth($user_name, 0, 15, "...") }}</div>
                                <!-- <div id="user_balance"></div> -->
                            </div>
                            <span style="margin-left: 10px;"><i class="dropdown-toggle"></i></span>

                        </a>
                        <div class="crypt-mega-dropdown-menu-block">
                            <div class="crypt-market-status">
                                <div>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active">
                                            <div class="drop-menu-item">
                                                @if(!$verify)
                                                    <li class="list-unstyled mb-3"><button class="btn btn-sm btn-success" onclick="verifyID()">Verify ID</button></li>
                                                @endif
                                                <li><a href="{{ route('home') }}">Dashboard</a></li>
                                                <li><a href="{{ route('dash_client_area') }}">Dashboard-1</a></li>
                                                <li><a href="{{ route('profile') }}">Profile</a></li>
                                                @if($is_admin)
                                                    <li><a href="{{ url('admin') }}">Admin</a></li>
                                                @endif

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <li class="crypt-box-menu"><a href="#" onclick="OnLogOut()">{{ __('Logout') }}</a></li>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <i class="menu-toggle pe-7s-menu d-xs-block d-sm-block d-md-none d-sm-none"></i>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="crypt-mobile-menu">
        <div class="crypt-gross-market-cap" style="display: block">
            <h6>Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="balance_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Profit/Loss&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="pro_loss_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Equity&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="equity_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <h6>Margin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div id="margin_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
            <!-- <h6>Free Margin&nbsp;&nbsp;&nbsp;&nbsp;<div id="free_margin_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6> -->
            <h6>Margin Level&nbsp;&nbsp;&nbsp;<div id="margin_level_mobile" style="display: inline-block;">
                    <p class="crypt-up">0.00</p>
                </div>
            </h6>
        </div>
        <ul class="crypt-heading-menu">
            @if(!$verify)
                <li class="crypt-box-menu btn btn-success"><a href="#" onclick="verifyID()">Verify ID</a></li>
            @endif
            <li><a href="{{ route('home') }}">Dashboard</a></li>
            <li><a href="{{ route('dash_client_area') }}">Dashboard-1</a></li>
            <li><a href="{{ route('profile') }}">Profile</a></li>
            @if($is_admin)
            <li><a href="{{ url('admin') }}">Admin</a></li>
            @endif
            <li class="crypt-box-menu btn btn-danger"><a href="#" onclick="OnLogOut()">{{ __('Logout') }}</a></li>
        </ul>

    </div>
</header>