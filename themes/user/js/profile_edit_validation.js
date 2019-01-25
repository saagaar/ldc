
$(document).ready(function () {

    $('#edit_profile_form').validate({// initialize the plugin
        errorElement: 'p',
        errorClass: 'text-danger',
        rules: {
            email: {
                required: true,
                email: true
            },
            first_name: {
                required: true,
                maxlength: 100
            },
            password1: {
                equalTo: '#password',
                maxlength: 15,
                minlength: 6
            },
            last_name: {
                required: true,
                maxlength: 50
            },
            display_name: {
                required: true,
                maxlength: 100
            },
            outlet: {
                required: true
            },
            address: {
                required: true,
                maxlength: 200
            },
            nric: {
                required: true,
                alphanumeric: true,
                maxlength: 20
            },
            address2: {
                required: true,
                maxlength: 200
            },
            introduction: {
                
                maxlength: 150
            },
            gender: {
                required: true
            },
            country: {
                required: true
            },
            date: {
                required: true
            },
            postal_code: {
                required: true
            },
            contact_no: {
                required: true,
                number: true,
                maxlength: 10
            },
            dealer: {
                required: true
            },
            img: {
//                required: true,
                extension: "jpg,jpeg,png",
//                filesize: 2000,
            }
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
            if (element.attr("name") === "img") {
                error.appendTo('#img_error');
                console.log('asdf');
            }
        },
        submitHandler: function (form) { // for demo

            jQuery.ajax({
                type: "POST",
                url: edit_profile_url,
                datatype: 'json',
                data: new FormData(form),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('.img-loader').removeClass('hidden');

                },
                success: function (json) {
                    console.log(json);

                    if (json) {
                        data = jQuery.parseJSON(json);
                        console.log(data);
                        if (data.error_message)
                        {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('error');
                            $('.overlay_alert').html(data.error_message);
                        } else {
                            $('.overlay_alert').removeClass('hidden');
                            $('.overlay_alert').addClass('success');
                            $('.overlay_alert').html(data.success_message);
                        }
                        $('.img-loader').addClass('hidden');
                        $('#myModal').modal('toggle');
                        setTimeout(function () {
                            $('.overlay_alert').addClass('hidden');
                            $('.overlay_alert').removeClass('error');
                            $('.overlay_alert').removeClass('success');
                        }, 8000);
                    }
                }
            });
            return false; // for demo
        }
    });




    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_p').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#img").change(function () {
        readURL(this);
    });
});