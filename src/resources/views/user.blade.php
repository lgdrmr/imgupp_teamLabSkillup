<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profile: {{ $name }}</title>
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

  <h4>User name is {{ $name }}</h4>
  <div><img src="{{ $avater }}" height="200" width="200"></div>

@isset ($thisuserposts)
@foreach ($thisuserposts as $pst)
  <img src="{{ asset('storage/'.$pst->imagefile) }}">
@endforeach
@endisset

</body>
</html>
