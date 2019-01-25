//Sign up form validation
$(function(){
	$(document).on('change','.chainselectmaster',function(){
		var url=$(this).data('url');
		var parentid=$(this).val();
		var childelement=$(this).data('childelement');
		$('.img-loader').removeClass('hidden');
		
		$.ajax({
						url: url+'/'+parentid, // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						dataType:'html',
						
						success: function(data)   // A function to be called if request succeeds
						{
							$('.img-loader').addClass('hidden');
							
								$(childelement).html('');
      					    	$(childelement).html(data);
						}
			});
	})
	$(document).on('change','.chaininputmaster',function(){
		var url=$(this).data('url');
		var parentid=$(this).val();
		var childelement=$(this).data('childelement');
	
	$('.img-loader').removeClass('hidden');
	$.ajax({
						url: url+'/'+parentid, // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						dataType:'html',
						
						success: function(data)   // A function to be called if request succeeds
						{
						
							$('.img-loader').addClass('hidden');
							
								$(childelement).val('');
      					    	$(childelement).val(data);
						}
			});
	})
})
// $(function(){

//   jQuery.validator.addMethod("username", function(value, element) {

//   return this.optional(element) || /^[a-zA-Z0-9_]+$/.test(value);

// }, "Please enter valid username");  

//    jQuery.validator.addMethod("contactno", function(value, element) {

//   return this.optional(element) || /^[0-9+-\s]+$/.test(value);

// }, "Please enter valid Contact number"); 
//  });


