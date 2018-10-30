$(function() {

	$("#username_error").hide();
	$("#password_error").hide();
	$("#cpass_error").hide();
	$("#email_error").hide();

	var error_username = false;
	var error_password = false;
	var error_cpass = false;
	var error_email = false;

	$("#form_username").focusout(function() {

		check_username();

	});

	$("#form_password").focusout(function() {

		check_password();

	});

	$("#form_cpass").focusout(function() {

		check_retype_password();

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
		error_password = false;
		error_cpass = false;
		error_email = false;

		check_username();
		check_password();
		check_retype_password();
		check_email();

		if(error_username == false && error_password == false && error_cpass == false && error_email == false) {
			return true;
		} else {
			return false;
		}

	});

});
