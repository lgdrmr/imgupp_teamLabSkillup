<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Post</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/imgpreview.js"></script>
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
  <form name="upload" method="POST" action="{{ url('/upload') }}" enctype="multipart/form-data">
    <label for="file_upload">
    ファイルを選択して下さい
    <input type="file" id="file_upload" name="image" onChange="imgPreview(event)">
    </label>
    <div id="preview">
    </div>
    <textarea name="caption" rows="3" cols="70" placeholder="Enter caption"></textarea>
    <br>
    {{ csrf_field() }}
    <a href="javascript:upload.submit()">Upload</a>
  </form>
</body>
</html>
