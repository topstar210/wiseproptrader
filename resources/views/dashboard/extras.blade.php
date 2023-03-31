@extends('layouts.auth_page')

@section('content')
    @include('dashboard.layouts.topbar')

    @include('dashboard.layouts.sidebar', ['pagename' => 'client-area'])

    <link rel="stylesheet" href="/css/dashboard/index.css">
    {{-- main --}}
    <div class="container-fluid">
        <div class="container p-5 client-area">
            {{-- <div class="pb-5 text-white">Trader / Profile</div> --}}

            <h1>coming soon...</h1>


            
            @include('dashboard.layouts.footer')
        </div>
    </div>
@endsection
