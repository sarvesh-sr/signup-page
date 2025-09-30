$(document).ready(function () {
  $("#register-form").submit(function (event) {
    event.preventDefault();

    var email = $("#email").val();
    var password = $("#password").val();
    var mobile = $("#mobile").val();

    $.ajax({
      type: "POST",
      url: "php/register.php",
      data: {
        email: email,
        password: password,
        mobile: mobile,
      },
      success: function (response) {
        $("#message").html(
          '<p style="color: green;">' + response.message + "</p>"
        );
      },
      error: function (xhr, status, error) {
        var errorMessage = xhr.responseJSON
          ? xhr.responseJSON.message
          : "An error occurred.";
        $("#message").html('<p style="color: red;">' + errorMessage + "</p>");
      },
    });
  });
});
