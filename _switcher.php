<?php // SWITCHER

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/
	
	
	$body_class = FA;

	$uni_styles = array();
	
	switch(FA)
	{
		case 'home': {
			$uni_styles[] = 'layout-shop';
			define("PAGE_VIEW","home");
			$body_class = "homePage";
			break;
		}

		case 'contacts': {
			define("PAGE_VIEW","contacts");
			$body_class  = "contactsPage";
			break;
		}

		case 'login': {
			define("PAGE_VIEW","login");
			break;
		}

		case 'account': {
			define("PAGE_VIEW","account");
			break;
		}

		case 'searchPage': {
			define("PAGE_VIEW","searchPage");
			break;
		}

		case 'changePass': {
			define("PAGE_VIEW","changePass");
			break;
		}

		case 'myOrders': {
			define("PAGE_VIEW","myOrders");
			break;
		}

		case 'cart': {
			$uni_styles[] = 'layout-shop';
			define("PAGE_VIEW","cart");
			break;
		}

		case 'checkout': {
			$uni_styles[] = 'layout-shop';
			define("PAGE_VIEW","checkout");
			break;
		}


		case '404': {
			define("PAGE_VIEW","404");
			break;
		}

		default:{

			$currPage = $menuObj->getMenuByAlias(FA);

			if($currPage)
			{
				if(FA=='news')
				{
					$uni_styles[] = 'layout-blog';

					if($newsItem=$menuObj->getNewByAlias(LA))
					{
						define("PAGE_VIEW","newsItem");
					}
					else
					{
						define("PAGE_VIEW","newsList");
					}	
				}
				else
				{
					define("PAGE_VIEW","staticPage");
				}
			}
			elseif($category=$shopObj->getCategoryByAlias(LA))
			{
				$uni_styles[] = 'layout-shop';
				
				define("PAGE_VIEW","shopCategory");
				$body_class = "shopPage";
			}

			elseif($product=$shopObj->getProductByAlias(LA))
			{
				$uni_styles[] = 'layout-shop';
				
				define("PAGE_VIEW","shopProduct");

				$body_class = "shopPage";
			}	
			else
			{
				header("Location: ".RS."404");
				exit();				
			}
			break;
			}


	}