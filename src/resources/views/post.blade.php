@extends('layouts.base')
@section('title', 'Post - Imgupp')
@section('script')
  <script src="js/imgpreview.js"></script>
@endsection
@section('content')
@include('layouts.header', ['is_loggedin' => $is_loggedin])
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
@endsection
