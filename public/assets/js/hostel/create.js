document.addEventListener('DOMContentLoaded', function (e) {
    $('#thumbnail-upload').change(function () {
      let reader = new FileReader();
      reader.onload = (e) => {
        $('#thumbnail_show').html('<a href="' + e.target.result + '"target="_blank">' +
          '<img src ="' + e.target.result + '"id="preview" width="250px"></a>');
      }
      reader.readAsDataURL(this.files[0]);
    });
  });