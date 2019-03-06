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
    <form action="{{ url('/whois') }}" method="POST" name="whois">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <button class="btn btn-success">{{ $pst['likes'] }}</button>
      <!-- <a href="/delete" onclick="document.delete.submit();return false;">Delete</a> -->
    </form>
@if ($pst['user_id'] == $uid)
    <form action="{{ url('/delete') }}" method="POST" name="delete">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <button class="btn btn-success">Delete</button>
      <!-- <a href="/delete" onclick="document.delete.submit();return false;">Delete</a> -->
    </form>
@endif
@if ($is_loggedin)
@if ($pst['isLiked'])
    <!-- likeしている -->
    <form action="{{ url('/unlike') }}" method="POST" name="unlike">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <button class="btn btn-success">Unlike</button>
      <!-- <a href="/unlike" onclick="document.delete.submit();return false;">Unlike</a> -->
    </form>
@else
    <!-- likeしていない -->
    <form action="{{ url('/like') }}" method="POST" name="like">
      <input type="hidden" name="image_id" value="{{ $pst['id'] }}">
      {{ csrf_field() }}
      <button class="btn btn-success">Like</button>
      <!-- <a href="/like" onclick="document.delete.submit();return false;">Like</a> -->
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
