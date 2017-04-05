/* this files used login related functions... */

$(document).ready(function() {

	var  loading_icon = "";
/* Common login */
$("#login_form").validate(
		{
			ignore : "",
			submitHandler : function() {
				
				$(".log_alert").removeClass('alert-danger');
				$("#log_submit").hide();
				$("#login-progress").show();
		    	
		    	   $.ajax({
		    	        url: ADMIN_URL+"index",
		    	        data : $('#login_form').serialize(),
		    	        type :'POST', 
		    	        dataType:"json",
		    	        success:function(data){
		    	        	$("#log_submit").show();
		    	    		$("#login-progress").hide();
							
		    	            if(data.status=="success"){
								
								if(data.type='delear')
								{
								 window.location.href = ADMIN_URL+"dashboard/";
								} 
		    	            	
		    	              }else if(data.status=="error"){
		    	     		      $(".log_alert").addClass("alert-danger");
									$(".log_alert").show().html(data.message);
									
		    	              }
		    	        }
		    	    });
		    
			}
		});
		
		
		/* forgot password */
		 
		 $("#forgot_form").validate(
            {
                ignore: "",
                submitHandler: function () {
					
                    $.ajax({
                        url: ADMIN_URL + "forgotpassword",
                        data: $('#forgot_form').serialize(),
                        type: 'POST',
                        dataType: "json",
                        success: function (data) {
                            if (data.status == "success") {
                                $(".log_alert").removeClass("alert-danger");
                                $(".log_alert").addClass("alert-success");
                                $(".log_alert").show().html(data.message);
                            } else if (data.status == "error") {
                                $(".log_alert").removeClass("alert-success");
                                $(".log_alert").addClass("alert-danger");
                                $(".log_alert").show().html(data.message);
                            }
                        }
                    });

                }
            });
		 
		
		
		/* reset password */
		 $("#reset_form").validate(
            {
                ignore: "",
                submitHandler: function () {
					
                    $.ajax({
                        url: ADMIN_URL + "resetpassword",
                        data: $('#reset_form').serialize(),
                        type: 'POST',
                        dataType: "json",
                        success: function (data) {
							
                            if (data.status == "success") {
                                $(".log_alert").removeClass("alert-danger");
                                $(".log_alert").addClass("alert-success");
                                $(".log_alert").show().html(data.message);
								setTimeout(function () {
									location.href = ADMIN_URL;
								}, 2000);
                            } else if (data.status == "error") {
                                $(".log_alert").removeClass("alert-success");
                                $(".log_alert").addClass("alert-danger");
                                $(".log_alert").show().html(data.message);
                            }
                        }
                    });

                }
            });

}); /* end of document ready*/