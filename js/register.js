$(document).ready(function () {
  $("#register-form").submit(function (event) {
    event.preventDefault();

    $("#message").html("");
    var email = $("#email").val();
    var password = $("#password").val();
    var mobile = $("#mobile").val();

    if (!/^\S+@\S+\.\S+$/.test(email)) {
      displayMessage("Invalid email format.", "danger");
      return;
    }

    if (password.length < 6) {
      displayMessage("Password must be at least 6 characters.", "danger");
      return;
    }
    if (!/^\d{10}$/.test(mobile)) {
      displayMessage("Please enter a valid 10-digit mobile number.", "danger");
      return;
    }

    $.ajax({
      type: "POST",
      url: "php/register.php",
      data: {
        email: email,
        password: password,
        mobile: mobile,
      },
      dataType: "json",
      success: function (response) {
        displayMessage(response.message, "success");
        $("#register-form")[0].reset();
      },
      error: function (xhr, status, error) {
        var errorMessage = "An error occurred.";
        if (xhr.responseJSON && xhr.responseJSON.message) {
          errorMessage = xhr.responseJSON.message;
        }
        displayMessage(errorMessage, "danger");
      },
    });
  });

  function displayMessage(message, type) {
    var messageBox =
      '<div class="alert alert-' +
      type +
      ' alert-dismissible fade show" role="alert">' +
      message +
      '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
      "</div>";
    $("#message").html(messageBox);
  }
});
