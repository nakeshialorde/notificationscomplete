$(function(){
	var passwordStrong=false;
	var passwordMatch=false;
	
	var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^a-zA-Z0-9])(?=.{6,})");
	var upperLowerCheck = new RegExp("(?=.*[a-z])(?=.*[A-Z])");
	var specialCheck = new RegExp("(?=.*[^a-zA-Z0-9])");//")("(?=.*[_!@#\$%\^&\*])");
	var numberCheck = new RegExp("(?=.*[0-9])");
	var lengthCheck = new RegExp("(?=.{6,})");

	$("body").on("click","#submitButton.enabled",function(){
		$(this)
			.removeClass("enabled")
			.text("Registering ")
			.append(
				$("<i></i>")
					.addClass("fa fa-refresh fa-spin")
			);
		$("#registerForm").submit();
	});
	
	$("#password").focus(function(){
		console.log("focused");
		if(!strongRegex.test($(this).val())){
			$("#passwordPrompt").slideDown();
			/*FH*/
			$('html, body').animate({
				scrollTop: ($('#focusPassword').offset().top-75)
			},500);
			/*FH*/
		}
	});
	
	$("#confirmpassword").focus(function(){
		console.log("focused");
		if($(this).val()!=$("#password").val()){
			$("#confirmPasswordPrompt").slideDown();
		}
	});
	
	$("#password").keyup(function(){
		if(strongRegex.test($(this).val())){
			$("#passwordPrompt").slideUp();
			passwordStrong=true;
		}
		else{
			$("#passwordPrompt").slideDown();
			passwordStrong=false;
		}
		if(passwordStrong && passwordMatch){
			console.log("PasswordStrong and PasswordMatch");
			$("#submitButton").removeClass("conditionalSubmit").addClass("enabled");
		}
		else{
			$("#submitButton").removeClass("enabled").addClass("conditionalSubmit");
		}
		
		if(upperLowerCheck.test($(this).val())){
			$("#upperLowerCheck").addClass("fa-check");
		}
		else{
			$("#upperLowerCheck").removeClass("fa-check");
		}
		
		if(lengthCheck.test($(this).val())){
			$("#lengthCheck").addClass("fa-check");
		}
		else{
			$("#lengthCheck").removeClass("fa-check");
		}
		
		if(numberCheck.test($(this).val())){
			$("#numberCheck").addClass("fa-check");
		}
		else{
			$("#numberCheck").removeClass("fa-check");
		}
		
		if(specialCheck.test($(this).val())){
			$("#specialCheck").addClass("fa-check");
		}
		else{
			$("#specialCheck").removeClass("fa-check");
		}
	});
	
	$("#confirmpassword").keyup(function(){
		if($(this).val()==$("#password").val()){
			$("#confirmPasswordPrompt").slideUp();
			passwordMatch=true;
			$("#matchCheck").addClass("fa-check");
		}
		else{
			$("#confirmPasswordPrompt").slideDown();
			passwordMatch=false;
			$("#matchCheck").removeClass("fa-check");
		}
		if(passwordStrong && passwordMatch){
			console.log("PasswordStrong and PasswordMatch");
			$("#submitButton").removeClass("conditionalSubmit").addClass("enabled");
		}
		else{
			$("#submitButton").removeClass("enabled").addClass("conditionalSubmit");
		}
	});
});

/*FH*/
$(function(){
	$("#showPassword").click(function(){
			var x = document.getElementById("password");
			var ico = $("#showPassword i");
		if (x.type === "password") {
			x.type = "text";
			ico.removeClass("fa-eye");
			ico.addClass("fa-eye-slash");
		} else {
			x.type = "password";
			ico.removeClass("fa-eye-slash");
			ico.addClass("fa-eye");

		}
	});
});	
/*FH */