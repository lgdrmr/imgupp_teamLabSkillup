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
    {{ $users[$pst->user_id - 1]->github_id }}
    <img src="{{ asset('storage/'.$pst->imagefile) }}">
    {{ $pst->caption }}
@if ($pst->user_id == $uid)
    <form action="{{ url('/delete') }}" method="POST" name="delete">
      <input type="hidden" name="image_id" value="{{ $pst->id }}">
      {{ csrf_field() }}
      <button class="btn btn-success">Delete</button>
      <!-- <a href="" onclick="javascript.delete.submit();return false;">Delete</a> -->
    </form>
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
