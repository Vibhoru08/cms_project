$(function() {

	$("#password_error").hide();
	$("#cpass_error").hide();

	var error_password = false;
	var error_cpass = false;

	$("#form_password").focusout(function() {

		check_password();

	});

	$("#form_cpass").focusout(function() {

		check_retype_password();

	});

	function check_password() {

		var password_length = $("#form_password").val().length;

		if(password_length < 8) {
			$("#password_error").html("At least 8 characters");
			$("#password_error").show();
			error_password = true;
		} else {
			$("#password_error").hide();
		}

	}

	function check_retype_password() {

		var password = $("#form_password").val();
		var retype_password = $("#form_cpass").val();

		if(password !=  retype_password) {
			$("#cpass_error").html("Passwords don't match");
			$("#cpass_error").show();
			error_cpass = true;
		} else {
			$("#cpass_error").hide();
		}

	}

	$("#signup_form").submit(function() {

		error_password = false;
		error_cpass = false;

		check_password();
		check_retype_password();

		if(error_password == false && error_cpass == false) {
			return true;
		} else {
			return false;
		}

	});

});
