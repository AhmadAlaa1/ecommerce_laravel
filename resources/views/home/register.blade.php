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
    
<form method="POST" action={{route('home.registerauth')}}>
    @csrf
    <input name="username" type="text" value="{{old('username')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Name">
    <input name="useremail" type="email" value="{{old('useremail')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
    <input name="password" type="password" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Password"></input>
    <input name="password_confirmation" type="password" class="w-100 form-control border-0 py-3 mb-4" placeholder="Confirm The Password"></input>
    <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary " type="submit">Register</button>
    <div class="text-center mt-3">
        <a href="{{ route('home.login') }}" class="text-primary font-weight-bold text-decoration-none">
           Login
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

</div>
@endsection