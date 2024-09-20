@extends('layouts.app')

@section('Home')
active
@endsection

@section('body')
<div class="container">
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    <div style="visibility:hidden;">.</div>
    
<form method="POST" action={{route('home.loginauth')}}>
    @csrf
    <input name="username" type="text" value="{{old('username')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
    <input name="password" type="password" value="{{old('password')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Password"></input>
    <input name="useremail" type="email" value="{{old('useremail')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
    <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Login</button>
    <div class="text-center mt-3">
        <a href="{{ route('home.register') }}" class="text-primary font-weight-bold text-decoration-none">
           Register
        </a>
    </div>
    
</form>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        <li>{{ session('error') }}</li>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

</div>
@endsection