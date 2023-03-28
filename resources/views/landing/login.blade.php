<!DOCTYPE html>
<html lang="en">

<head class="crypt-dark">
    <meta charset="UTF-8">
    <title>Crypterio</title>
    <link rel="stylesheet" href="{{asset('landingAssets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/icons.css')}}">
    <link rel="stylesheet" href="{{asset('landingAssets/css/ui.css')}}">
</head>

<body class="crypt-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="cryptorio-forms cryptorio-forms-dark text-center pt-5 pb-5">
                    <div class="logo">
                        <img src="{{asset('landingAssets/images/logo.png')}}" alt="logo-image">
                    </div>
                    <h3 class="p-4">Welcome</h3>
                    <div class="cryptorio-main-form">
                        <form action="" class="text-left">
                            <label for="email">Account Name</label>
                            <input type="text" id="email" name="email" placeholder="Your email/cellphone">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Please Input Your Password">

                            <input type="submit" value="Log In" class="crypt-button-red-full">
                        </form>
                        <p class="float-left"><a href="register.html">Sign Up</a></p>
                        <p class="float-right"><a href="forgot.html">Forgot Password</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

	<script src="{{asset('landingAssets/amc/core.js')}}"></script>
	<script src="{{asset('landingAssets/amc/charts.js')}}"></script>
	<script src="{{asset('landingAssets/amc/dark.js')}}"></script>
	<script src="{{asset('landingAssets/amc/animated.js')}}"></script>
	<script src="{{asset('landingAssets/js/jquery.js')}}"></script>
	<script src="{{asset('landingAssets/js/popper.min.js')}}"></script>
	<script src="{{asset('landingAssets/bootstrap/js/bootstrap.bundle.js')}}"></script>
	<script src="{{asset('landingAssets/bootstrap/js/bootstrap.js')}}"></script>
	<script src="{{asset('landingAssets/js/main.js')}}"></script>
	<script src="{{asset('landingAssets/js/amc.js')}}"></script>
	<script src="https://s3.tradingview.com/tv.js"></script>
</body>
</html>