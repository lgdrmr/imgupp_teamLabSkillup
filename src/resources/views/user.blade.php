@extends('layouts.base')
@section('title', 'Profile - Imgupp')
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
  <div class="content">
    <section class="userprofile">
      <div class="useravaterarea">
        <img class="avaterimg" src="{{ $avater }}">
      </div>
      <div class="usertextarea">
        <div class="username">{{ $name }}</div>
        <div class="userlikes">Likes: {{ $thisuserlikes }}</div>
      </div>
    </section>
@isset ($thisuserposts)
    <section class="imglist">
@foreach ($thisuserposts as $pst)
      <div class="imgitem">
        <div class="innerbox">
        <img class="userimg" src="data:image/{{ $pst['filetype'] }};base64,{{ $pst['imagefile'] }}">
        </div>
      </div>
@endforeach
    </section>
@endisset
  </div>
@endsection
