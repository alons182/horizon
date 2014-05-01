


 $(function() {
	
	
	// NAV MOBILE
    $('#btn_nav').click(function(){
        $('#menu_backend').toggle();
    });

	$( "#cat" ).change(function() {

	 $(".filtros").find('form').submit();

	});
	$( "#status").change(function() {
		

	 $(".filtros").find('form').submit();

	});



	$("form[data-confirm]").submit(function() {
        if ( ! confirm($(this).attr("data-confirm"))) {
            return false;
        }
    });

    var photos=0;
	
	var new_photos = function()
	{
	 	
	 	div=document.getElementById("items");
	    button=document.getElementById("add");
	    photos++;
	    newitem="<strong>" + "Foto " + photos + ": </strong>";
	    newitem+="<input type=\"file\" name=\"new_photo_file[]";
	    newitem+="\" value=\"\"size=\"45\"><br>";
	    newnode=document.createElement("span");
	    newnode.innerHTML=newitem;
	    div.insertBefore(newnode,button);
	}
	 $("#add").on('click',new_photos);
  
    $("#UploadButton").ajaxUpload({
		url : "/admin/properties/savegallery",
		name: "file",
		data: {id: $('input[name=property_id]').val() },
		onSubmit: function() {
		    $('#InfoBox').html('Uploading ... ');
		},
		onComplete: function(result) {
		    
		   $('#InfoBox').html('Uploaded succesfull!');
			var urls = jQuery.parseJSON(result);

			
		    

		    if($('#gallery li').length == 0){
					$('#gallery').html('<li><span class="delete" data-imagen="'+urls.id_imagen+'"><img src="/img/delete.png" alt="delete" /></span><a href="/images_properties/'+ urls.url +'" data-lightbox="gallery"><img src="/images_properties/'+ urls.url_thumb + '" alt="img" /></a></li>').fadeIn("fast");
					$('#gallery li').eq(0).hide().show("slow");
				
				}else{
					$('#gallery').prepend('<li><span class="delete" data-imagen="'+urls.id_imagen+'"><img src="/img/delete.png" alt="delete" /></span><a href="/images_properties/'+ urls.url +'" data-lightbox="gallery"><img src="/images_properties/'+ urls.url_thumb + '" alt="img" /></a></li>');
					$('#gallery li').eq(0).hide().show("slow");
				}

			$('#gallery li .delete').on('click',function(){

					var a = $(this);

			        var datos = { property_id: $('input[name=property_id]').val(), imagen_id: a.attr("data-imagen")  }
					
					var url = "/admin/properties/deletegallery";
					$.post(url, datos , function(data){
				
										a.parent().fadeOut("slow");
				    });


			});

		}
	});

	$('#gallery li .delete').on('click',function(){

			var a = $(this);

	        var datos = { property_id: $('input[name=property_id]').val(), imagen_id: a.attr("data-imagen")  }
			
			var url = "/admin/properties/deletegallery";
			$.post(url, datos , function(data){

				a.parent().fadeOut("slow");
		    });


	});


});