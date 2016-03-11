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
			define("PAGE_VIEW","home");
			$body_class = "homePage";
			break;
		}
		case 'shop': {

					$uni_styles[] = 'layout-shop';
					if(isset($ri[1]) && ri[1]!="")
					{
						define("PAGE_VIEW","shopItem");
					}
					else
					{
						define("PAGE_VIEW","shop");
						$body_class = "shopPage";
					}	
			break;
		}

		case 'contacts': {
			define("PAGE_VIEW","contacts");
			$body_class  = "contactsPage";
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

					if(isset($ri[1]) && ri[1]!="")
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
			else
			{
				header("Location: ".RS."404");
				exit();				
			}
			break;
			}


	}