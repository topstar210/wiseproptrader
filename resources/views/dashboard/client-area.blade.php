@extends('layouts.auth_page')

@section('content')
    @include('dashboard.layouts.topbar')

    @include('dashboard.layouts.sidebar', ['pagename' => 'client-area'])

    <link rel="stylesheet" href="/css/dashboard/index.css">
    {{-- main --}}
    <div class="container-fluid">
        <div class="container p-5 client-area">
            <div class="pb-5 text-white">Trader / Client Area</div>

            <div class="row">
                <div class="col-lg-5  offset-lg-3 col-md-12 mb-4">
                    <div class="card h-100 shadow-lg">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <div class="crypt-logo"><img src="{{url('uploads', $app_settings['logo_path']??'')}}" alt="" style="width:188px!important; height:70px!important; margin-left: 17px!important"></div>
                            </div>
                            <div class="text-center p-3">
                                <h5 class="card-title">WiseProp Trader Funding</h5>
                                <small>Trade up to $200,000 WiseProp Trader Account</small>
                                <br><br>
                            </div>
                            <p class="card-text text-center">Show us your trading skills. Pass the Evaluation Course and
                                receive the WiseProp Trader Account!</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                </svg> We provide you with up to $200,000 WiseProp Trader Account
                            </li>
                            <li class="list-group-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                </svg> Prove your trading skills
                            </li>
                            <li class="list-group-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                </svg> Full Account Analysis
                            </li>
                            <li class="list-group-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
                                    <path
                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z" />
                                </svg> Premium Apps
                            </li>
                        </ul>
                        <div class="card-body text-center">
                            <button class="btn btn-outline-primary btn-lg px-3" style="border-radius:30px">Start WiseProp Trader Funding</button>
                        </div>
                    </div>
                </div>
            </div>

            @include('dashboard.layouts.footer')
        </div>
    @endsection
