  $(function()
{
  $(document).on('click','.approveusers',function(e) {
       var userid=$(this).data('userid');
       $('.img-loader').removeClass('hidden'); 
       $('#approve_users_modal').modal('show');
               
      $.ajax({
                      url: studentdetail+'/'+userid, // Url to which the request is send
                      type: "POST",             // Type of request to be send, called as method
                      dataType:'json',
                      success: function(data)   // A function to be called if request succeeds
                      {
                          JSON.stringify(data);
                          if(data.error_message)
                          {
                              $('.overlay_alert').removeClass('hidden');
                              $('.overlay_alert').addClass('success');
                              $('.overlay_alert').html(data.error_message);  
                          }
                          else
                          {
                            console.log(data);
                              $('#pop-local_guardian_name_contact').val(data[0].local_guardian_name_contact);
                              $('#pop-first_name').val(data[0].first_name);
                              $('#pop-last_name').val(data[0].last_name);
                              $('#pop-email').val(data[0].email);
                              $('#pop-mobile').val(data[0].mobile);
                              $('#pop-faculty').val(data[0].faculty);
                              $('#pop-college_name').val(data[0].college_name);
                              $('#pop-paddress').val(data[0].paddress);
                              $('#pop-relation').val(data[0].relation_local_guardian);
                              // $('#pop-address2').val(data[0].address2);
                              if(data[0].gender=='M') $('#pop-gender').val('Male');
                              else if(data[0].gender=='F') $('#pop-gender').val('Female') ;
                              else $('#pop-gender').val('Others') ;

                              $('input[name="medical_issue_name"]').val(data[0].medical_issue);
                               $('#pop-medical_issue_name').val(data[0].medical_issue_name);
                              $('#pop-dob').val(data[0].dob);
                              $('#pop-source').val(data[0].source);
                              $('#pop-blood_group').val(data[0].blood_group);
                              $('#pop-identification').val(data[0].identification_no);
                              $('#pop-identificationoff').val(data[0].identification_office);
                              $('#pop-father_name').val(data[0].father_name);

                              $('#pop-mother_name').val(data[0].mother_name);
                              $('#pop-status').val(data[0].status).change();
                              $('#pop-guardian_phone').val(data[0].guardian_phone);
                              $('#pop-type').val(data[0].type);
                              $('#parentuserid').val(userid);

                               $('#pop-monthly_charges').val(data[0].monthly_charge);
                              $('#pop-admission_charge').val(data[0].admission_charge);
                              $('#pop-room_no').val(data[0].room_no);
                              $('#pop-join_date').val(data[0].join_date);
                             // $('#add-edit-product').modal('show');
                             $('.nodisable').attr('disabled',false);
                          } 
                          $('.img-loader').addClass('hidden');
                          setTimeout(function(){
                              $('.overlay_alert').addClass('hidden');
                              $('.overlay_alert').removeClass('error');
                              $('.overlay_alert').removeClass('success');
                          },5000);
             
                             
                      }

              });
    })

   $(document).on('click','#approveuserbtn',function(e) {
     $("#update_profile").validate({
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
                    minlength: 6,
                    maxlength: 15
                },
                retype_password: {
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

                identification_no: {
                    required: true,
                  
                },
                identification_office: {
                    maxlength:20,
                    minlength:2
                  
                },
                identification_doc:{
                accept: 'jpg|png|gif|jpeg'
                },
                room_no: {
                    number:true,
                    required:true
                  
                },
                monthly_charge: {
                    number:true,
                   required:true
                },
                // admission_charge: {
                //    number:true,
                //    required:true

                  
                // },
                join_date: {
                    required:true,
                    date:true
                  
                },
                'properties_handed[]': {
                    required:true
                },
                'source[]': {
                    required: true,
                },
               
            },


            submitHandler: function(form) {
                 
                form.submit();
          }

        });
     
    })
   $(document).on('click','#cancelbtn',function(e) {
      $('.modal').modal('hide');
   })
})