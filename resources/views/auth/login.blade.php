{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}





@extends('layouts.app')

@section('content')

<style>

body{
    background: linear-gradient(135deg,#2563eb,#7c3aed);
    min-height:100vh;
}

.login-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.login-container{
    display:flex;
    max-width:1100px;
    width:100%;
    background:white;
    border-radius:14px;
    overflow:hidden;
    box-shadow:0 25px 50px rgba(0,0,0,0.15);
}

.login-left{
    flex:1;
    padding:50px;
}

.login-left h2{
    font-weight:700;
    margin-bottom:10px;
}

.login-left p{
    color:#6b7280;
    margin-bottom:30px;
}

.form-control{
    height:45px;
    border-radius:8px;
}

.login-btn{
    background:#2563eb;
    border:none;
    padding:10px 25px;
    border-radius:8px;
    color:white;
    font-weight:600;
}

.login-btn:hover{
    background:#1e4ed8;
}

.login-right{
    flex:1;
    background:linear-gradient(135deg,#2563eb,#7c3aed);
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
}

/* maintenance animation */

.worker{
    width:120px;
    animation:bounce 2s infinite ease-in-out;
}

@keyframes bounce{
    0%{transform:translateY(0)}
    50%{transform:translateY(-15px)}
    100%{transform:translateY(0)}
}

.gear{
    position:absolute;
    width:60px;
    animation:spin 6s linear infinite;
}

.gear1{
    top:40px;
    right:40px;
}

.gear2{
    bottom:40px;
    left:40px;
    animation-direction:reverse;
}

@keyframes spin{
    from{transform:rotate(0deg)}
    to{transform:rotate(360deg)}
}

</style>


<div class="login-wrapper">

<div class="login-container">

    <!-- LEFT LOGIN FORM -->
    <div class="login-left">

        <h2>Welcome Back</h2>
        <p>Login to access your dashboard</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email Address</label>

                <input id="email"
                       type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email"
                       value="{{ old('email') }}"
                       required autofocus>

                @error('email')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="mb-3">
                <label>Password</label>

                <input id="password"
                       type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password"
                       required>

                @error('password')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="mb-3 form-check">
                <input type="checkbox"
                       class="form-check-input"
                       name="remember"
                       id="remember">

                <label class="form-check-label">
                    Remember me
                </label>
            </div>


            <button type="submit" class="login-btn">
                Login
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="d-block mt-3">
                    Forgot password?
                </a>
            @endif

        </form>

    </div>


    <!-- RIGHT ANIMATION -->
    <div class="login-right">

        <img class="gear gear1" src="https://cdn-icons-png.flaticon.com/512/3524/3524636.png">

        <img class="gear gear2" src="https://cdn-icons-png.flaticon.com/512/3524/3524636.png">

        <img class="worker" src="https://cdn-icons-png.flaticon.com/512/1995/1995574.png">

    </div>

</div>

</div>

@endsection
