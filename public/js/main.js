 $(function() {
	
	
	//SLIDER BACKGROUND
	var $slideshow = $( '#fullscreen-slideshow' ),
		$items = $slideshow.children( 'li' ),
		itemsCount = $items.length;

	$slideshow.imagesLoaded( function() {
			
			if( Modernizr.backgroundsize ) {
				$items.each( function() {
					var $item = $( this );
					$item.css( 'background-image', 'url(' + $item.find( 'img' ).attr( 'src' ) + ')' );
				} );
			}
			else {
				$slideshow.find( 'img' ).show();
				// for older browsers add fallback here (image size and centering)
			}
			// show first item
			//$items.eq( current ).css( 'opacity', 1 );
			
			

		} );
	
	 // MENU PROYECTO
	$('#main-site #top a').click(function(){
		
	
		$('.slide:visible').hide();
		$('.slide_' + $(this).attr('data-target')).fadeIn(400);
		
		
		current = $(this).attr('data-target');
	});
	
	// ACTIVACION DEL MENU PROYECTO
		
	$('.btn_favorites').on('click',function(e) {
       e.preventDefault();
      

        var register = $(this).data('login');
        
        if (register == "register")
        {	
		        var defaultClass = $('.favoritos').find('.btn_favorites').hasClass('icon-heart');
		       
		        var url;
		         if(defaultClass)
		     		url = '/properties/savefavorites';
		     	else
		     		url = '/properties/deletefavorites';

		         $('.ajaxgif').removeClass('hidden');
		          var datos = 'id=' + document.getElementById('property_id').value;
		         $.ajax({
		              type: 'POST',
		              url: url,
		              data: datos,
		              success: function(res) {
		                $('.ajaxgif').hide();
		               
		             
		              
		               		if(defaultClass)
		               		{
		             			$('.favoritos').find('.btn_favorites').removeClass('icon-heart').addClass('icon-heart2');
		             			$('.favoritos > h2').text('Eliminar de tus favoritos');
		             		}
		             		else
		             			{
		             				$('.favoritos').find('.btn_favorites').removeClass('icon-heart2').addClass('icon-heart');
		             				$('.favoritos > h2').text('Agregar a tus favoritos');
		             			}
		               
		              
		              document.getElementById('message-favorites').innerHTML = res;

		              setTimeout(function(){  
					        $('#message-favorites').fadeOut(200,function() {

							    $('#message-favorites span').remove();
							    $('#message-favorites').show();
							    
							  });}, 2000);  
		               
		              },
		            error: function() {
		               $('.ajaxgif').hide(res);
		             
		              document.getElementById('message-favorites').innerHTML = res;
		                   
		            }
		            });
		}else
			document.getElementById('message-favorites').innerHTML = '<span class="ok">Debes iniciar sesion</span>';
         
       
      });

	 $('.btn_favorites_mini').on('click',function(e) {
       	e.preventDefault();
      	
      	var register = $(this).data('login');

       if (register == "register")
        {	
		        var defaultClass = $(this).hasClass('icon-heart');
		        var url;
		        var id = $(this).data('proid');
		         if(defaultClass)
		     		url = '/properties/savefavorites';
		     	else
		     		url = '/properties/deletefavorites';

		         $('.ajaxgif').removeClass('hidden');
		          var datos = 'id=' + id;
		         $.ajax({
		              type: 'POST',
		              url: url,
		              data: datos,
		              success: function(res) {
		              //	debugger;
		                $('.ajaxgif').hide();
		              
		                if(defaultClass)
		             		$('#pro-'+id).removeClass('icon-heart').addClass('icon-heart2');
		             	else
		             		$('#pro-'+id).removeClass('icon-heart2').addClass('icon-heart');
		              
		              },
		            error: function(res) {
		               $('.ajaxgif').hide();
		             
		              document.getElementById('message-favorites').innerHTML = res;
		            
		            }
		            });
		}
         
       
      });

	$("#RequestForm").validate({

	 	messages:
	 	{
	 		name:{
	 			required:'*'
	 		},
	 		email:{
	 			required:'*',
	 			email:'Invalid'
	 		},
	 		comments:{
	 			required:'*'
	 		}
	 		
	 	},
	 	rules: {
	 		
		    comments:{
		    	required: true
		    }

		  },

		  submitHandler: function(form) {

		    var formInput =  $('#RequestForm').serializeArray();
			var url = "/properties/requestproperty";
		
			$.post(url, formInput, function(data){
						console.log(data);
						limpiaForm($("#RequestForm"));

						if(data=="ok")
							$('.mensaje').html('<span class="ok">La solicitud fue enviada</span>');
						else
							$('.mensaje').html('<span class="error">Error enviando la solicitud</span>');


						setTimeout(function(){  
					        $('.mensaje').fadeOut(200,function() {

							    $('.mensaje span').remove();
							    $('.mensaje').show();
							    
							  });}, 2000);  
					});
		  

		  }

		 });

		// FUNCION LIMPIAR FORM
		 function limpiaForm(miForm) {
		    
		     // recorremos todos los campos que tiene el formulario
		     $(":input", miForm).each(function() {
		     var type = this.type;
		     var tag = this.tagName.toLowerCase();
		     //limpiamos los valores de los campos…
		    if (type == 'text' || type == 'password'  || type == 'email' || tag == 'textarea')
		    this.value = "";
		     // excepto de los checkboxes y radios, le quitamos el checked
		     // pero su valor no debe ser cambiado
		     else if (type == 'checkbox' || type == 'radio')
		    this.checked = false;
		     // los selects le ponesmos el indice a -
		     else if (tag == 'select')
		    this.selectedIndex = -1;
		     });
		}
	 
	
	$(".link-testimonial").on('click',function(e){
		e.preventDefault();
		
		$("#formulario-tesimonial").toggle('slow');
	
	});
	$(".link-login").on('click',function(e){
		e.preventDefault();
		
		$("#container-login").toggle();
	
	});
	$(".link-search").on('click',function(e){
		e.preventDefault();
		
		$("#container-search").toggle();

		var var_renta_compra = $("#search_mini input[type='radio']:checked").val();
		
		cambio_rango_precios(var_renta_compra);


	
	});

	$("input[name='cat']").change(function() {

		var var_renta_compra = $("#search_mini input[type='radio']:checked").val();
		
		cambio_rango_precios(var_renta_compra);
	});

	function cambio_rango_precios(var_renta_compra){

		var items_priced_rentar =  []; // my array
		 var items_priceh_rentar =  []; // my array
		 var items_priced_comprar =  []; // my array
		 var items_priceh_comprar =  []; // my array

		
		var precior1 = {
		        title: '$100',
		        value: '100' 
		    }
		var    precior2 = {
		        title: '$400',
		        value: '400' 
		    }
		var    precior3 = {
		        title: '$500',
		        value: '500' 
		    }
		var    precior4 = {
		        title: '$600',
		        value: '600' 
		    }
		var    precior5 = {
		        title: '$700',
		        value: '700' 
		    }
		 var   precior6 = {
		        title: '$800',
		        value: '800' 
		    }
		var    precior7 = {
		        title: '$900',
		        value: '900' 
		    }
		var    precior8 = {
		        title: '$1,000',
		        value: '1000' 
		    }
		var    precior9 = {
		        title: '$400',
		        value: '400' 
		    }
		 var    precior10 = {
		        title: '$500',
		        value: '500' 
		    }
		 var    precior11 = {
		        title: '$600',
		        value: '600' 
		    }
		 var    precior12 = {
		        title: '$700',
		        value: '700' 
		    }
		 var    precior13= {
		        title: '$800',
		        value: '800' 
		    }

		 var    precior14 = {
		        title: '$900',
		        value: '900' 
		    }
		 var    precior15 = {
		        title: '$1,000',
		        value: '1000' 
		    }
		 var    precior16 = {
		        title: '+ $1,000',
		        value: '1000000' 
		    }
		    
		 items_priced_rentar.push(precior1);
		 items_priced_rentar.push(precior2);
		 items_priced_rentar.push(precior3);
		 items_priced_rentar.push(precior4);
		 items_priced_rentar.push(precior5);
		 items_priced_rentar.push(precior6);
		 items_priced_rentar.push(precior7);
		 items_priced_rentar.push(precior8);

		 items_priceh_rentar.push(precior9);
		 items_priceh_rentar.push(precior10);
		 items_priceh_rentar.push(precior11);
		 items_priceh_rentar.push(precior12);
		 items_priceh_rentar.push(precior13);
		 items_priceh_rentar.push(precior14);
		 items_priceh_rentar.push(precior16);

		 var precioc1 = {
		        title: '$20,000',
		        value: '20000' 
		    }
		var    precioc2 = {
		        title: '$50,000',
		        value: '50000' 
		    }
		var    precioc3 = {
		        title: '$150,000',
		        value: '150000' 
		    }
		var    precioc4 = {
		        title: '$200,000',
		        value: '200000' 
		    }
		var    precioc5 = {
		        title: '$300,000',
		        value: '300000' 
		    }
		 var   precioc6 = {
		        title: '$500,000',
		        value: '500000' 
		    }
		var    precioc7 = {
		        title: '$50,000',
		        value: '50000' 
		    }
		var    precioc8 = {
		        title: '$100,000',
		        value: '100000' 
		    }
		var    precioc9 = {
		        title: '$200,000',
		        value: '200000' 
		    }
		 var    precioc10 = {
		        title: '$300,000',
		        value: '300000' 
		    }
		 var    precioc11 = {
		        title: '$500,000',
		        value: '500000' 
		    }
		 var    precioc12 = {
		        title: '+ $500,000',
		        value: '1000000000' 
		    }
		 
		 items_priced_comprar.push(precioc1);
		 items_priced_comprar.push(precioc2);
		 items_priced_comprar.push(precioc3);
		 items_priced_comprar.push(precioc4);
		 items_priced_comprar.push(precioc5);
		 items_priced_comprar.push(precioc6);
		 

		 items_priceh_comprar.push(precioc7);
		 items_priceh_comprar.push(precioc8);
		 items_priceh_comprar.push(precioc9);
		 items_priceh_comprar.push(precioc10);
		 items_priceh_comprar.push(precioc11);
		 items_priceh_comprar.push(precioc12);
		 

		// var items_priced_rentar = ['100','400','500','600','700','800','900','1000'];
		 //var items_priceh_rentar = ['400','500','600','700','800','900','1000','1000000'];

		 //var items_priced_comprar = ['20000','50000','150000','200000','300000','500000'];
		 //var items_priceh_comprar = ['50000','100000','200000','300000','500000','1000000000'];

		  var selectpd = $('#priced').empty();
		  var selectph = $('#priceh').empty();

		 


 		  if(var_renta_compra=="1")
			{
				
				
				$.each(items_priced_rentar, function(i,item) {
		            selectpd.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        });

		        $.each(items_priceh_rentar, function(i,item) {
		            
		            
		            	selectph.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        	
		        });
				
			}
		else
			{
				

				$.each(items_priced_comprar, function(i,item) {
		            selectpd.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        });

		        $.each(items_priceh_comprar, function(i,item) {
		            
		            


		            selectph.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' );
		             
		        });
			}

			selectpd.prepend('<option value=""></option>');
		    selectph.prepend('<option value=""></option>');
	}

	

	$("#top a").on('click',function(e){
		e.preventDefault();

		 
		 var items_priced_rentar =  []; // my array
		 var items_priceh_rentar =  []; // my array
		 var items_priced_comprar =  []; // my array
		 var items_priceh_comprar =  []; // my array

		
		var precior1 = {
		        title: '$100',
		        value: '100' 
		    }
		var    precior2 = {
		        title: '$400',
		        value: '400' 
		    }
		var    precior3 = {
		        title: '$500',
		        value: '500' 
		    }
		var    precior4 = {
		        title: '$600',
		        value: '600' 
		    }
		var    precior5 = {
		        title: '$700',
		        value: '700' 
		    }
		 var   precior6 = {
		        title: '$800',
		        value: '800' 
		    }
		var    precior7 = {
		        title: '$900',
		        value: '900' 
		    }
		var    precior8 = {
		        title: '$1,000',
		        value: '1000' 
		    }
		var    precior9 = {
		        title: '$400',
		        value: '400' 
		    }
		 var    precior10 = {
		        title: '$500',
		        value: '500' 
		    }
		 var    precior11 = {
		        title: '$600',
		        value: '600' 
		    }
		 var    precior12 = {
		        title: '$700',
		        value: '700' 
		    }
		 var    precior13= {
		        title: '$800',
		        value: '800' 
		    }

		 var    precior14 = {
		        title: '$900',
		        value: '900' 
		    }
		 var    precior15 = {
		        title: '$1,000',
		        value: '1000' 
		    }
		 var    precior16 = {
		        title: '+ $1,000',
		        value: '1000000' 
		    }
		    
		 items_priced_rentar.push(precior1);
		 items_priced_rentar.push(precior2);
		 items_priced_rentar.push(precior3);
		 items_priced_rentar.push(precior4);
		 items_priced_rentar.push(precior5);
		 items_priced_rentar.push(precior6);
		 items_priced_rentar.push(precior7);
		 items_priced_rentar.push(precior8);

		 items_priceh_rentar.push(precior9);
		 items_priceh_rentar.push(precior10);
		 items_priceh_rentar.push(precior11);
		 items_priceh_rentar.push(precior12);
		 items_priceh_rentar.push(precior13);
		 items_priceh_rentar.push(precior14);
		 items_priceh_rentar.push(precior16);

		 var precioc1 = {
		        title: '$20,000',
		        value: '20000' 
		    }
		var    precioc2 = {
		        title: '$50,000',
		        value: '50000' 
		    }
		var    precioc3 = {
		        title: '$150,000',
		        value: '150000' 
		    }
		var    precioc4 = {
		        title: '$200,000',
		        value: '200000' 
		    }
		var    precioc5 = {
		        title: '$300,000',
		        value: '300000' 
		    }
		 var   precioc6 = {
		        title: '$500,000',
		        value: '500000' 
		    }
		var    precioc7 = {
		        title: '$50,000',
		        value: '50000' 
		    }
		var    precioc8 = {
		        title: '$100,000',
		        value: '100000' 
		    }
		var    precioc9 = {
		        title: '$200,000',
		        value: '200000' 
		    }
		 var    precioc10 = {
		        title: '$300,000',
		        value: '300000' 
		    }
		 var    precioc11 = {
		        title: '$500,000',
		        value: '500000' 
		    }
		 var    precioc12 = {
		        title: '+ $500,000',
		        value: '1000000000' 
		    }
		 
		 items_priced_comprar.push(precioc1);
		 items_priced_comprar.push(precioc2);
		 items_priced_comprar.push(precioc3);
		 items_priced_comprar.push(precioc4);
		 items_priced_comprar.push(precioc5);
		 items_priced_comprar.push(precioc6);
		 

		 items_priceh_comprar.push(precioc7);
		 items_priceh_comprar.push(precioc8);
		 items_priceh_comprar.push(precioc9);
		 items_priceh_comprar.push(precioc10);
		 items_priceh_comprar.push(precioc11);
		 items_priceh_comprar.push(precioc12);
		 

		// var items_priced_rentar = ['100','400','500','600','700','800','900','1000'];
		 //var items_priceh_rentar = ['400','500','600','700','800','900','1000','1000000'];

		 //var items_priced_comprar = ['20000','50000','150000','200000','300000','500000'];
		 //var items_priceh_comprar = ['50000','100000','200000','300000','500000','1000000000'];

		  var selectpd = $('#priced').empty();
		  var selectph = $('#priceh').empty();

        

		if(e.currentTarget.id=="rentar")
			{
				$('#buscador #cat').val('1');
				
				$.each(items_priced_rentar, function(i,item) {
		            selectpd.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        });

		        $.each(items_priceh_rentar, function(i,item) {
		            
		            
		            	selectph.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        	
		        });
				
			}
		else
			{
				$('#buscador #cat').val('2');

				$.each(items_priced_comprar, function(i,item) {
		            selectpd.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' ); 
		        });

		        $.each(items_priceh_comprar, function(i,item) {
		            
		            


		            selectph.append( '<option value="'
		                                 + $.trim(item.value)
		                                 + '">'
		                                 + item.title
		                                 + '</option>' );
		             
		        });
			}

			selectpd.prepend('<option value=""></option>');
		    selectph.prepend('<option value=""></option>');

		
	
	});

	$("#filtros").on('click',function(e){
		 e.preventDefault();
		 
		 $("#advanced").toggle();

		 if($("#advanced").css('display') !== 'none')
		   {
		       //$("#filtros").append("-");
		   }else
		   {
		   		//$("#filtros").append("+");
		   }

	});

	 $('#logo div.back').hide().css('left', 0);
    
    function mySideChange(front) {
        if (front) {
            $(this).parent().find('div.front').show();
            $(this).parent().find('div.back').hide();
            
        } else {
            $(this).parent().find('div.front').hide();
            $(this).parent().find('div.back').show();
        }
    }

	/*$('#logo').hover(
        function () {
            $(this).find('div').stop().rotate3Di('flip', 250, {direction: 'clockwise', sideChange: mySideChange});
        },
        function () {
            $(this).find('div').stop().rotate3Di('unflip', 500, {sideChange: mySideChange});
        }
    );*/


	$('#idioma').change(function() {

	  if($(this).val() == "es" )
	  	{
	  	window.location.href = "/inicio";
	 	 $(this).attr('selectedIndex', 0);
	  }else
	  	 window.location.href = "/home";

	});

	/*$("#btn_print").on('click',function(e){
		 e.preventDefault();
		 
		  var objeto= $('.print');//document.getElementById('imprimeme');    //obtenemos el objeto a imprimir
		  //var objeto2= document.getElementById('imprimeme2');    //obtenemos el objeto a imprimir
		  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
		  ventana.document.write(objeto[0].innerHTML + objeto[1].innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
		  ventana.document.close();  //cerramos el documento
		  ventana.print();  //imprimimos la ventana
		  ventana.close();  //cerramos la ventana

	});*/
	





	


});