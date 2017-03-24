jQuery(document).ready(function() {

	var container = jQuery('div.rsvErrors1');

	jQuery("#mypriceguide").validate({
	
		rules: {
			your_school: {required: true,minlength: 3},
			your_name: {required: true,minlength: 3},
			your_email: {required: true, email: true},
		},

		messages: {
			your_school: "Please enter your School name.",
			your_name: "Please enter your name.",	
			your_email: "Please enter your email address",
		},

		errorContainer: container,
		errorLabelContainer: jQuery("ol", container),
		wrapper: 'li',
		submitHandler: function(form) {

			var pwdata = jQuery('#mypriceguide').serialize();

			jQuery(".ajax-loader").css("visibility","visible");

			jQuery.post(
				MyAjax.ajaxurl,
				{
					syscontrol: MyAjax.syscontrol, 
					action: "sd_priceguide_action",
					data: pwdata
				},
				function(response, textStatus){	
					var pwresponse = response;
					jQuery('#quotesummary').replaceWith(pwresponse);
					jQuery(".ajax-loader").css("visibility","hidden");
					jQuery("#pwquoteoutput").fadeOut(1500);
					jQuery("#pwquoteoutput").fadeIn(10);
					
					// UPDATE FORM FIELD TO INDICATE THAT FORM HAS BEEN SUBMITTED AT LEAST ONCE
					document.priceguideform.dbupdate.value = "1";
							
			}); 
		} 
  });
});