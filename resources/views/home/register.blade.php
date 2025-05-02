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
    
<form method="POST" action={{route('home.registerauth')}} id="registerform">
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

<script>
  document.getElementById('registerform').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('/api/register', {
      method: 'POST',
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.token) {
        const token = data.token;
        const payload = JSON.parse(atob(token.split('.')[1]));

        localStorage.setItem('token', token);

        const userInfo = {
          name: payload.name,
          email: payload.email,
          role: payload.role,
          token: token 
        };

        localStorage.setItem('user', JSON.stringify(userInfo));

        window.location.href = data.redirect_url;
      } else {
        alert(data.message || "Register failed");
      }
    })
    .catch(err => {
      console.error("Error decoding token or during registration:", err);
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

</div>
@endsection