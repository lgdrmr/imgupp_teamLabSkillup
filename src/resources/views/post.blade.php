<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
@include('scripts.imgpreview')
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

  <!-- エラーメッセージ -->
@if ($errors->any())
  <ul>
@foreach($errors->all() as $error)
    <li>{{ $error }}</li>
@endforeach
  </ul>
@endif

  <!-- フォーム -->
  <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data">
    写真を選択: <input type="file" name="image" onChange="imgPreview(event)">
    <div id="preview">
    </div>
    <textarea name="caption" rows="3" cols="70" placeholder="キャプションを入力"></textarea>
    <br>
    {{ csrf_field() }}
    <button class="btn btn-success">Upload</button>
  </form>
</body>
</html>
