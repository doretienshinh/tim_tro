/**
 * Account Settings - Account
 */

'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const deactivateAcc = document.querySelector('#formAccountDeactivation');

    // Update/reset user image of account page
    let accountUserImage = document.getElementById('uploadedAvatar');
    const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

    if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
        if (fileInput.files[0]) {
          accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
        }
      };
      resetFileInput.onclick = () => {
        fileInput.value = '';
        accountUserImage.src = resetImage;
      };
    }
  })();
});

document.addEventListener('DOMContentLoaded', function (e) {
  $('#student-card-upload').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#student_card_show').html('<a href="' + e.target.result + '"target="_blank">' +
        '<img src ="' + e.target.result + '"id="preview" width="250px"></a>');
    }
    reader.readAsDataURL(this.files[0]);
  });

  $('#citizen-identification-upload').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#citizen_identification_show').html('<a href="' + e.target.result + '"target="_blank">' +
        '<img src ="' + e.target.result + '"id="preview" width="250px"></a>');
    }
    reader.readAsDataURL(this.files[0]);
  });
});