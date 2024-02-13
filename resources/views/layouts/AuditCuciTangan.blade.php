@extends('layouts.app')

@section('content')
<div class="header-waves-cucitangan">
    <div class="container pt-3">
        <h1 class="text-center"><b>AUDIT CUCI TANGAN</b></h1>
        <h2 class="text-center">Rumah Sakit Hermina Banyumanik Semarang</h2>
    </div>

    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="1" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="2" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="#fff" />
        </g>
    </svg>
</div>

<div class="container-fluid wrapper mb-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ Request::is('cuciTangan') ? 'active' : '' }}" aria-current="page"
                href="{{ route('getDataCuciTangan') }}">Tambah Data</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::is('rekapCuciTangan') ? 'active' : '' }}"
                href="{{ route('rekapCuciTangan') }}">Rekap Data</a>
        </li>
    </ul>
</div>

@yield('auditContent')

@endsection