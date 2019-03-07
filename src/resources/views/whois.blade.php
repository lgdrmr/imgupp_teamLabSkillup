@extends('layouts.base')
@section('title', 'Liked users - Imgupp')
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
  <div class="content">
@isset ($likedUsers)
@foreach ($likedUsers as $usr)
    <div class="whoisprofile">
      <div class="useravaterarea">
        <img class="whoisimg" src="{{ $usr['avaterfile'] }}">
      </div>
      <div class="usertextarea">
        <span class="whoisname">{{ $usr['github_id'] }}</span>
      </div>
      <a href="/{{ $usr['github_id'] }}"></a>
    </div>
@endforeach
@endisset
  </div>
@endsection
