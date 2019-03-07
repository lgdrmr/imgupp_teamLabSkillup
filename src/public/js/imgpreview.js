function imgPreview(event){
  var file = event.target.files[0];
  var reader = new FileReader();
  var preview = document.getElementById("preview");
  var previewImage = document.getElementById("previewImage");

  if (previewImage != null) {
    preview.removeChild(previewImage);
  }
  reader.onload = function () {
    var img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    img.setAttribute("name", "pimg");
    if (document.getElementById("emptyimage") != null)
      preview.removeChild(document.getElementById("emptyimage"));
    preview.appendChild(img);
    setActualSize(document.pimg, function (actual) {
      document.images["pimg"].height = (actual["height"] / actual["width"]) * pimg.width;
    });
  };

  reader.readAsDataURL(file);
}

var setActualSize = function(image, callback) {
  var img    = new Image();
  img.src    = image.src;
  img.onload = function() {
      var actual = {
          "width"  : img.width,
          "height" : img.height
      };
      img.onload = "";
      img = void 0;
      callback(actual);
  };
}
