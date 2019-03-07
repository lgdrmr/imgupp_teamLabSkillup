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
    <form id="uploadform" name="upload" method="POST" action="{{ url('/upload') }}" enctype="multipart/form-data">
      <section class="inputarea">
        <div id="fileselect">
          <label for="file_upload">
            <input type="file" id="file_upload" name="image" onChange="imgPreview(event)">
          </label>
          <span id="selecttext"><span class="typcn typcn-folder-open"></span> Select image file</span>
        </div>
        <div id="preview">
          <span id="emptyimage" class="typcn typcn-image"></span>
        </div>
        <textarea id="captioninput" name="caption" rows="3" cols="70" placeholder="Enter caption"></textarea>
      </section>
      {{ csrf_field() }}
      <section class="uploadarea">
        <div class="uploadbutton">
          <a class="uploadlink cp_tooltiptext" data-tooltip="Post!" href="javascript:upload.submit()"><span class="typcn typcn-cloud-storage"></span></a>
        </div>
      </section>
    </form>
  </div>
@endsection
