$(function() {

	$("#username_error").hide();
	$("#email_error").hide();

	var error_username = false;
	var error_email = false;

	$("#form_username").focusout(function() {

		check_username();

	});

	$("#form_email").focusout(function() {

		check_email();

	});

	function check_username() {

		var username_length = $("#form_username").val().length;

		if(username_length < 5 || username_length > 20) {
			$("#username_error").html("Should be between 5-20 characters");
			$("#username_error").show();
			error_username = true;
		} else {
			$("#username_error").hide();
		}

	}
	function check_email() {

		var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);

		if(pattern.test($("#form_email").val())) {
			$("#email_error").hide();
		} else {
			$("#email_error").html("Invalid email address");
			$("#email_error").show();
			error_email = true;
		}

	}

	$("#signup_form").submit(function() {

		error_username = false;
		error_email = false;

		check_username();
		check_email();

		if(error_username == false && error_email == false) {
			return true;
		} else {
			return false;
		}

	});

});
