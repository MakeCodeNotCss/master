//** ADDRESS BOOK JS MainScript **//

/*	***************************	*/
/*	Author: Sivkovych Maksym	*/
/*	Developed: 01.09.2015		*/
/*	***************************	*/
	
$(function(){
	$('#product-qty-dd li a').click(function(){

			var product_square = parseFloat($('#product_square').html());

			var curr_qty = parseInt($(this).html());

			var curr_square = (curr_qty * product_square);

   			$('#needed_square').val(curr_square);

   			$('#needed_square').change();
		
	});
});

var mainScript = {    

		// Scroll to Top
		
		scrollToTop: function(){
				$('body,html').stop().animate({scrollTop:0},400);
			},

		// Register form
		
		registerSubmit: function(){
        	$('.error').css('visibility','hidden');
			//$('#agree-line span').css('visibility','hidden');
			$.post("/ajax/action.json.registerIn.php",
				$('form[name=register-me]').serialize(),
				function(data,status){
					if(status=='success')
					{
						if(data.status=='success')
						{
							var hashCouponId = (data.couponID*100)-25;
							
							document.location.href = "/coupon/"+$('#company_form_alias').val()+'/'+hashCouponId;
						}else{
							if(data.err1==1) 	$('#fname-line .error').css('visibility','visible');
							if(data.err2==1) 	$('#lname-line .error').css('visibility','visible');
							if(data.err3==1) 	$('#phone-line .error').css('visibility','visible');
							if(data.err4==1) 	$('#email-line .error').css('visibility','visible');
							if(data.err5==1) 	$('#passport-line .error').css('visibility','visible');
							if(data.err6==1) 	$('#agree-line .error').css('visibility','visible');

							if(data.status=='warning'){
								$('.popup form[name=register-me]').html('<br><p><center>'+data.message+'</center></p></br>');
								setTimeout(function(){
									document.location.href = "/thank-you"+$('#company_form_alias').val();
								},5000)
							}

							}
					}
				},"json");
    		},
		
		// Inform form
		
		informSubmit: function(){
        	$('.error').css('visibility','hidden');
			$.post("/ajax/action.json.informMe.php",$('form[name=inform-me]').serialize(),function(data,status){
					if(status=='success')
					{
						if(data.status=='success')
						{
							$('input[name=email]').val('');
							$('.popup').hide(400);
						}else{
							if(data.errorID==1) 	$('#email-line .error').css('visibility','visible');
							}
					}
				},"json");
    		},

    	// Ajax Category Products Reload by Filter

    	catProductsFilterReload: function(){

    		$('#ajaxCatProdList').html("<center>Loading...</center>"); //reloading div id=ajaxCatProdList

    		$.post("/ajax/reloadCatProdListByFilter.php", //ajax reloader link
    			$('#filtersAction').serialize(),	//filter parameters form id=filtersAction

    			function(data,status){  //callback func

    			if(status=='success')
    			{
    				$('#ajaxCatProdList').html(data.resultHtml); //load ajax reloader

    				$('.shop-filter label input').attr('disabled','disabled');
    				$('.shop-filter label span').html("(0)");

    				$.each(data.filter_chars, function( index, value ) {
					  $.each(value.values_count, function( index2, value2 ) {

						  	//alert( value2.ref_id + ": " + value2.count );
						  
						  	$('#'+value2.ref_md5+' input').removeAttr('disabled');
    						$('#'+value2.ref_md5+' span').html("("+value2.count+")");
						
						});
					});

					$('.shop-filter label').each( function( i, v )
						{
							if( $('#'+$(this).attr('id')+' span').html()=="(0)" )
							{
								$('#'+$(this).attr('id')+' input').prop('checked',false);
							}
						});
    			}

    		},"json");
    	},

    	//Ajax Register 

    	userRegister: function(){
    		$('#userRegisterForm .response').html("Внесение ваших данных в базу...");

			$.post(
					"/ajax/action.json.addNewUser.php",
				
					$('#userRegisterForm').serialize(),
				
					function(data,status)
					{ 
						if(status=='success')
						{
							$('#userRegisterForm .response').html(data.message);

							if(data.status=='success')
							{
								setTimeout(function(){ document.location.href = "/"; },500);
							}

						}else{
							$('#userLoginForm .response').html("Server response error :(");
						}
					},
				
					"json"
				);
    	},

    	// Ajax Login

    	userLogin: function(){
    		$('#userLoginForm .response').html("Вход в систему");

			$.post(
					"/ajax/action.json.logIn.php",
				
					$('#userLoginForm').serialize(),
				
					function(data,status)
					{ 
						if(status=='success')
						{
							$('#userLoginForm .response').html(data.message);

							if(data.status=='success')
							{
								setTimeout(function(){ document.location.href = "/"; },500);
							}

						}else{
							$('#userLoginForm .response').html("Server response error :(");
						}
					},
				
					"json"
				);
    	},

    	userLogOut: function(){
    		$('#userLogoutForm .response').html("...");

			$.post(
					"/ajax/action.json.logOut.php",
				
					function(data,status)
					{ 
						if(status=='success')
						{
							document.location.replace("/");
					
						}else{
							$('#userLogoutForm .response').html("Server response error :(");
						}
					},
				
					"json"
				);
    	},
    		
		changePass: function(){
			$('#change-password-form .response').html("загрузка...");

			$.post(
					"/ajax/action.json.changePass.php",
					$('#change-password-form').serialize(),
				
					function(data,status)
					{ 
						if(status=='success')
						{
							$('#change-password-form .response').html(data.message);
							
							if(data.status=='success')
							{
								setTimeout(function(){ document.location.href = "/changePass"; },1000);
							}
					
						}else{
							$('#change-password-form .response').html("Server response error :(");
						}
					},
				
					"json"
				);
		},

		updateUserInfo: function(){
			$('#change-password-form .response').html("загрузка...");

			$.post(
					"/ajax/action.json.updateUserInfo.php",
					$('#updateInfoForm').serialize(),
				
					function(data,status)
					{ 
						if(status=='success')
						{
							$('#updateInfoForm .response').html(data.message);
							
							if(data.status=='success')
							{
								
							}
					
						}else{
							$('#updateInfoForm .response').html("Server response error :(");
						}
					},
				
					"json"
				);
		},

		addToCart: function(){
			//$('#quick-cart-content').html("..."); 

    		$.post(
	    			"/ajax/action.json.addProdToCart.php",
	    			$('#addToCartForm').serialize(),

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				$('#quick-cart-summ').html(data.total_summ);
		    				$('#quick-cart-quant').html(data.total_quant);
		    				$('#quick-cart-content').html(data.fastCartHtml);
		    				$('#in-cart-message').html(data.inCart);
		    			}

    		},"json");
    	
		},

		quickAddToCart: function(id){
			//$('#quick-cart-content').html("..."); 

    		$.post(
	    			"/ajax/action.json.addProdToCart.php",
	    			{prod_id:id},

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				$('#quick-cart-summ').html(data.total_summ);
		    				$('#quick-cart-quant').html(data.total_quant);
		    				$('#quick-cart-content').html(data.fastCartHtml);
		    				$('#in-cart-message'+id).html(data.inCart);
		    			}

    		},"json");
    	
		},


		delFromCart: function(cartId){
			//$('#quick-cart-content').html("..."); 

    		$.post(
	    			"/ajax/action.json.delProdFromCart.php",
	    			{ID:cartId},

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				$('#quick-cart-summ').html(data.total_summ);
		    				$('#quick-cart-quant').html(data.total_quant);
		    				$('#cart-summ').html(data.total_summ);
		    				$('#cartItem-'+cartId).remove();
							$('#emptyCart').html(data.emptyCart);
							$('#cartButton').html(data.emptyCartBtn);
							$('#tranquateCart').html(data.tranqBtn);
							$('#emptyQuickCart').html(data.emptyQuickCart);
							$('#quick-cart-content').html(data.fastCartHtml);
		    			}

    		},"json");
    	
		},

		tranqCart: function(){
			//$('#quick-cart-content').html("..."); 

    		$.post(
	    			"/ajax/action.json.delAllProdCart.php",

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				$('#quick-cart-summ').html(data.total_summ);
		    				$('#quick-cart-quant').html(data.total_quant);
		    				$('#cart-summ').html(data.total_summ);
		    				$('#cartTable').remove();
							$('#emptyCart').html(data.emptyCart);
							$('#cartButton').html(data.emptyCartBtn);
							$('#tranquateCart').html(data.tranqBtn);
							$('#emptyQuickCart').html(data.emptyQuickCart);
							$('#quick-cart-content').html(data.fastCartHtml);
		    			}

    		},"json");
    	
		},

		 recalcCart: function(){

			  $.post("/ajax/action.json.recalculateCart.php",
			  	$('#cartRecalcForm').serialize(),

			  	function(data,status){
				    if(status=='success')
				    {
				     //alert(data.message);
				     document.location.reload();
				     //$('#prodCartRecalc-'+id).html(data.emptyCartBtn);
				    }
			   },"json");
			 
		},


		addNewOrder: function(){

    		$.post(
	    			"/ajax/action.json.addNewOrder.php",
	    			$('#orderForm').serialize(),

	    			function(data,status){

		    			if(status=='success')
		    			{ 

		    				$('#checkoutMessage').html(data.message);
		    				
							if(data.status=='success')
								{
									$('#checkoutResponse').html(data.checkoutHtml);
		    						$('#checkoutMessage').html(data.message);
		    						setTimeout(function(){ document.location.href = "/"; },3000);
								}

		    				
		    			}

    		},"json");
    	
		},

		addNewComment: function(id){
			//$('#quick-cart-content').html("..."); 

			$('#responseWrap').html("Отправка сообщения...");

    		$.post(
	    			"/ajax/action.json.addNewComment.php",
	    			$('#commentForm').serialize(),

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				if(data.status=='success')
		    				{
		    					$('#commentForm')[0].reset();
		    					$('#comment_div').append(data.comment);
		    				}

		    				$('#responseWrap').html(data.message);

		    				//$('#comment_div').prepend(data.comment);
		    				//$('#commentsCount').html(data.countComments);
		    			}

    		},"json");
    	
		},

		calcMyQuant: function(){
    		$.post(
	    			"/ajax/action.json.calcQuant.php",
	    			$('#addToCartForm').serialize(),

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				
		    				$('#resultSpan').html(data.message);
		    				$('#resultRest').html(data.rest);
		    				$('#selectedQty').html(data.selectedQty);

		    				$('#prod_qty').val(data.selectedQty);

		    				$('#product-qty-dd li').removeClass('active');
		    				$('#product-qty-dd li:eq('+(data.selectedQty-1)+')').addClass('active');
		    			}

    		},"json");
    	
		},

		findParts: function(){
			//$('#quick-cart-content').html("..."); 

    		$.post(
	    			"/ajax/action.json.findPartsForCity.php",
	    			$('#orderForm').serialize(),

	    			function(data,status){

		    			if(status=='success')
		    			{ 
		    				$('#partsList').html(data.partsList);
		    			}

    		},"json");
    	
		},


		calcDelivery: function(){
			setTimeout(function(){
	    		$.post(
		    			"/ajax/action.json.calcDelivery.php",
		    			$('#orderForm').serialize(),

		    			function(data,status){

			    			if(status=='success')
			    			{ 
			    					$('#deliverySpan').html(data.delivery_res);
			    					$('#totalCostSpan').html(data.total_res);
			    			}

	    		},"json");
    		},200);
    	
		},

		sendQuickOrder: function(){
			setTimeout(function(){
	    		$.post(
		    			"/ajax/action.json.quickOrder.php",
		    			$('#quickOrderForm').serialize(),

		    			function(data,status){

			    			if(status=='success')
			    			{ 
			    					$('#QO_response').html(data.message);
			    					//$('#totalCostSpan').html(data.total_res);
			    				if(data.status=='success')
		    					{
		    						$('#QO_response').html(data.empty);
			    					$('#quickOrderBody').html(data.message);
			    					$('#quickOrderBtns').remove();
		    					}

			    			}

	    		},"json");
    		},200);
    	
		}


		

} // Main Script finished