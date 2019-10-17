@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow py-4" id="logoutWrap">
                <div class="card-header text-center">You are Not Logged In!</div>

                <div class="card-body" id="logoutImageWrap">
                    <img src="{{ asset('/images/logout.png') }}" alt="" />
                </div>
                <br /> <br />
                <div class="text-center">
                    <a href="{{ url('/login') }}" class="btn btn--raised">Login Again?</a>
                    <a href="{{ url('/register') }}" class="btn btn--raised ml-2">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
