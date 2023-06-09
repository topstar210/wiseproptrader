<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$app_settings['app_title']??''}}</title>

    <meta name="title" content="{{$app_settings['app_title']??''}}">
    <meta name="description" content="{{$app_settings['app_description']??''}}" />

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('landingAssets/bootstrap/css/bootstrap.min.css')}}?ver={{ filemtime(public_path('landingAssets/bootstrap/css/bootstrap.min.css')) }}">
    @mobile
        <link rel="stylesheet" href="{{asset('landingAssets/css/style-mobile.css')}}?ver={{ filemtime(public_path('landingAssets/css/style-mobile.css')) }}">
    @endmobile
    @tablet
        <link rel="stylesheet" href="{{asset('landingAssets/css/style.css')}}?ver={{ filemtime(public_path('landingAssets/css/style.css')) }}">
    @endtablet
    @desktop
        <link rel="stylesheet" href="{{asset('landingAssets/css/style.css')}}?ver={{ filemtime(public_path('landingAssets/css/style.css')) }}">
    @enddesktop
    <link rel="stylesheet" href="{{asset('landingAssets/css/icons.css')}}?ver={{ filemtime(public_path('landingAssets/css/icons.css')) }}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/ui.css')}}?ver={{ filemtime(public_path('landingAssets/css/ui.css')) }}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/bootstrap-slider.css')}}?ver={{ filemtime(public_path('landingAssets/css/bootstrap-slider.css')) }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <link href="{{ asset('adminTheme/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}?ver={{ filemtime(public_path('adminTheme/assets/global/plugins/font-awesome/css/font-awesome.min.css')) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('adminTheme/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css') }}?ver={{ filemtime(public_path('adminTheme/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css')) }}" rel="stylesheet" type="text/css" />
    <script> const _csrf_token = document.querySelector('meta[name="csrf-token"]').content; </script>
</head>
<body class="crypt-dark">
    @include('admin.layouts.logged-in-as')
    @if (Session::has('message'))
        <div id="showMessage" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px;">
            <button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
                <span aria-hidden="true">×</span><span class="sr-only">Close</span>
            </button>
            {{Session::get('message')}}
        </div>
    @endif

    <div id="showError" class="bootstrap-growl alert alert-info alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px; color:red; font-size: 16px; display:none">
        <button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <div id="errormsg"></div>
    </div>

    <div id="showSuccess" class="alert alert-success alert-dismissible" style="position: fixed; margin: 0px; z-index: 9999; top: 100px; right: 20px; font-size: 16px; display:none">
        <button class="close" data-dismiss="alert" type="button" style="padding: 0.5rem 0.5rem;">
            <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
        <div id="successmsg"></div>
    </div>

        @yield('content')
        <script>window.AuthUser = {!! json_encode(optional(auth()->user())->only('id', 'name', 'email')) !!}</script>
        <script src="{{asset('landingAssets/js/jquery.js')}}?ver={{ filemtime(public_path('landingAssets/js/jquery.js')) }}"></script>
        <script src="{{asset('landingAssets/amc/core.js')}}?ver={{ filemtime(public_path('landingAssets/amc/core.js')) }}"></script>
        <script src="{{asset('landingAssets/amc/charts.js')}}?ver={{ filemtime(public_path('landingAssets/amc/charts.js')) }}"></script>
        <script src="{{asset('landingAssets/amc/dark.js')}}?ver={{ filemtime(public_path('landingAssets/amc/dark.js')) }}"></script>
        <script src="{{asset('landingAssets/amc/animated.js')}}?ver={{ filemtime(public_path('landingAssets/amc/animated.js')) }}"></script>
        <script src="{{asset('landingAssets/js/Chart.min.js')}}?ver={{ filemtime(public_path('landingAssets/js/Chart.min.js')) }}"></script>
        <script src="{{asset('landingAssets/js/popper.min.js')}}?ver={{ filemtime(public_path('landingAssets/js/popper.min.js')) }}"></script>
        <script src="{{asset('landingAssets/bootstrap/js/bootstrap.bundle.min.js')}}?ver={{ filemtime(public_path('landingAssets/bootstrap/js/bootstrap.bundle.min.js')) }}"></script>
        <script src="{{ asset('adminTheme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}?ver={{ filemtime(public_path('adminTheme/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')) }}" type="text/javascript"></script>
        <script src="{{asset('landingAssets/js/main.js')}}?ver={{ filemtime(public_path('landingAssets/js/main.js')) }}"></script>
        <script src="{{asset('landingAssets/js/amc.js')}}?ver={{ filemtime(public_path('landingAssets/js/amc.js')) }}"></script>
        <script src="{{asset('landingAssets/js/chart.js')}}?ver={{ filemtime(public_path('landingAssets/js/chart.js')) }}"></script>
        <script src="https://s3.tradingview.com/tv.js"></script>

        @mobile
            <script src="{{asset('js/forex/showStatusMobile.js')}}?ver={{ filemtime(public_path('js/forex/showStatusMobile.js')) }}"></script>
        @endmobile
        @tablet
            <script src="{{asset('js/forex/showStatus.js')}}?ver={{ filemtime(public_path('js/forex/showStatus.js')) }}"></script>
        @endtablet
        @desktop
            <script src="{{asset('js/forex/showStatus.js')}}?ver={{ filemtime(public_path('js/forex/showStatus.js')) }}"></script>
        @enddesktop

        <script src="{{asset('js/profile.js')}}?ver={{ filemtime(public_path('js/profile.js')) }}"></script>

        {{-- <!-- load Lightstreamer libraries --> --}}
        <script src="{{asset('js/Lightstreamer/require.js')}}?ver={{ filemtime(public_path('js/Lightstreamer/require.js')) }}"></script>
        <script src="{{asset('js/Lightstreamer/beautifier.js')}}?ver={{ filemtime(public_path('js/Lightstreamer/beautifier.js')) }}"></script>
        <script src="{{asset('js/Lightstreamer/lightstreamer.js')}}?ver={{ filemtime(public_path('js/Lightstreamer/lightstreamer.js')) }}"></script>
        <script src="{{asset('js/Lightstreamer/ig-public-api.js')}}?ver={{ filemtime(public_path('js/Lightstreamer/ig-public-api.js')) }}"></script>
        <script>
            setInterval(() => {
                $("#showError").hide();
                $("#showSuccess").hide();
            }, 7000);

            $('.input-daterange').datepicker({
                format: "dd/mm/yyyy",
                todayBtn: "linked",
                clearBtn: true,
                todayHighlight: true
            });
        </script>

</body>


</html>
