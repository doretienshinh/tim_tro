document.addEventListener('DOMContentLoaded', function (e) {
    $('#thumbnail-upload').change(function () {
      $('#thumbnail_show').empty();
      let reader = new FileReader();
      reader.onload = (e) => {
        $('#thumbnail_show').html('<div class="w-100 d-flex justify-content-center mt-3">' +
          '<img src ="' + e.target.result + '"id="preview_image" width="250px"></div>');
      }
      reader.readAsDataURL(this.files[0]);
    });
  });