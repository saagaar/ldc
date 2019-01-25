$(function(){
	$(document).on('click','#feedbackbtn',function(e) {
    
   var validator= $("#feedbackform").validate({
            errorElement: 'span',
            errorClass:'text-danger',
            highlight: function (element, errorClass, validClass) 
            { 
              $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
            }, 
            unhighlight: function (element, errorClass, validClass) 
            { 
              $(element).parents("div.form-group").removeClass('has-error'); 
              $(element).parents(".error").removeClass('has-error').addClass('has-success'); 
            },

             rules: {
                email: {
                    required: true,
                    minlength: 2,
                    maxlength: 100,
                    email:true
                },
               
                
                feedback_type: {
                    required: true,
                 },
                feedback: {
                    required: true,
                    minlength: 2,
                    maxlength: 100,
                    
                },
                file_source: {
                   required:true,
                   accept: 'jpg|png|gif|jpeg|pdf',

                },
             
            
    },
            submitHandler: function(form) {
             form.submit();
          },
           

        });

     // validator.resetForm();

 

})

})