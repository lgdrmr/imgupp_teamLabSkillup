@extends('layouts.base')
@section('title', 'Post - Imgupp')
@section('script')
  <script src="js/imgpreview.js"></script>
<?php
if ($errors->any()) {
  $errorlog = '';
  foreach ($errors->all() as $error) {
    $errorlog .= '・'.$error.'\n';
  }
  echo '<script type="text/javascript">alert("'.$errorlog.'");</script>';
}
?>

@endsection
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
  <div class="content">
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
  </div>
@endsection
