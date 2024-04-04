$(document).ready(function () {
  $("#otp").click(function () {
    $.ajax({
      type: "POST",
      url: "./Controllers/otppp.php",
      data: {
        email: $('#email').val()
      },
      success: function (response) {
        $('#otpf').show();
        $('#email').hide();
      },
    });
  });
});

