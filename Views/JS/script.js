$(document).ready(function () {
  /**
   * Whenever user tries to register,user should click on getotp button and
   * after sending otp through email succesfully, an OTP input field will be
   * visible in same registration page.
   */
  $("#otp").click(function () {
    var password = $('#password').val();
    if (length.password > 5) {
      $.ajax({
        type: "POST",
        url: "./Controllers/otppp.php",
        data: {
          email: $('#email').val(),
          fname: $('#fullname').val(),
          password: $('#password').val()
        },
        success: function (response) {
          $('#otpf').show();
          $('#email').hide();
        },
      });
    }
    else {
      alert("Password should be more than 5");
    }
  });
});

