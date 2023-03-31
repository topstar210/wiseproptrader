@extends('layouts.auth_page')

@section('content')
    @include('dashboard.layouts.topbar')

    @include('dashboard.layouts.sidebar', ['pagename' => 'profile'])

    <link rel="stylesheet" href="/css/dashboard/index.css">
    {{-- main --}}
    <div class="container-fluid">
        <div class="container p-5 client-area">
            <div class="pb-5 text-white">Trader / Profile</div>

            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true">Personal Information</a>
                            <a class="nav-item nav-link" id="nav-account-tab" data-toggle="tab" href="#nav-account" role="tab" aria-controls="nav-account" aria-selected="false">Account Information</a>
                            <a class="nav-item nav-link" id="nav-security-tab" data-toggle="tab" href="#nav-security" role="tab" aria-controls="nav-security" aria-selected="false">Security</a>
                            <a class="nav-item nav-link" id="nav-wiseprop-tab" data-toggle="tab" href="#nav-wiseprop" role="tab" aria-controls="nav-wiseprop" aria-selected="false">WiseProp Identity</a>
                        </div>
                    </nav>
                    <div class="tab-content pt-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                            @include('dashboard.profile.personal')
                        </div>
                        <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
                            @include('dashboard.profile.account')
                        </div>
                        <div class="tab-pane fade" id="nav-security" role="tabpanel" aria-labelledby="nav-security-tab">
                            @include('dashboard.profile.security')
                        </div>
                        <div class="tab-pane fade" id="nav-wiseprop" role="tabpanel" aria-labelledby="nav-wiseprop-tab">
                            @include('dashboard.profile.identity')
                        </div>
                    </div>
                </div>
            </div>
            
            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection
