<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class=header>
    <a href="/home">home</a>
@if ($is_loggedin)
    <a href="/logout">logout</a>
@else
    <a href="/login">login</a>
@endif
    <a href="/post">post</a>
  </div>

  <!-- アップロードした画像 -->
@isset ($posts)
@foreach ($posts as $pst)
  <div>
    <a href="/{{ $users[$pst['user_id'] - 1]->github_id }}">{{ $users[$pst['user_id'] - 1]->github_id }}</a>
    <img src="{{ asset('storage/'.$pst['imagefile']) }}">
    {{ $pst['caption'] }}
    <form name="whois{{ $pst['id'] }}" method="POST" action="{{ url('/whois') }}">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <a href="javascript:whois{{ $pst['id'] }}.submit()">{{ $pst['likes'] }}</a>
    </form>
@if ($pst['user_id'] == $uid)
    <form name="delete{{ $pst['id'] }}" method="POST" action="{{ url('/delete') }}">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <a href="javascript:delete{{ $pst['id'] }}.submit()">Delete</a>
    </form>
@endif
@if ($is_loggedin)
@if ($pst['isLiked'])
    <!-- likeしている -->
    <form name="unlike{{ $pst['id'] }}" method="POST" action="{{ url('/unlike') }}">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <a href="javascript:unlike{{ $pst['id'] }}.submit()">Unlike</a>
    </form>
@else
    <!-- likeしていない -->
    <form name="like{{ $pst['id'] }}" method="POST" action="{{ url('/like') }}">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <a href="javascript:like{{ $pst['id'] }}.submit()">Like</a>
    </form>
@endif
@else
    <!-- logout -->
    Like
@endif
  </div>
@endforeach
@endisset

@empty ($isHead)
  <a href="/previous">previous</a>
@endempty
@empty ($isTail)
  <a href="/next">next</a>
@endempty
</body>
</html>
