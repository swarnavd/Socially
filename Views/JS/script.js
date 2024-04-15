$(document).ready(function () {
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

