<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Liked users</title>
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

@isset ($likedUsers)
@foreach ($likedUsers as $usr)
  <a href="/{{ $usr['github_id'] }}">{{ $usr['github_id'] }}</a>
  <div>
    <a href="/{{ $usr['github_id'] }}"><img src="{{ $usr['avaterfile'] }}" height="200" width="200"></a>
  </div>
@endforeach
@endisset
</body>
</html>
