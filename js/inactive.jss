/************* Home start *******************/
$(document).ready(function() {
	$("#pwd").focusin(function () {
		$("#pwd-holder .form-control-feedback").removeClass('hidden');
		pass = setInterval(passwordHelper, 200);
	});
 	$("#pwd").focusout(function () {
		clearTimeout(pass);
	});
	$("#repwd").focusin(function () {
		$("#repwd-holder .form-control-feedback").removeClass('hidden');
		// alert("removed");
		pass = setInterval(passwordChecker, 200);
	});
	$("#repwd").focusout(function () {
		clearTimeout(pass);
	});
	$("#signupForm #email").focusin(function () {
		pass = setInterval(emailChecker, 200);
	});
	$("#signupForm #email").focusout(function () {
		clearTimeout(pass);
	});

	$("#range-all").click(function(){
		$("#amount").toggle("slow");
		$("#amount-slider-range").toggle("slow");
	});
});
function viewPropSuccess(data, status) {
	// alert(data);
	$("#viewPropModal .modal-dialog").html(data);
	$("#viewPropModal").modal("show");
}
$(function() {
	$( "#amount-slider-range" ).slider({
		range: true,
		min: 100000,
		max: 100000000,
		step: 100000,
		values: [ 5000000, 10000000 ],
		slide: function( event, ui ) {
			$( "#amount" ).val("Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ]);
		}
	});
	$( "#amount" ).val("Rs. " + $( "#amount-slider-range" ).slider( "values", 0 ) +
	" - Rs. " + $( "#amount-slider-range" ).slider( "values", 1 ));
	$( "#area-slider-range" ).slider({
		range: true,
		min: 100,
		max: 10000,
		step: 100,
		values: [ 1500, 3000 ],
		slide: function( event, ui ) {
			$( "#c-area" ).val( ui.values[ 0 ] + " Sq-Ft. - " + ui.values[ 1 ] + " Sq-Ft.");
		}
	});
	$( "#c-area" ).val( $( "#area-slider-range" ).slider( "values", 0 ) +
	" Sq-Ft. - " + $( "#area-slider-range" ).slider( "values", 1 ) + " Sq-Ft.");
	$( "#budget-slider-range" ).slider({
		range: true,
		min: 100000,
		max: 100000000,
		step: 100000,
		values: [ 5000000, 10000000 ],
		slide: function( event, ui ) {
			$( "#budget" ).val( "Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ] );
		}
	});
	$( "#budget" ).val( "Rs. " + $( "#budget-slider-range" ).slider( "values", 0 ) +
	" - Rs. " + $( "#budget-slider-range" ).slider( "values", 1 ) );
	$( "#area-slider-range-e" ).slider({
		range: true,
		min: 100,
		max: 10000,
		step: 100,
		values: [ 1500, 3000 ],
		slide: function( event, ui ) {
			$( "#e_c_area" ).val( ui.values[ 0 ] + " Sq-Ft. - " + ui.values[ 1 ] + " Sq-Ft.");
		}
	});
	$( "#e_c_area" ).val( $( "#area-slider-range-e" ).slider( "values", 0 ) +
	" Sq-Ft. - " + $( "#area-slider-range-e" ).slider( "values", 1 ) + " Sq-Ft.");
	$( "#budget-slider-range-e" ).slider({
		range: true,
		min: 100000,
		max: 100000000,
		step: 100000,
		values: [ 5000000, 10000000 ],
		slide: function( event, ui ) {
			$( "#e_budget" ).val( "Rs. " + ui.values[ 0 ] + " - Rs. " + ui.values[ 1 ] );
		}
	});
	$( "#e_budget" ).val( "Rs. " + $( "#budget-slider-range-e" ).slider( "values", 0 ) +
	" - Rs. " + $( "#budget-slider-range-e" ).slider( "values", 1 ) );
});
function passwordChecker() {
	if ($("#repwd").val() > 0) {
		if ($("#pwd").val() == $("#repwd").val()) {
			$("#repwd-holder").removeClass('has-error');
			$("#repwd-holder .form-control-feedback").removeClass('fa-remove');
			$("#repwd-holder .form-control-feedback").addClass('fa-check');
			$("#repwd-holder").addClass('has-success');
			$("#repwd-holder span.feedback-label").text("(Matched)");
		} else {
			$("#repwd-holder").addClass('has-error');
			$("#repwd-holder .form-control-feedback").removeClass('fa-check');
			$("#repwd-holder .form-control-feedback").addClass('fa-remove');
			$("#repwd-holder").removeClass('has-success');
			$("#repwd-holder span.feedback-label").text("");
		}
	} else {
		$("#repwd-holder").removeClass('has-error');
		$("#repwd-holder").removeClass('has-success');
		$("#repwd-holder .form-control-feedback").removeClass('fa-check');
		$("#repwd-holder .form-control-feedback").removeClass('fa-remove');
		$("#repwd-holder span.feedback-label").text("");
	}
}
function emailChecker() {
	var email = $("#signupForm #email").val()
	// alert(email.substring(email.indexOf("@"), email.length-2).search(".") != -1);
	if (email.length > 8 && email.search("@") != -1) {
		$.ajax({
			type: 'POST',
			url: "actions/email-checker.php",
			dataType: 'html',
			async: true,
			data: {
				email: email
			},
			success: function(data, status) {
				$("#email-holder").removeClass('has-error');
				$("#email-holder .form-control-feedback").removeClass('fa-remove');
				$("#email-holder .form-control-feedback").addClass('fa-check');
				$("#email-holder").addClass('has-success');
				$("#email-holder span.feedback-label").text("(Available)");
			},
			error: function(data, status) {
				$("#email-holder").addClass('has-error');
				$("#email-holder .form-control-feedback").removeClass('fa-check');
				$("#email-holder .form-control-feedback").addClass('fa-remove');
				$("#email-holder").removeClass('has-success');
				$("#email-holder span.feedback-label").text("(Already Exist)");				
			}
		});
	} else {
		$("#email-holder").removeClass('has-error');
		$("#email-holder").removeClass('has-success');
		$("#email-holder .form-control-feedback").removeClass('fa-check');
		$("#email-holder .form-control-feedback").removeClass('fa-remove');
		$("#email-holder span.feedback-label").text("");
	}
}
function passwordHelper() {
	var l = $("#pwd").val().length;
	if (l > 0) {
		if (l < 4) {
			$("#pwd-holder").addClass('has-error');
			$("#pwd-holder").removeClass('has-warning');
			$("#pwd-holder").removeClass('has-success');
			$("#pwd-holder .form-control-feedback").addClass('fa-remove');
			$("#pwd-holder .form-control-feedback").removeClass('fa-warning');
			$("#pwd-holder .form-control-feedback").removeClass('fa-check');
			$("#pwd-holder span.feedback-label").text("(Weak)");
		} else if (l > 3 && l < 7) {
			$("#pwd-holder").removeClass('has-error');
			$("#pwd-holder").addClass('has-warning');
			$("#pwd-holder").removeClass('has-success');
			$("#pwd-holder .form-control-feedback").removeClass('fa-remove');
			$("#pwd-holder .form-control-feedback").addClass('fa-warning');
			$("#pwd-holder .form-control-feedback").removeClass('fa-check');
			$("#pwd-holder span.feedback-label").text("(Good)");
		} else {
			$("#pwd-holder").removeClass('has-error');
			$("#pwd-holder").removeClass('has-warning');
			$("#pwd-holder").addClass('has-success');
			$("#pwd-holder .form-control-feedback").removeClass('fa-remove');
			$("#pwd-holder .form-control-feedback").removeClass('fa-warning');
			$("#pwd-holder .form-control-feedback").addClass('fa-check');
			$("#pwd-holder span.feedback-label").text("(Strong)");
		}
	} else {
		$("#pwd-holder").removeClass('has-error');
		$("#pwd-holder").removeClass('has-success');
		$("#pwd-holder .form-control-feedback").removeClass('fa-check');
		$("#pwd-holder .form-control-feedback").removeClass('fa-remove');
		$("#pwd-holder span.feedback-label").text("");
	}
}
function signup(elem) {
	if (elem.psw.value == elem.repsw.value) {
		$.ajax({
			type: 'POST',
			url: "actions/signup.php",
			dataType: 'html',
			async: true,
			data: {
				fname: elem.fname.value,
				lname: elem.lname.value,
				email: elem.email.value,
				psw: elem.psw.value,
				repsw: elem.repsw.value,
				gender: elem.gender.value,
				cont: elem.cont.value,
				street: elem.street.value,
				town: elem.town.value,
				city: elem.city.value,
				state: elem.state.value,
				submit_btn: elem.submit_btn.value
			},
			success: function(data, status) {
				var obj = JSON.parse(data);
				$("#signupModal").modal("hide");
				$("#signupSuccessModal .modal-info span").text(obj.firstName+" "+obj.lastName);
				$("#signupSuccessModal").modal("show");
				$("#errorHolder").css("display","none");
				$("#pwdHolder").removeClass("input-group");
				$("#repwdHolder").removeClass("input-group");
				$("#pwdHolder #pwd").nextAll().remove();
				$("#repwdHolder #repwd").nextAll().remove();
				elem.reset();
				return true;
			},
			error: errorHandler
		});
		return false;
	} else {
		// alert("Now Here");
		$("#repwd").focus();
		$("#passordErrorHolder").addClass("alert");
		$("#passordErrorHolder").addClass("alert-danger");
		// $(".alert#errorHolder").show();
		$("#passordErrorHolder").html("<strong>Password Mismatch!</strong> Please enter same password.");
		return false;
	}
}
/****** Home end ***********/
