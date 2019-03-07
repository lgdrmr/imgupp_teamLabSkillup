@extends('layouts.base')
@section('title', 'Liked users - Imgupp')
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
@isset ($likedUsers)
@foreach ($likedUsers as $usr)
  <a href="/{{ $usr['github_id'] }}">{{ $usr['github_id'] }}</a>
  <div>
    <a href="/{{ $usr['github_id'] }}"><img src="{{ $usr['avaterfile'] }}" height="200" width="200"></a>
  </div>
@endforeach
@endisset
@endsection
