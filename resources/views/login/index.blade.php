@extends('layouts.app')

@section('content')

<div class="kotak">
    <form>
        <h1 class="display-3 fw-bold text-white">Login</h1>
        <div class="username t-input">
            <input type="text" required="" id="username" placeholder="." />
            <label for="username">Username</label>
            <div class="b-line"></div>
        </div>
        <div class="password t-input">
            <input type="password" required="" id="password" placeholder="." />
            <label for="password">Password</label>
            <div class="b-line"></div>
        </div>
        {{-- <div class="check">
            <input type="checkbox" name="os" id="ch1" />
            <label for="ch1">Remember me</label>
        </div> --}}
        <div class="d-grid col-12">
            <button type="button" class="btn btn-outline-light">Login</button>
        </div>
    </form>
</div>

@extends('layouts.footer-login')