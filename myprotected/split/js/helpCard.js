	var paf_but_sem = 0;
	
	function change_rotator(id,place,loos)
	{
		$('#'+id+'-'+place).addClass('active');
		$('#'+id+'-'+loos).removeClass('active');

		$('#radio-'+id+'-'+place).prop("checked",true);;
	}
	
	function submit_save_form(choice)
	{
		$('#ajax-getter').html('Saving...');
		
		$('#ajax-getter').show();
		
		$('#formSaveChoice').val(choice);
		
		$('form[name=cardEditForm]').submit();		
	}
	
	function submit_create_form(choice)
	{
		$('#ajax-getter').html('Creating...');
		
		$('#ajax-getter').show();
		
		$('#formSaveChoice').val(choice);
		
		$('form[name=cardEditForm]').submit();
	}
	
	function reload_extra_fields(id)
	{
		$('#wp-form-extra-fields-wrap').html('Loading...');
		$('#wp-form-extra-fields-wrap').load(wp_folder+'ajax/load/reload-cat-group-chars.php?id='+id+'&pid='+card_id);
	}
	
	function split_txt(txt)
	{
		var n = txt.lastIndexOf("\\");
		//alert(txt.substr(n+1));
		$('#save-editor-input-file').attr('value',txt.substr(n+1));
	}
	
	function splits_txt(txt,_name)
	{
		var n = txt.lastIndexOf("\\");
		//alert(txt.substr(n+1));
		$('#save-editor-input-files-'+_name).attr('value',txt.substr(n+1));
	}
	
	function check_file()
	{
		$('#editor-file-input').click();
	}
	function uncheck_file()
	{
		$('#editor-file-input').attr('value','');
		$('#save-editor-input-file').attr('value','../');
	}
	
	function check_files(_name)
	{
		$('#editor-files-input-'+_name).click();
	}
	function uncheck_files(_name)
	{
		$('#editor-files-input-'+_name).attr('value','');
		$('#save-editor-input-files-'+_name).attr('value','../');
	}
	
	function delete_rf(id)
	{
		$('#rf-item-'+id).load(wp_folder+'ajax/load/delete-ref-file.php?id='+id,function(){
				$('#rf-item-'+id).hide(400);
		});
	}
	
	function updateProductCharsForm(product_cat_id,charsGroup,chars,cat_id)
	{
		var postData = {product_cat_id:product_cat_id, charsGroup:charsGroup, chars:chars, cat_id:cat_id}
		$.post("split/ajax/load/action.json.productCharsForm.php",postData,function(data,status){
				if(status=='success')
				{
					$('#wp-form-extra-fields-wrap').html(data.message);
				}
			},"json");
	}
	
	function delete_cart_product_admin(orderId,pi,params)
	{
		var postData = {action:"deleteCartProductAdmin",orderId:orderId,pi:pi}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					loadPage('shop','order-form',20,orderId,'cardEdit',{});
				}
			},"json");
	}
	
	function delete_create_cart_product_admin(pi)
	{
		productsJs = String($('#productsJsData').html());
		
		var postData = {action:"deleteCartProductCreateAdmin",productsJs:productsJs,pi:pi}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					$('#productsJsData').html(String(data.productsJsStr));
						
						$.post("split/ajax/load/action.json.reloadProductsListTable.php",{productsItems:String(data.productsJsStr)},function(dataR,status){
							if(status=='success')
								{
									$('#productsItemsJs').html(dataR.rows);
									$('#createProductsQuant').html(dataR.productsQuant);
									$('#createOrderSum').html(dataR.orderSum);
									$('#createOrderTotalSum').html(dataR.orderSum);
								}
							},"json");
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function slide_toggle_add_products_form()
	{
		if(paf_but_sem)
		{
			$('#paf_but').html('Добавить товар &nbsp;&nbsp;&nbsp;<span>+</span>');
			$('#products_adding_form').slideUp(100);
			paf_but_sem = 0;
		}else
		{
			$('#paf_but').html('Закрыть &nbsp;&nbsp;&nbsp;<span>-</span>');
			$('#products_adding_form').slideDown(100);
			paf_but_sem = 1;
		}
	}
	
	function reload_categories_td(parentId,orderId,type)
	{
		$("body").css("cursor", "progress");
		$('#reloadCategoriesTd').html('Loading...');
		$('#reloadAddingProductsAdmin').html('Категория еще не выбрана.');
		
		$.post("split/ajax/load/action.json.reloadCategoriesTd.php",{parentId:parentId,orderId:orderId,type:type},function(data,status){
				if(status=='success')
				{
					$('#reloadCategoriesTd').html(data.message);
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function reload_adding_products_admin(catId,orderId,type)
	{
		$("body").css("cursor", "progress");
		$('#reloadAddingProductsAdmin').html('Loading...');
		
		$.post("split/ajax/load/action.json.reloadAddingProductsAdmin.php",{catId:catId,orderId:orderId,type:type},function(data,status){
				if(status=='success')
				{
					$('#reloadAddingProductsAdmin').html(data.message);
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	// +/- actions
	function action_minus_quant(cpid)
		{
			var ciid = cpid;
			//alert("-");
			
			var cur_val = parseInt($('#nn_quant_'+ciid+' input').val());
			if(cur_val > 1 && cur_val <= 999)
			{
				--cur_val;
				$('#nn_quant_'+ciid+' input').val(cur_val);
			}else
			{
				if(cur_val <= 1)
				{
					$('#nn_quant_'+ciid+' input').val(1);
				}else{
					$('#nn_quant_'+ciid+' input').val(999);
					}
			}
		};
		// end of +/- actions cart
		
		// +/- actions inline
	function action_plus_quant(cpid){
			var ciid = cpid;
			//alert("+");
			
			var cur_val = parseInt($('#nn_quant_'+cpid+' input').val());
			if(cur_val >= 0 && cur_val < 998)
			{
				++cur_val;
				$('#nn_quant_'+cpid+' input').val(cur_val);
			}else
			{
				if(cur_val < 0)
				{
					$('#nn_quant_'+cpid+' input').val(1);
				}else{
					$('#nn_quant_'+cpid+' input').val(999);
					}
			}
		};
	// end of +/- actions
	
	function add_product_to_admin_cart(orderId,pid,type)
	{
		var p_quant = $('#nn_quant_'+pid+' input').val();
		
		var p_char_ref_id = $('#char_ref_id_'+pid).val();
		
		productsJs = {}
		
		if(type=='create') productsJs = String($('#productsJsData').html());
		
		var postData = {action:"addCartProductAdmin",orderId:orderId,pid:pid,quant:p_quant,char_ref_id:p_char_ref_id,type:type,productsJs:productsJs}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					if(type=='create')
					{
						$('#productsJsData').html(String(data.productsJsStr));
						
						$.post("split/ajax/load/action.json.reloadProductsListTable.php",{productsItems:String(data.productsJsStr)},function(dataR,status){
							if(status=='success')
								{
									$('#productsItemsJs').html(dataR.rows);
									$('#createProductsQuant').html(dataR.productsQuant);
									$('#createOrderSum').html(dataR.orderSum);
									$('#createOrderTotalSum').html(dataR.orderSum);
								}
							},"json");
						
					}else
					{
						loadPage('shop','order-form',20,orderId,'cardEdit',{});
					}
					
					$("body").css("cursor", "auto");
				}
			},"json");
	}
	
	// Change order status
	
	function change_order_status(orderId,statusId)
	{
		var postData = {action:"changeOrderStatus",orderId:orderId,statusId:statusId}
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					loadPage('shop','order-form',20,orderId,'cardView',{});
				}
			},"json");
	}

	function change_quick_order_status(orderId,statusId)
	{
		var postData = {action:"changeQuickOrderStatus",orderId:orderId,statusId:statusId}
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					loadPage('shop','quick-order-form',20,orderId,'cardView',{});
				}
			},"json");
	}

	function send_props_to_client(orderId)
	{

		var accNum = $("#sendPropsSelect :selected").val();
		var postData = {action:"sendProps",orderId:orderId,accNum:accNum}
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					loadPage('shop','order-form',20,orderId,'cardView',{});
				}
			},"json");
	}


	function send_quick_props_to_client(orderId)
	{

		var accNum = $("#sendQuickPropsSelect :selected").val();
		var postData = {action:"sendQuickProps",orderId:orderId,accNum:accNum}
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					loadPage('shop','order-form',20,orderId,'cardView',{});
				}
			},"json");
	}
	
	// Reload Users Extra Fields
	
	function reload_users_extra_fields(typeId,userId)
	{
		$("body").css("cursor", "progress");
		$('#usersExtraFields').html('Loading...');
		
		$.post("split/ajax/load/action.json.reloadUsersExtraFields.php",{typeId:typeId,userId:userId},function(data,status){
				if(status=='success')
				{
					$('#usersExtraFields').html(data.message);
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function export_products_to_excel()
	{
		$("body").css("cursor", "progress");
		$('#usersExtraFields').html('Loading...');
		
		$.post("split/excel/products-report.php",{filtr:$('#wp-filtr-form').serialize()},function(data,status){
				if(status=='success')
				{
					$('#upper-table-ajax-inform').append(data.message);
					$('#upper-table-ajax-inform').show(200);
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function delete_shop_order(orderId)
	{
		var postData = {action:"deleteShopOrder",orderId:orderId}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					$('#delete_order_answer').html(data.message);
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function update_data_from_workabox()
	{
		$('#upper-table-ajax-inform').html("<iframe src='/workabox/update_data_from_workabox.php' width='640' height='200' align='left' scrolling='auto'></iframe>");
		$('#upper-table-ajax-inform').show(500);
	}
	
	function update_users_from_workabox()
	{
		$('#upper-table-ajax-inform').html("<iframe src='/workabox/update_users_from_workabox.php' width='640' height='200' align='left' scrolling='auto'></iframe>");
		$('#upper-table-ajax-inform').show(500);
	}
	
	function make_visible_relation(rel_id)
	{
		$('.hidden-relation').hide();
		$('#hidden-relation-'+rel_id).show();
	}
	
	function add_new_dinamic_char()
	{
		var curr_prod_id = $('input[name=item_id]').val();
		var dinamical_char_id = $('#save-charsD_ID').val();
		
		var postData = {action:"addNewDinamicChar",prodId:curr_prod_id,charId:dinamical_char_id}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					if(data.status=='success')
					{
						$('#dinamic_chars_table tbody').append(data.message);
					}else
					{
						alert("Ajax error. Operation failed.");
					}
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function delete_dinamic_char(ref_id)
	{
		var postData = {action:"deleteDinamicChar",refId:ref_id}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					if(data.status=='success')
					{
						$('#dinamicChar-'+ref_id).hide();
					}else
					{
						alert(data.message);
					}
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	
	function save_new_file_name(id,val,_name)
	{
		//return false;
		//alert(id + " | " + val);
		var postData = {action:"saveNewFileName",id:id,val:val,field:_name}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					alert(data.message);
					
				}
				$("body").css("cursor", "auto");
			},"json");
	}
	function save_new_file_alt(id,val,_name)
	{
		//alert(id + " | " + val);
		var postData = {action:"saveNewFileAlt",id:id,val:val,field:_name}
		
		$("body").css("cursor", "progress");
		
		$.post("split/ajax/heandlers/indexHeandler.php",postData,function(data,status){
				if(status=='success')
				{
					alert(data.message);
					
				}
				$("body").css("cursor", "auto");
			},"json");
	}

	function update_prod_info_by_sku(sku)
	{
		$("body").css("cursor", "progress");
		
		$('#save-prod_id').val('Loading...');
		$('#save-prod_name').val('Loading...');
		$('#save-prod_price').val('Loading...');

		$.post("split/ajax/load/action.json.reloadProdInfoBySku.php",{sku:sku},function(data,status){
				if(status=='success')
				{
					$('#save-prod_id').val(data.prod_id);
					$('#save-prod_name').val(data.prod_name);
					$('#save-prod_price').val(data.prod_price);
				}
				$("body").css("cursor", "auto");
			},"json");
	}