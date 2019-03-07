@extends('layouts.base')
@section('title', 'Login - Imgupp')
@section('content')
  <div class="logincontent">
    <div class="logo">
      <span class="logotext">Imgupp</span>
    </div>
    <div class="loginlink">
      <div id="gitlogo"><img id="git-img" src="image/GitHub-Mark-Light-64px.png"></div>
      <div id="gittext">Sign in with <span id="github">GitHub</span></div>
      <a class="fix" href="/login/github"></a>
    </div>
  </div>
@endsection
