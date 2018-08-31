function hideForms(form){
	console.log("hide inner");
	if (form=="inner-container"){
		$(".inner-container").fadeOut(1000).promise().done(function(){
     $(".bottom-container").show(1000); });
	}
	else{
		$(".section-login").hide();
		$(".bottom-container").hide();
	}
}
function cleanFields(){
	$(".reg-input").each(function(){
         $(this).val("");
    });
}
$(document).ready(function(){
	hideForms()
	$("#signup-op").click(function(){
		$(this).addClass("active");
		if ($("#login-op").hasClass("active"))
			$("#login-op").removeClass("active")
		$(".section-sign-up").show();
		$(".section-login").hide();
	});

	$("#login-op").click(function(){
		$(this).addClass("active");
		if ($("#signup-op").hasClass("active"))
			$("#signup-op").removeClass("active")
		$(".section-login").show();
		$(".section-sign-up").hide();
	});
	$(".logout").click(function(){
		$(".bottom-container").fadeOut(1000).promise().done(function(){
     	$(".inner-container").fadeIn(1000); });
     	$(".warning-login").html("All fields are required*");
     	$(".warning-signin").html("All fields are required*");
	});
});