$("#staffregbtn").click(function(e) {

       $("#staffregnform").validate({
            errorElement: 'span',
			errorClass:'text-danger',
			highlight: function (element, errorClass, validClass) { 
			  $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
			}, 
			unhighlight: function (element, errorClass, validClass) { 
             
				$(element).parents("div.form-group").removeClass('has-error'); 
				$(element).parents(".error").removeClass('has-error').addClass('has-success'); 
			},
           rules: {
				college_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                first_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 100
                },
                last_name: {
                    required: true,
                    minlength: 2,
                    maxlength: 50
                },
                faculty: {
                    required: true,
                    minlength: 2,
                    maxlength: 20
                },
                father_name: {
                    required: true,
                    minlength:3,
                    maxlength: 50,
                   
                },
                mother_name: {
                    required: true,
                    minlength:3,
                    maxlength: 50,
                   
                },
                mobile: {
                    required: true,
                    minlength:6,
                    maxlength: 20,
                    
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 2,
                    maxlength: 100,
                    checkDuplicateEmail:true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                },
                retype_password: {
                    required: true,
                    equalTo:'#password'
                },
                gender: {
                    required: true,
                },
                country: {
                    required: true,
                },
                dob: {
                    required: true,
                    date:true,
                    
                },
                address: {
                    required: true,
                    minlength:2,
                    maxlength:200,
                   
                },

                 blood_group: {
                    required: true,
                  
                },
                local_guardian: {
                    required: true,
                  
                },
                contact_no: {
                    required: true,
                  
                },
                relation: {
                    required: true,
                  
                },
				medical_issue: {
                    required: true,
                  
                },
                condition: {
                    maxlength:20,
                    minlength:2
                  
                },
                identification_no: {
                    required: true,
                  
                },
                identification_office: {
                    maxlength:20,
                    minlength:2
                  
                },
                'source[]': {
                    required: true,
                },
               
            },


            submitHandler: function(form) {
                 
				form.submit();
        	}

        });
});



	

	//contact us form validation

 // $("#btnctactform").click(function() {

 

 //        $("#contact_forms").validate({

        

 //            errorElement: 'span',

	// 		errorClass:'text-danger',

	// 		//validClass:'success',

			  

	// 		highlight: function (element, errorClass, validClass) { 

	// 		  $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 

	// 		}, 

			

	// 		unhighlight: function (element, errorClass, validClass) { 

	// 			$(element).parents("div.form-group").removeClass('has-error'); 

	// 			$(element).parents(".error").removeClass('has-error').addClass('has-success'); 

	// 		},

			

 //            rules: {

	// 			name: {

 //                    required: true,

 //                    minlength: 2,

 //                    maxlength: 50

 //                },

               

	// 			email: {

 //                    required: true,

 //                    email: true,

 //                    minlength: 2,

 //                    maxlength: 50

 //                },

 //                contactno: {

 //                    required: true,

 //                    contactno:true,

 //                    minlength: 2,

 //                    maxlength: 50

 //                },

               

               

 //                message: {

 //                	required: true,

 //                    minlength: 50,

 //                    maxlength: 250



 //                }

 //            },



 //            messages: {

	// 			name: {

 //                    required: errorMessage.required,

 //                },

 //                email: {

 //                    required: errorMessage.required,

 //                    email: errorMessage.email,

 //                },

 //                contactno: {

 //                	required: errorMessage.required

					

 //                },

 //                message: {

 //                    required: errorMessage.required,

					

 //                },

                

 //            },

 //            submitHandler: function(form) {

	// 			form.submit();

 //            	// return false;

 //        	}

 //        });

 //    });



 //    //signup form validation ends here	



 //    $("#signInBtn").click(function() {

 //        $("#signInForm").validate({



 //            errorElement: 'p',

	// 		errorClass:'text-danger',

	// 		//validClass:'success',

			  

	// 		highlight: function (element, errorClass, validClass) { 

	// 		  $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 

	// 		}, 

			

	// 		unhighlight: function (element, errorClass, validClass) { 

	// 			$(element).parents("div.form-group").removeClass('has-error'); 

	// 			$(element).parents(".error").removeClass('has-error').addClass('has-success'); 

	// 		},

			

 //            rules: {

	// 			email: {

 //                    required: true,

 //                    email: true,

	// 				//checkEmailExistence : true

 //                },

	// 			password: {

	// 				required:true,

	// 			}

 //            },



 //            messages: {

	// 			email: {

 //                    required: errorMessage.required,

 //                    email: errorMessage.email,

	// 				//checkEmailExistence : errorMessage.emailDoesnotExist

 //                },

 //                password: {

 //                    required: errorMessage.required,

 //                },

 //            },



 //            submitHandler: function(form) {



 //                jQuery.ajax({

 //                    type: "POST",

 //                    url: urlUserLogin,

 //                    datatype: 'json',

 //                    data: $('form#signInForm').serialize(),

	// 				beforeSend: function(){ 

	// 					$('#signInBtn').html('Signing In');

	// 					$('#signInBtn').attr('disabled',true);

	// 				},

	// 				success: function(json) {

	// 					data = jQuery.parseJSON(json);

						

	// 					$('#signInBtn').html('Sign In');

	// 					$('#signInBtn').removeAttr('disabled');

						

 //                        if (data.status == 'success') {

	// 						$('#loginRegisterResponse').css('display','inline-block');

	// 						$('#loginRegisterResponse').removeClass('error').addClass('success');

	// 						$('#loginRegisterResponse').html(data.message);

	// 						$("#signInForm").trigger('reset');

							

	// 						setTimeout(function(){

	// 							//remove class and html contents

	// 							$("#loginRegisterResponse").html('');

	// 							$("#loginRegisterResponse").css("display", "none");

	// 							//redirect to users my account

	// 							//window.location.href = site_url;

	// 							//window.location.href = site_url + 'my-account/user/index';

	// 							window.location.href = data.return_url;

	// 						},3000);

	// 					} else {

 //                           	$('#loginRegisterResponse').css('display','inline-block');

	// 						$('#loginRegisterResponse').removeClass('success').addClass('error');

	// 						$('#loginRegisterResponse').html(data.message);

	// 					}

						

	// 					setTimeout(function(){

	// 						//remove class and html contents

	// 						$("#loginRegisterResponse").html('');

	// 						$("#loginRegisterResponse").css("display", "none");

	// 					},3000);

	// 				}

 //                });

 //                return false;

 //            }

 //        });

 //    });	

	

	// //contact us form validation

 //    $("#forgotPasswordBtn").click(function() {

	// 	//console.log('forgotPasswordBtn');

		

 //        $("#forgotPasswordForm").validate({

			

 //            errorElement: 'p',

	// 		errorClass:'text-danger',

	// 		//validClass:'success',

			  

	// 		highlight: function (element, errorClass, validClass) { 

	// 		  $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 

	// 		}, 

			

	// 		unhighlight: function (element, errorClass, validClass) { 

	// 			$(element).parents("div.form-group").removeClass('has-error'); 

	// 			$(element).parents(".error").removeClass('has-error').addClass('has-success'); 

	// 		},

			

 //            rules: {

	// 			email: {

 //                    required: true,

 //                    email: true,

	// 				//checkEmailExistence : true

 //                }

 //            },



 //            messages: {

	// 			email: {

 //                    required: errorMessage.required,

 //                    email: errorMessage.invalid_email,

	// 				//checkEmailExistence : errorMessage.emailDoesnotExist

 //                },

 //            },



 //            submitHandler: function(form) {



 //                jQuery.ajax({

 //                    type: "POST",

 //                    url: urlForgotPassword,

 //                    datatype: 'json',

 //                    data: $('form#forgotPasswordForm').serialize(),

	// 				beforeSend: function(){ 

	// 					$('#forgotPasswordBtn').html('Resetting Password');

	// 					$('#forgotPasswordBtn').attr('disabled',true);

	// 				},

	// 				success: function(json) {

	// 					data = jQuery.parseJSON(json);

						

	// 					$('#forgotPasswordBtn').html('Reset Password');

	// 					$('#forgotPasswordBtn').removeAttr('disabled');

						

 //                        if (data.status == 'success') {

 //                            $('#loginRegisterResponse').css('display','inline-block');

	// 						$('#loginRegisterResponse').removeClass('error').addClass('success');

	// 						$('#loginRegisterResponse').html(data.message);

							

 //                     	} else {

 //                           	$('#loginRegisterResponse').css('display','inline-block');

	// 						$('#loginRegisterResponse').removeClass('success').addClass('error');

	// 						$('#loginRegisterResponse').html(data.message);

	// 					}

						

	// 					setTimeout(function(){

	// 						//remove class and html contents

	// 						$("#loginRegisterResponse").html('');

	// 						$("#loginRegisterResponse").css("display", "none");

	// 					},3000);

	// 				}

 //                });

 //                return false;

 //            }

 //        });

 //    });

