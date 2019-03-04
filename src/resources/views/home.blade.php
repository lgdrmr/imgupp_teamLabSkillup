<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  @if ($is_loggedin)
    <h4>your name is {{ $name }}</h4>
    <div><img src="{{ $avater }}" height="200" width="200"></div>
  @endif
</body>
</html>
