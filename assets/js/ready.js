//** ADDRESS BOOK JS Event Listener **//

/*	***************************	*/
/*	Author: Sivkovych Maksym	*/
/*	Developed: 01.09.2015		*/
/*	***************************	*/
	
jQuery(document).ready(function(){
	
		$('#register-submit').click(function(){
				mainScript.registerSubmit();
			});
		$('#inform-submit').click(function(){
				mainScript.informSubmit();
			});
	
	});
	
function next_coupon(cid,email,alias,com_id)
{
	if(email=='0')
	{
		//alert('Empty');
		document.location.href = "/";
		return false;
	}
	$.post("/ajax/action.json.nextCoupon.php",{cid:cid,email:email,alias:alias,com_id:com_id},function(data,status){
					if(status=='success')
					{
						if(data.status=='success')
						{
							var hashCouponId = (data.newCid*100)-25;
							//alert("/coupon/"+alias+"/"+hashCouponId);
							document.location.href = "/coupon/"+alias+"/"+hashCouponId;
						}else{
							//alert('Error');
							document.location.href = "/";
							return false;
							}
					}
				},"json");
}
	
function print_my_discount()
{
	$('header img[alt!=hatava]').css('display','none');
	$('main').css('display','none');
	
	$('header img[alt=hatava]').removeClass('rotate');
	$('header img[alt=hatava]').removeClass('max');
	$('body').css('background','#FFF');
	
	setTimeout(function(){
			window.print();
		},400);
		
	setTimeout(function(){
			$('header img[alt!=hatava]').css('display','block');
			$('main').css('display','table-row');
			
			$('header img[alt=hatava]').addClass('rotate');
			$('header img[alt=hatava]').addClass('max');

			$('body').css('background','url(/images/bg.jpg) no-repeat center center');
			$('body').css('background-size','cover');
		},2000);
}