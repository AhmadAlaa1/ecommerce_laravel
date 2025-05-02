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
    
<form method="POST" action={{route('home.loginauth')}} id="loginForm">
    @csrf
    <input name="email" type="email" value="{{old('useremail')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Enter Your Email">
    <input name="password" type="password" value="{{old('password')}}" class="w-100 form-control border-0 py-3 mb-4" placeholder="Your Password"></input>
    <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary" type="submit">Login</button>
    <div class="text-center mt-3">
        <a href="{{ route('home.register') }}" class="text-primary font-weight-bold text-decoration-none">
           Register
        </a>
    </div>
</form>

<script>
  document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/api/login', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.token) {
        const token = data.token;
        const payload = JSON.parse(atob(token.split('.')[1]));

        const userInfo = {
          name: payload.name || null,
          email: payload.email || null,
          role: payload.role || null,
          token: token
        };

        localStorage.setItem('user', JSON.stringify(userInfo));
        console.log("User logged in:", userInfo);

        // Redirect to backend-defined destination
        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Login failed");
      }
    })
    .catch(err => {
      console.error("Login error:", err);
      alert("Something went wrong.");
    });
  });
</script>


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