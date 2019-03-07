@extends('layouts.base')
@section('title', 'Home')
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
  <div class="content">
@isset ($posts)
  {{-- アップロードした画像 --}}
@foreach ($posts as $pst)
    <section class="post">
      <div class="post-header">
        <a class="fix name" href="/{{ $users[$pst['user_id'] - 1]->github_id }}">{{ $users[$pst['user_id'] - 1]->github_id }}</a>
@if ($pst['user_id'] == $uid)
        <form name="delete{{ $pst['id'] }}" method="POST" action="{{ url('/delete') }}">
          <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
          {{ csrf_field() }}
          <a class="trash" href="javascript:delete{{ $pst['id'] }}.submit()"><span class="typcn typcn-trash"></span></a>
        </form>
@endif
      </div>
      <img class="post-img" src="{{ asset('storage/'.$pst['imagefile']) }}">
      <div class="post-footer">
        <div class="post-caption">
          {{ htmlspecialchars($pst['caption']) }}
        </div>
        <div class="post-like">
          <div class="likebutton-area">
@if ($is_loggedin)
@if ($pst['isLiked'])
            <!-- likeしている -->
            <form name="unlike{{ $pst['id'] }}" method="POST" action="{{ url('/unlike') }}">
              <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
              {{ csrf_field() }}
              <a class="like-button-available" href="javascript:unlike{{ $pst['id'] }}.submit()"><span class="typcn typcn-heart-full-outline"></span></a>
            </form>
@else
            <!-- likeしていない -->
            <form name="like{{ $pst['id'] }}" method="POST" action="{{ url('/like') }}">
              <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
              {{ csrf_field() }}
              <a class="like-button-available" href="javascript:like{{ $pst['id'] }}.submit()"><span class="typcn typcn-heart-outline"></span></a>
            </form>
@endif
@else
            <!-- logout -->
            <div class="like-button-notavailable">
              <span class="typcn typcn-heart-full-outline"></span>
            </div>
@endif
          </div>
          <div class="likecounter-area">
            <form action="{{ url('/whois') }}" method="POST" name="whois{{ $pst['id'] }}">
              <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
              {{ csrf_field() }}
              <a class="like-count" href="javascript:whois{{ $pst['id'] }}.submit()">{{ $pst['likes'] }}</a>
            </form>
          </div>
        </div>
      </div>
    </section>
@endforeach
    <section class="navigation">
@empty ($isHead)
      <div class="previous-button">
        <a class="navigation-button" href="/previous"><span class="typcn typcn-arrow-left-thick"></span></a>
      </div>
@endempty
@empty ($isTail)
      <div class="next-button">
        <a class="navigation-button" href="/next"><span class="typcn typcn-arrow-right-thick"></span></a>
      </div>
@endempty
    </section>
@endisset
  </div>
@endsection
