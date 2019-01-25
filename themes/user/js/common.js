// //for chain type selector

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

/*******************Selecting multiple user************************/
	  $(document).on('change',':checkbox',function()
	  {
	  	if($(this).hasClass('alluser'))
	  		$(':checkbox.checkboxindividual').prop('checked', this.checked);
  		if(this.checked===true)
	  	{
	  		$('.multipleselect').removeClass('hidden');	
	  	}
	  	else{
	  		$('.multipleselect').addClass('hidden');	
	  	}
	  });



$(document).on('change','.filter',function(e){
		e.preventDefault();
		filterview(false);
	});
$(document).on('click','.filteroptname',function(e){
	e.preventDefault();
	// alert('here');
	filterview(false);
})
/*********for dealer tab in staff management and places whose filter depends on single id*******/
$(document).on('click','.userdetailtab',function(e){
	e.preventDefault();
	
		$('.userdetailtab').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');
		filterview($(this));
});

});
function filterview(curelement)
{	
		var curelement = curelement || false;
		var filterdealer=   $('.filterdealer').val();
		var status=$('.filterstatus').val();
		var model=$('.filtermodel').val();
		var fromdate=$('.filterfromdate').val();
		var todate=$('.filtertodate').val();
		var userid=$('.filteruserid').val();
		var outlet=$('.filteroutlet').val();
		var name= $('.filtername').val();
        var limit= $('.filterlimit').val();	
        var filterparams={};
		if(filterdealer)
		{
				filterparams.filterdealer=filterdealer;
		}
		if(curelement)
		{
			userdetailid=curelement.data('userid');
			filterparams.filteruserid=userdetailid;
			url=curelement.data('filterurluserdetail');
			var view=curelement.data('view');
		}else
		{
			url=filterurl;
		}
		if(model)
		{
			filterparams.filtermodel=(model);
		}
		if(fromdate){
			filterparams.filterfromdate=fromdate;
		}
		if(todate){
			filterparams.filtertodate=todate;
		}
		if(name){
			
			filterparams.filtername=name;
		}
		if(status)
		{
			filterparams.filterstatus=status;
		}
		if(limit)
		{
			filterparams.filterlimit=limit;
		}
		if(userid)
		{
			filterparams.filteruserid=userid;
		}
	
		$('.img-loader').removeClass('hidden');
		$.ajax({
						url: url, // Url to which the request is send
						type: "POST",             // Type of request to be send, called as method
						dataType:'html',
						data:filterparams,
						success: function(data)   // A function to be called if request succeeds
						{
							$('.img-loader').addClass('hidden');
								if(curelement)
								{
									$('.'+view).html('');
      					    		$('.'+view).html(data);
								}else{
									$('.filterview').html('');
      					    		$('.filterview').html(data);
								}
								
						}
			});
}

/***********for Delete confirm***********/
function doconfirm(){
	if(confirm('Are you sure you want to delete?'))
	{
		return true;
	}
	else
	{
		return false;
	}
}

/***********for Update confirm***********/
function doconfirmaccept(){
	if(confirm('Are you sure you want to Approve?'))
	{
		return true;
	}
	else
	{
		return false;
	}
}

function doconfirmreject(){
	if(confirm('Are you sure you want to Reject?'))
	{
		return true;
	}
	else
	{
		return false;
	}
}

	