
$(document).ready(function()
{

    /********************************Zoom image********************************************/
        var modal = document.getElementById('imgmodal');
        var modalImg = document.getElementById("imagebody");
        var captionText = document.getElementById("caption");
        $(document).on('click','#myImg',function()
        {
            modal.style.display = "block";
            modalImg.src = $(this).data('src');
            captionText.innerHTML =$(this).data('alt');
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() 
            { 
                modal.style.display = "none";
            }
        })
        
    /**************************************************************************************/
 /**********************Approve student**********************************************/
 $(document).on('click','.approveusers',function(e) {
    e.preventDefault();
    var userid=$(this).data('userid');
       $('.img-loader').removeClass('hidden'); 
       $('#approve_users_modal').modal('show');
       var type=$(this).data('type');         
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
                              $('.img-loader').addClass('hidden'); 
                              $('#parentuserid').val(userid);
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
                              $('#pop-guardian_phone').val(data[0].guardian_phone);
                              $('#pop-type').val(data[0].type);
                              $('#parentuserid').val(userid);
                              // console.log(data[0].properties_handed);
                              var properties_handed=data[0].properties_handed.split(',');
                              $.each(properties_handed,function(i,v){
                                // console.log(v);
                                $('.prophanded:checkbox[value="'+v+'"]').prop('checked',true);
                              })
                              $('#myImg').attr('data-src',documentattachmentpath+'/'+data[0].user_id+'/'+data[0].identification_doc);
                              $('#pop-monthly_charges').val(data[0].monthly_charge);
                              $('#pop-admission_charge').val(data[0].admission_charge);
                              $('#pop-room_no').val(data[0].room_no);
                              $('#pop-join_date').val(data[0].join_date);
                              if(data[0].status=='0' || data[0].status=='2')
                              {
                                status=2;
                              }
                              else{
                                status=data[0].status;
                              }
                              $('#pop-status').val(status).change() ;
                             // $('#add-edit-product').modal('show');
                             $('.nodisable').attr('disabled',false);
                             if(type=='view')
                             {
                              $('.nonvisible').addClass('hidden');
                              $('.visible').css({"outline": "0","border-width": "0 0 2px","border-color": "blue"});
                             }
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
                paddress: {
                    required: true,
                    minlength:2,
                    maxlength:200,
                   
                },

                 blood_group: {
                    required: true,
                  
                },
                local_guardian_name_contact: {
                    required: true,
                    maxlength:20
                  
                },
                guardian_phone: {
                    required: true,
                    maxlength:15
                  
                },
                relation_local_guardian: {
                    required: true,
                    maxlength:20,
                    minlength:2 
                  
                },

                identification_no: {
                    required: true,
                    maxlength:20
                  
                },
                identification_office: {
                    maxlength:20,
                    minlength:2,
                    required:true
                  
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
                admission_charge: {
                   number:true,
                   required:true


                },
                join_date: {
                    required:true,
                    date:true
                  
                },
                status: {
                    required:true,
                    
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
 /***********************************************************************************/
 /***************Approve user from admin in staff management****************************/
    // $(document).on('click', '.approveusers', function (e) {
    //     var userid = $(this).data('userid');
    //     $('.img-loader').removeClass('hidden');
    //     $('#approve_users_modal').modal('show');
    //     $.ajax({
    //         url: staffdetails + '/' + userid, // Url to which the request is send
    //         type: "POST", // Type of request to be send, called as method
    //         dataType: 'json',
    //         success: function (data)   // A function to be called if request succeeds
    //         {
    //             JSON.stringify(data);
    //             if (data.error_message)
    //             {
    //                 $('.overlay_alert').removeClass('hidden');
    //                 $('.overlay_alert').addClass('success');
    //                 $('.overlay_alert').html(data.error_message);
    //             } else
    //             {
    //                 console.log(data[0].dealer_name);
    //                 $('#pop-display_name').val(data[0].display_name);
    //                 $('#pop-first_name').val(data[0].first_name);
    //                 $('#pop-last_name').val(data[0].last_name);
    //                 $('#pop-email').val(data[0].email);
    //                 $('#pop-nric').val(data[0].nric);
    //                 $('#pop-address').val(data[0].address);
    //                 $('#pop-address2').val(data[0].address2);
    //                 if (data[0].gender == 'M')
    //                     $('#pop-gender').val('Male');
    //                 else if (data[0].gender == 'F')
    //                     $('#pop-gender').val('Female');
    //                 else
    //                     $('#pop-gender').val('Others');
    //                 $('#pop-country').val(data[0].country);
    //                 $('#pop-dob').val(data[0].dob);
    //                 $('#pop-postal_code').val(data[0].postal_code);
    //                 $('#pop-dealer').val(data[0].dealer_name);
    //                 $('#pop-outlet').val(data[0].outlet);
    //                 $('#pop-phone').val(data[0].phone);
    //                 $('#pop-type').val(data[0].type);
    //                 $('#approveuserbtn').attr('data-userid', userid);
    //                 // $('#add-edit-product').modal('show');
    //             }
    //             $('.img-loader').addClass('hidden');
    //             setTimeout(function () {
    //                 $('.overlay_alert').addClass('hidden');
    //                 $('.overlay_alert').removeClass('error');
    //                 $('.overlay_alert').removeClass('success');
    //             }, 5000);
    //         }
    //     });
    // })
    
     /***************Approve user from admin in staff management****************************/
    $(document).on('click', '.viewuserdetails', function (e) {
        e.preventDefault();
        var userid = $(this).data('userid');
        $('.img-loader').removeClass('hidden');
        $('.viewusers').modal('show');
        $.ajax({
            url: stdetails + '/' + userid, 
            type: "POST",
            dataType: 'json',
            success: function (data) 
            {
                JSON.stringify(data);
                if (data.error_message)
                {
                    $('.overlay_alert').removeClass('hidden');
                    $('.overlay_alert').addClass('success');
                    $('.overlay_alert').html(data.error_message);
                } else
                {
                    // $('#pop-display_name').val(data[0].display_name);
                    $('#pop-first_name').val(data[0].first_name);
                    $('#pop-last_name').val(data[0].last_name);
                    $('#pop-email').val(data[0].email);
                    $('#pop-nric').val(data[0].nric);
                    $('#pop-address').val(data[0].address);
                    $('#pop-address2').val(data[0].address2);
                    if (data[0].gender == 'M')
                        $('#pop-gender').val('Male');
                    else if (data[0].gender == 'F')
                        $('#pop-gender').val('Female');
                    else
                        $('#pop-gender').val('Others');
                    $('#pop-country').val(data[0].country);
                    $('#pop-dob').val(data[0].dob);
                    $('#pop-postal_code').val(data[0].postal_code);
                    $('#pop-dealer').val(data[0].dealer_name);
                    $('#pop-outlet').val(data[0].outlet);
                    $('#pop-phone').val(data[0].phone);
                    $('#pop-type').val(data[0].type);
                    $('#approveuserbtn').attr('data-userid', userid);
                    // $('#add-edit-product').modal('show');
                }
                $('.img-loader').addClass('hidden');
                setTimeout(function () {
                    $('.overlay_alert').addClass('hidden');
                    $('.overlay_alert').removeClass('error');
                    $('.overlay_alert').removeClass('success');
                }, 5000);
            }
        });
    })
    /************* checkbox all click****************/
    $(document).on('change', ':checkbox.alldealer', function ()
    {
        $(':checkbox.checkboxindividual').prop('checked', this.checked);
        if (this.checked === true)
        {
            $('.multipleselect').removeClass('hidden');
        } else {
            $('.multipleselect').addClass('hidden');
        }
    });

    /****************Add or edit news**********************/
    $(document).on('click', '.click_news_add_edit', function () {
        $('#createnewsform')[0].reset();
        $('#brwose-image').html('');
        var parentid = $(this).data('id');
        var type = $(this).data('type');
        $('#newstype').val(type);
        if (parentid === undefined || parentid === false || parentid == '')
        {
            $('#my_news_promo').modal('show');
            $('#newsid').val('');
            $('#create_news_promotion').attr('data-savetype', 'add');
        } else
        {
            $('#create_news_promotion').attr('data-savetype', 'edit');
            $('#my_news_promo').modal('show');
            $('#newsid').val(parentid);
            $('.img-loader').removeClass('hidden');
            $('#create_news_promotion').attr('disabled', true);
            $.ajax({
                url: getnews + '/' + parentid, // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                dataType: 'json',
                success: function (data)   // A function to be called if request succeeds
                {
                    JSON.stringify(data);
                    if (data)
                    {
                        $('#newstitle').val(data.title);
                        $('#newsdescription').val(data.description);
                        $('#brwose-image').html('<img src="' +  data.image + '">');
                         $('#newsurl').val(data.url)
                    } else {
                        $('#newsid').val('')
                    }
                    $('.img-loader').addClass('hidden');
                    $('#create_news_promotion').attr('disabled', false);
                }

            })
        }

    });
    jQuery.validator.addMethod("uploadimage", function (value, element) {
        var type = $('#create_news_promotion').data('savetype');

        if (type != 'edit')
        {
            if ($.trim(value) == '' || $.trim(value) == false || $.trim(value) == undefined || $.trim(value) == null)
            {
                return false;
            } else
            {
                return true;
            }
        } else
        {
            return true;
        }
    }, "This field is required");

    /*************************Addition of news and promotion***************************/
    $("#create_news_promotion").click(function (e) {
        // e.preventDefault();

        var validator = $("#createnewsform").validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {

                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules:
                    {
                        title:
                                {
                                    required: true,
                                    maxlength: 200
                                },
                        description:
                                {
                                    required: true,
                                    maxlength: 800
                                },
                        url:
                                {
                                  checkhyperlink:true
                                },
                        uploadimage:
                                {
                                    uploadimage: true,
                                    accept: 'jpg|png|gif|jpeg'
                                }
                    },
            submitHandler: function (form) {
                // $('i.createcheck').addClass('hidden');
                $('.img-loader').removeClass('hidden');
                $('#create_news_promotion').attr('disabled', true);
                $.ajax({
                    url: createnews, // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    dataType: 'json',
                    success: function (data)   // A function to be called if request succeeds
                    {
                        // console.log(data);
                        $('.modal').modal('hide');
                        if (data.success_message)
                        {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('success');
                            $('.overlay_alert').html(data.success_message);
                        } else
                        {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('error');
                            $('.overlay_alert').html(data.error_message);
                        }
                        $('#create_news_promotion').data('type', 'create');
                        $('#create_news_promotion').attr('disabled', false)

                        $('.img-loader').addClass('hidden');
                        setTimeout(function () {
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('success');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').html('');

                        }, 5000);
                    }
                });
            }
        });
        $(document).on('hidden.bs.modal', '#my_news_promo', function () {
            validator.resetForm();

        });
    });

    /*******************to browse image while adding news & promotion***************/
    $("#fileUpload").on('change', function ()
    {
        if (typeof (FileReader) != "undefined") {
            var size = (this.files[0].size);
            var image_holder = $("#brwose-image");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                // alert(this.width+'-->'+this.height);
                var img = new Image;
                img.src = e.target.result;
                $(img).appendTo(image_holder);
                // alert(img.files[0].size);
                img.onload = function () {
                    // access image size here 
                    var width = this.width;
                    var height = this.height;
                    var sizemb = size / (1024 * 1024);
                    if (width >= 2000 || height >= 2000 || sizemb > 2)
                    {
                        $('.overlay_alert').removeClass('hidden');
                        $('.overlay_alert').addClass('error');
                        $('.overlay_alert').html('Image must be of dimensions not exceeding 2000*2000 px and size not exceeding 4Mb.');
                        setTimeout(function () {
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').removeClass('success');
                            $('.overlay_alert').html('');
                        }, 5000);
                        image_holder.empty();
                        $("#fileUpload").val('');
                        return false;
                    }

                };
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("This browser does not support FileReader.");
        }
    });

    // /******************Edit dealer*******************/
    $(document).on('click', '#editdealerbtn', function (e) {
        var dealerid = $('.filterdealer').val();
        var url = $(this).data('url');
        window.location.replace(url);
    })

    /******************Add dealer*******************/
     $(document).on('click', '#addstaffbtn', function (e) {           
        var validator = $("#addstaffform").validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass)
            {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass)
            {
                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
           rules:
                {
                    password:{
                         required:true,
                         minlength: 6,
                         maxlength: 15
                    },
                    retype_password:{
                         required:true,
                         equalTo: '#password'
                    },
                    first_name:{
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    last_name:{
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    identification_no:{
                        required: true,
                        minlength:3,
                        maxlength:15
                    },
                    identification_office:{
                        required: true,
                        minlength:3,
                        maxlength:15
                    },
                    dob:{
                        required: true,
                        date:true,
                    },
                    mobile:{
                        required: true,
                        
                    },
                    username:{
                         required: true,
                        minlength: 6,
                        maxlength: 20,
                        checkDuplicateUsername: true

                    },
                    email:{
                         required: true,
                        email: true,
                        minlength: 2,
                        maxlength: 100,
                        checkDuplicateEmail: true
                    },
                    address:{
                        required: true,
                        minlength: 6,
                        maxlength: 100,
                       

                    },
                    blood_group:{
                         required: true,
                    },
                    join_date:{
                        required: true,
                        date:true
                       

                    },
                    monthly_charge:{
                         required: true,
                         number:true
                    }

                },   
        
            submitHandler: function (form) {
                form.submit();
            },
        })
        validator.resetForm();
    })


       /******************Edit dealer*******************/
     $(document).on('click', '#editactiondealerbtn', function (e) {   
      // e.preventDefault();
        var validator = $("#adddealerform").validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass)
            {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass)
            {
                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules:
                {
                    password:{
                         minlength: 6,
                         maxlength: 15
                    },
                    retype_password:{
                         equalTo: '#password'
                    },
                     dealer_name:{
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    operator:{
                        required: true,
                    },
                    username:{
                         required: true,
                        minlength: 6,
                        maxlength: 20,
                        checkDuplicateUsername: true

                    },
                    email:{
                         required: true,
                        email: true,
                        minlength: 2,
                        maxlength: 100,
                        checkDuplicateEmail: true
                    }

                }  ,
        
            submitHandler: function (form) {
                form.submit();
            },
        })
        validator.resetForm();
    })
    $(document).on('click', '.click-to-add-product', function () {  

        $('#addcustomer').attr('datatype', 'add');
        $('#productid-prod').val('');
        $('#addproductform')[0].reset();
        $('#add-edit-product').modal('show');
    })

    // /******************Add product validation**********************************/
    $(document).on('click', '#addcustomer', function () {
        var addtype = $('#addcustomer').attr('datatype');
        var productid = $('#productid-prod').val();
        var validator = $('#addproductform').validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {

                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules: {
                customer_name: {
                        required: true,
                        maxlength: 50,
                   
                },
                address: {
                    required: true,
                    maxlength:50
                  
                },
                phone: {
                    required: true,
                    maxlength: 15,
                    
                },
                fat_rate: {
                    required: true,
                    number: true,
                    maxlength:5
                },
                snf_rate: {
                    required: true,
                    number: true,
                     maxlength:5
                },
                rate: {
                    required: true,
                    number: true,
                     maxlength:5
                },
                commission_rate:{
                  required:true ,
                  number: true,
                   maxlength:5
                }   
        },
            submitHandler: function (form) {
                $('.img-loader').removeClass('hidden');

                $.ajax({
                    url: addmember  , // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    dataType: 'json',
                    data: $('#addproductform').serialize(),
                    success: function (data)   // A function to be called if request succeeds
                    {
                        console.log(data.success_message);
                        JSON.stringify(data);

                        if (data.success_message)
                        {

                            $('.overlay_alert').addClass('success');
                            $('.overlay_alert').html(data.success_message);

                        } else {
                            $('.overlay_alert').addClass('error');
                            $('.overlay_alert').html(data.error_message);
                        }
                        $('.modal').modal('hide');
                        $('.overlay_alert').removeClass('hidden');
                        $('.img-loader').addClass('hidden');
                        $('#addcustomer').attr('disabled', false);
                        (form).reset();
                        // $('#sendmsg').modal('hide');
                        setTimeout(function () {
                            window.location.reload();
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').removeClass('success');
                        }, 3000);
                    }

                });
            }

        });
        $(document).on('hidden.bs.modal', '#add-edit-product', function () {
            validator.resetForm();
        });
    });




 $(document).on('click', '#addreceipt', function (e) {
          
        var validator = $('#addreceiptform').validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {

                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules: {
                milk: {
                        required: true,
                        number: true,
                   
                },
                lacto: {
                    required: true,
                    number:true
                  
                },
                fat: {
                    required: true,
                    number: true,
                    
                },
                date: {
                    required: true,
                    date: true,
                    
                },
                
        },
            submitHandler: function (form) {
                $('.img-loader').removeClass('hidden');

                $.ajax({
                    url: addreceipturl  , // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    dataType: 'json',
                    data: $('#addreceiptform').serialize(),
                    success: function (data)   // A function to be called if request succeeds
                    {
                        console.log(data.success_message);
                        JSON.stringify(data);

                        if (data.success_message)
                        {

                            $('.overlay_alert').addClass('success');
                            $('.overlay_alert').html(data.success_message);

                        } else {
                            $('.overlay_alert').addClass('error');
                            $('.overlay_alert').html(data.error_message);
                        }
                        $('.modal').modal('hide');
                        $('.overlay_alert').removeClass('hidden');
                        $('.img-loader').addClass('hidden');
                        $('#addcustomer').attr('disabled', false);
                        (form).reset();
                        // $('#sendmsg').modal('hide');
                        setTimeout(function () {
                            window.location.reload();
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').removeClass('success');
                        }, 2000);
                    }

                });
            }

        });
        $(document).on('hidden.bs.modal', '#addreceiptform', function () {
            validator.resetForm();
        });
    });

})


  
// /****************Populate form field on edit **********************/
$(document).on('click', '.edit_customer', function (e) {
    $('.img-loader').removeClass('hidden');
    // $('#add-edit-product').modal('show'); 
    var memberid = $(this).data('memberid');
    $.ajax({
        url: getmember + '/' + memberid, // Url to which the request is send
        type: "POST", // Type of request to be send, called as method
        dataType: 'json',
        success: function (data)   // A function to be called if request succeeds
        {
            // console.log(data);
            if (data.error_message)
            {
                $('.overlay_alert').removeClass('hidden');
                $('.overlay_alert').addClass('success');
                $('.overlay_alert').html(data.error_message);
            } else
            {
                $('#customer-id').val(data.id);
                $('#customername').val(data.customer_name);
                $('#address').val(data.address);
                $('#phone').val(data.phone);
                $('#fat-rate').val(data.fat_rate);
                
                $('#snf-rate').val(data.snf_rate);
                $('#rate').val(data.tc_rate);
                $('#commission').val(data.commission);
                $('#addcustomer').attr('datatype', 'edit');
                $('#add-edit-product').modal('show');
            }
            $('.img-loader').addClass('hidden');
            setTimeout(function () {
                $('.overlay_alert').addClass('hidden');
                $('.overlay_alert').removeClass('error');
                $('.overlay_alert').removeClass('success');
            }, 5000);


        }

    });
})


