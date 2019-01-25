$(function()
{

/*adding dynamic outlet input field in dealer management */
$(document).on('click','.add_product',function(e) 
{
  var cur=$(this);
  
  if($(this).attr('disabled')!=='disabled')
  {

      $additionhtml=$('.salesreportelement').last().clone();
     
      var count=$('.tbodyaddsales').find('tr').length;

      $additionhtml.find('.snoaddelemennt').html(count+1+'.');
      $additionhtml.find('.inputelement').each(function()
     {
        // var id=$(this).attr('id');

        // var newid = id.substring(0, id.indexOf("_"));
        // $(this).attr('id',newid+'_'+(count+1));
        if(count==4)
        {
            cur.attr('disabled',true);
        }

        var name=$(this).attr('name');
        var newname = name.substring(0, name.indexOf("["));
        $(this).attr('name',[newname]+"[a"+count+"]");
      })
      $additionhtml.find('input').each(function(){
      
        if($(this).attr('readonly')!='readonly'){
          $(this).val('');
        }
      });
      $additionhtml.find('.imeierror').remove();
      // console.log($additionhtml);
      $additionhtml.clone().appendTo('.tbodyaddsales');
  }

   
});

/*******************Remove dynamic added input form**********************************/
$(document).on('click','.delete_report',function(e) 
{
  e.preventDefault();
  var count=$('.tbodyaddsales').find('tr').length;
  if(count==1)
  {
       $('.tbodyaddsales tr').find('input').each(function(){
        $(this).val('');
      })
  }
  else
  {
     $(this).parent('td').parent('tr').remove();
  }
  var i=1;
  $('.snoaddelemennt').each(function(){
    $(this).html(i);
    i++;
  })
    $('.snoaddelemennt').each(function(){
    $(this).html(i);
    i++;
   })

});


  var imeifirst8='';
  var selectbtn='';
  $(document).on('change','#submitsalesmodelname',function(e){
  e.preventDefault();
    if(imeifirst8!='')
    {
       if(!confirm('You are about to change the model. Your records will be clear once you reselect another model.'))
      {
       selectbtn.prop('selected',true);
        return false;
      }
    }
   
      $('.inputelement').val('');
      selectbtn= $("#submitsalesmodelname option:selected");
       var current=$(this);
       imeifirst8 = $('option:selected', this).attr('data-imei8');
       $('.img-loader').removeClass('hidden');
      setTimeout(function(){
           $('.imei8digits').attr('readonly',false);
           $('.imei8digits').val(imeifirst8);
           $('.imei8digits').attr('readonly',true);
           $('.img-loader').addClass('hidden');
      },1000)    
  })  
  $(document).on('focusout','.submitsalesimei',function(){
     var current=$(this);
     var imei=$(this).val();
    var imeifirst8=$(this).parents('tr').find('.imei8digits').val();
     $('.multipleimeierror').remove();
     $('.img-loader').removeClass('hidden');
     var modelname=$('#submitsalesmodelname').val();
     current.parents('tr').find('.productid').val('');
     if(modelname=='' || modelname==undefined )
     {      
                  $('.img-loader').addClass('hidden');
                  $('.modelerror').remove();
                  $('#submitsalesmodelname').after('<span  class="modelerror text-danger">No model Selected</div>');
                    setTimeout(function(){
                      $('.modelerror').remove();
                    },2000);
                  return false;
                  
     }
     $('.submitsalesimei').not(current).each(function(){
      if($(this).val()==imei)
      {       
                $('.img-loader').addClass('hidden');
               $(current).after('<span  class="multipleimeierror text-danger">Cannot key in same IMEI-No twice</div>');
                    // setTimeout(function(){
                     
                    //   $(current).val('');
                    // },2000);
        return false;
      }
     })

    $.ajax({
            url: getproduct+'/'+modelname+'/'+imeifirst8+imei, // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            dataType:'json',
            
            success: function(data)   // A function to be called if request succeeds
            {  
          
                if(data.error_message)
                {
                  $('.imeierror').remove();
                  current.after('<span  class="imeierror text-danger">'+data.error_message+'</div>');
                  current.val('');
                }
                else
                {
                 var color=data.color;
                   $('.imeierror').remove();
                 (current.parents('tr').find('.submitsalescolor').val(color));
                 current.parents('tr').find('.productid').val(data.id);
                  
                }
                $('.img-loader').addClass('hidden');
            }
      });
  }) 

   $.validator.addMethod("checksoldIMEI", function (value, element) {
  var availability = '';
  var url=checkproductavailable;
  
  $.ajax({
    type : 'POST',
    url : url,
    data : {
      imei : imeifirst8+value
    },
    async : false,
    success : function (data) {
      if (data != '' || data != undefined || data != null) {
        availability = data.trim();
      }
    }
  });
  return this.optional(element) || (availability == 'available');
}, "The IMEI Number does not exist or has been taken");
  //Addition of news and promotion
  $("#submitsalesbtn").click(function(e) {
    // e.preventDefault();

      var validator= $("#submitsalesform").validate({
        errorElement: 'span',
        errorClass:'text-danger',
        highlight: function (element, errorClass, validClass) { 
          $(element).parents("div.form-group").addClass('has-error').removeClass('has-success'); 
        }, 
        unhighlight: function (element, errorClass, validClass) { 
               
          $(element).parents("div.form-group").removeClass('has-error'); 
          $(element).parents(".error").removeClass('has-error').addClass('has-success'); 
        },
         rules: 
           {
               model: 
                {
                    required: true
                },
                outlet: 
                {
                    required: true,
                },
               
                 invoiceno:
                {
                  required: true,
                  maxlength:15
                }

          },
            submitHandler: function(form) {
           // $('i.createcheck').addClass('hidden');
            $('.img-loader').removeClass('hidden');
            setTimeout(function(){
              form.submit();
            },1000);
        //     $('#create_news_promotion').attr('disabled',true);
        // $.ajax({
        //     url: createnews, // Url to which the request is send
        //     type: "POST",             // Type of request to be send, called as method
        //     data: new FormData(form), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        //     contentType: false,       // The content type used when sending data to the server.
        //     cache: false,             // To unable request pages to be cached
        //     processData:false,        // To send DOMDocument or non processed data file it is set to false
        //     dataType:'json',
        //     success: function(data)   // A function to be called if request succeeds
        //     {
        //       console.log(data);
        //          $('.modal').modal('hide');
        //           if(data.success_message)
        //           {
        //              $('.overlay_alert').removeClass('hidden');
        //              $('.overlay_alert').addClass('success');
        //              $('.overlay_alert').html(data.success_message);
        //           }
        //           else
        //           {
        //              $('.overlay_alert').removeClass('hidden');
        //              $('.overlay_alert').addClass('error');
        //              $('.overlay_alert').html(data.error_message);
        //           }
        //           $('#create_news_promotion').data('type','create');
        //           $('#create_news_promotion').attr('disabled',false)
                
        //           $('.img-loader').addClass('hidden');
        //             setTimeout(function(){
        //             $('.overlay_alert').addClass('hidden');
        //             $('.overlay_alert').removeClass('success');
        //             $('.overlay_alert').removeClass('error');
        //              $('.overlay_alert').html('');
                    
        //             },5000);
        //     }
        //     });
          }

      
       // $(document).on('hidden.bs.modal','#my_news_promo', function () {
       //         validator.resetForm();

    }); 
});
})