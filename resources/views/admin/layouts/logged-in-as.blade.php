@impersonating
<div class="container pt-3">
    <div class="alert alert-danger logged-in-as">
        Logged in as {{ auth()->user()->name }}. <a href="{{ route('impersonate.leave') }}" class="text-success">Return to your account!</a>.
    </div><!--alert alert-warning logged-in-as-->
</div>
@endImpersonating
