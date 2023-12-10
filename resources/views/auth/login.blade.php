@extends('layouts.app')

@section('content')

<div class="kotak">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h1 class="display-3 fw-bold text-white">Login</h1>
        <div class="username t-input">
            {{-- <input type="text" required="" id="username" placeholder="." /> --}}
            <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" placeholder="" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label for="name">{{ __('Username') }}</label>
            <div class="b-line"></div>
        </div>

        <div class="password t-input">
            {{-- <input type="password" required="" id="password" placeholder="." /> --}}
            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password"
                placeholder="" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label for="password">{{ __('Password') }}</label>
            <div class="b-line"></div>
        </div>

        <div class="check">
            {{-- <input type="checkbox" name="os" id="ch1" />
            <label for="ch1">Remember me</label> --}}

            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="d-grid col-12">
            {{-- <button type="button" class="btn btn-outline-light">Login</button> --}}

            <button type="submit" class="btn btn-outline-light">
                {{ __('Login') }}
            </button>
        </div>
    </form>
</div>

@extends('layouts.footer-login')