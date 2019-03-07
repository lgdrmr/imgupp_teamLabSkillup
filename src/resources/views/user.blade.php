@extends('layouts.base')
@section('title', 'Profile: {{ $name }} - Imgupp')
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
  <h4>User name: {{ $name }}</h4>
  <div><img src="{{ $avater }}" height="200" width="200"></div>
  <h4>Like: {{ $thisuserlikes }}</h4>

@isset ($thisuserposts)
@foreach ($thisuserposts as $pst)
  <img src="{{ asset('storage/'.$pst->imagefile) }}">
@endforeach
@endisset
@endsection