/*******************Upload excel data***************************/
 $("#exceluploadbtn").click(function (e) {
        // e.preventDefault();
        var validator = $("#exceluploadform").validate({
            errorElement: 'span',
            errorClass: 'text-danger',
            highlight: function (element, errorClass, validClass) 
            {
                $(element).parents("div.form-group").addClass('has-error').removeClass('has-success');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents("div.form-group").removeClass('has-error');
                $(element).parents(".error").removeClass('has-error').addClass('has-success');
            },
            rules:
                    {
                        excelupload:
                                {
                                    required: true,
                                    extension: 'xlsx,xls'
                                }
                    },
            submitHandler: function (form) {
                $('.img-loader').removeClass('hidden');
                $('#exceluploadbtn').attr('disabled', true);
                $.ajax({
                    url: form.action, // Url to which the request is send
                    type: "POST", // Type of request to be send, called as method
                    data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    dataType: 'json',
                    progress: function (event, position, total, percentComplete){ 
                        console.log(percentComplete);
                    // $("#progress-bar").width(percentComplete + '%');
                    // $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                    success: function (data)   // A function to be called if request succeeds
                    {
                        // console.log(data);
                        $('.modal').modal('hide');
                        if (data.success_message)
                        {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('success');
                            $('.overlay_alert').html(data.success_message);
                        } else
                        {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('error');
                            $('.overlay_alert').html(data.error_message);
                        }
                        $('#exceluploadbtn').attr('disabled', false)
                        $('.img-loader').addClass('hidden');
                        setTimeout(function () {
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('success');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').html('');
                             if (data.success_message)
                             {
                                 window.location.reload();
                             }
                             
                        }, 2000);

                    }
                });
            }
        });
           validator.resetForm();
    });
