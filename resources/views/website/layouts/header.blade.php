<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Default Title' }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $metaDescription ?? 'Default Description' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? 'Default, Keywords' }}">
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link href="{{ asset('webassets/layout.css') }}" rel="stylesheet" />
     <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon"/>
    <link href="{{ asset('webassets/layout.css') }}" rel="stylesheet" />
      <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <!-- Bootstrap Navigation -->
<nav class="navbar justify-content-md-center">
        <a class="navbar-toggler collapsed border-0 d-block d-md-none" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
            <!-- these spans become the three lines -->
            <span> </span>
            <span> </span>
            <span> </span>
        </a>
        <div class="d-none d-md-flex">
            @if (Auth::check())
                 <a>Balance : {{ Auth::user()->balance(Auth::user()->id) }}</a>
             @endif
             <a href="/">HOME</a>
             @if (Auth::check())
             <a href="/user/history">HISTORY</a>
             <a href="/user/wallet">WALLET</a>
             <a href="/user/withdraw">WITHDRAW</a>
             <a href="/user/payment">ADD MONEY</a>
             <!-- <a href="/user/refer-earn">REFER AND EARN</a> -->
                 <form method="POST" action="{{ route('admin.logout') }}">
                  @csrf
                  <button class="remove_btn_default" type="submit">LOGOUT</button>
               </form>             
             @else
             <a href="/login">LOGIN</a>
            <a href="/register">REGISTER</a>
             @endif 
        </div>
        <div class="collapse navbar-collapse" id="collapsingNavbar">
            <ul class="nav navbar-nav my-4">
                @if (Auth::check())
                <li class="nav-item text-left">
                    <a>Balance : {{ Auth::user()->balance(Auth::user()->id) }}</a>
                </li>
                @endif
                <li class="nav-item text-left">
                     <a href="/">HOME</a>
                </li>
                 @if (Auth::check())
                 <li class="nav-item text-left">
                   <a href="/user/history">HISTORY</a>
                 </li>
                <li class="nav-item text-left">
                   <a href="/user/wallet">WALLET</a>
                </li>
                <li class="nav-item text-left">
                    <a href="/user/withdraw">WITHDRAW</a>
                </li>
                <li class="nav-item text-left">
                    <a href="/user/payment">ADD MONEY</a>
                </li>
                <li class="nav-item text-left">
                    <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="remove_btn_default" type="submit">LOGOUT</button>
                   </form>
                </li>             
                @else
                <li class="nav-item text-left">
                   <a href="/login">LOGIN</a>
                </li>
                <li class="nav-item text-left">
                   <a href="/register">REGISTER</a>
                </li>
                @endif  
            </ul>
        </div>
</nav>
       
      </header>