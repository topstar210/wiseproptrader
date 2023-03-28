@extends('layouts.auth_page')

@section('content')
        @php
        $array = array(array('metaname' => 'color', 'metavalue' => 'blue'),
                        array('metaname' => 'size', 'metavalue' => 'big'));
        @endphp
        <h3>Buy Movie Tickets N500.00</h3>
        <form method="POST" action="{{ route('pay') }}" id="paymentForm">
            {{ csrf_field() }}
            <input type="hidden" name="amount" value="500" /> 
            <input type="hidden" name="payment_method" value="both" /> 
            <input type="hidden" name="description" value="Beats by Dre. 2017" /> 
            <input type="hidden" name="country" value="NG" /> 
            <input type="hidden" name="currency" value="NGN" /> 
            <input type="hidden" name="email" value="test@test.com" /> 
            <input type="hidden" name="firstname" value="Oluwole" /> 
            <input type="hidden" name="lastname" value="Adebiyi" /> 
            <input type="hidden" name="metadata" value="{{ json_encode($array) }}" > 
            <input type="hidden" name="phonenumber" value="090929992892" /> 
            <input type="hidden" name="paymentplan" value="362" />  
            <input type="hidden" name="ref" value="MY_NAME_5uwh2a2a7f270ac98" />  
            <input type="hidden" name="logo" value="https://pbs.twimg.com/profile_images/915859962554929153/jnVxGxVj.jpg" />  
            <input type="hidden" name="title" value="Flamez Co" />  
            <input type="submit" value="Buy" />
        </form>

@endsection