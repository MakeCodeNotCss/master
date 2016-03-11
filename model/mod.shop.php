<?php // Users class

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

// exec_query ( query , once , update )

class Shop
{
	protected $db;
	function __construct($db_obj)
	{
		$this->db = $db_obj;
	}

	public function getCategoryById($_id)
	{
		try{
			$query = "SELECT * 
						FROM [pre]shop_catalog 
						WHERE `block`=0 
						AND `id`='$_id' 
						LIMIT 1";
			return $this->db->exec_query($query,1);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getCategoryByAlias($_alias)
	{
		try{
			$query = "SELECT * 
						FROM [pre]shop_catalog 
						WHERE `block`=0 
						AND `alias`='$_alias' 
						LIMIT 1";
			return $this->db->exec_query($query,1);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}


	public function getCategoryProductsById($cat_id, $page_num, $page_lim, $filters="", $filter_joins="")
	{
		try{
		$query= "SELECT SQL_CALC_FOUND_ROWS M.id, M.name, M.alias, M.price, M.quant, M.currency, F.file
					FROM [pre]shop_products as M
					LEFT JOIN [pre]shop_cat_prod_ref as R ON R.prod_id=M.id 
					LEFT JOIN [pre]shop_chars_prod_ref as CPR ON CPR.prod_id=M.id 

					$filter_joins

					LEFT JOIN [pre]shop_catalog as C ON C.id=R.cat_id 
					LEFT JOIN [pre]files_ref as F ON F.ref_id=M.id 
					WHERE C.id=$cat_id 
					AND F.file!='fail' 
					AND F.ref_table='shop_products' 
					AND M.block=0 

					$filters

					GROUP BY M.id
					LIMIT ".(($page_num-1)*$page_lim).",$page_lim
				";

		//if($filters!="") echo "<pre>" . $query . "</pre>";

		return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}

	}

	public function getProductByAlias($_alias)
	{
		try{
			$query = "SELECT M.* , R.cat_id
						FROM [pre]shop_products as M 
						LEFT JOIN [pre]shop_cat_prod_ref as R ON R.prod_id=M.id 
						WHERE M.block=0 
						AND M.alias='$_alias'
						LIMIT 1";
			return $this->db->exec_query($query,1);
		}

		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getProductImages($_prod_id)
	{
		try{
			$query = "SELECT R.file 
						FROM [pre]files_ref as R 
						WHERE R.ref_table='shop_products'
						AND R.ref_table='shop_products' AND R.ref_id=$_prod_id AND R.file!='fail'
						LIMIT 20";
			return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}	

	public function getParentByAlias($_alias)
	{
		try
			{
			$query = "SELECT *
						FROM [pre]shop_catalog
						WHERE `block`=0
						AND `alias`='$_alias'
						LIMIT 1";
			return $this->db->exec_query($query,1);
			}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}

	public function getChildsByID($parent)
	{
		try{
			$query = "SELECT *
						FROM [pre]shop_catalog
						WHERE `parent`='$parent'
						AND `block`=0
						ORDER BY id
						LIMIT 20";
			return $this->db->exec_query($query);

			}
		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function getCategoryFilterChars($_group_id)
	{
		try{
			$query = "SELECT M.id, M.name, M.measure
						FROM [pre]shop_chars as M
						WHERE M.group_id = $_group_id AND M.show_site = 1 AND M.block = 0 AND M.show_admin = 1
						ORDER BY M.pos
						LIMIT 100
					";
			return $this->db->exec_query($query);

			}
		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}
	}

	public function getCategoryFilterCharValues($_cat_id, $_char_id)
	{
		try{
			$query = "SELECT M.value, M.id as ref_id,
						(
							SELECT COUNT(SREF.id) 
							FROM [pre]shop_chars_prod_ref as SREF 
							LEFT JOIN [pre]shop_cat_prod_ref as CPR on CPR.prod_id=SREF.prod_id 
							LEFT JOIN [pre]shop_products as RP on RP.id=SREF.prod_id 
							WHERE SREF.char_id=M.char_id AND SREF.value=M.value AND CPR.cat_id=$_cat_id AND RP.block=0 
						) 
							as values_count
						FROM [pre]shop_chars_prod_ref as M 
						LEFT JOIN [pre]shop_cat_prod_ref as R ON R.prod_id=M.prod_id
						LEFT JOIN [pre]shop_products as P ON P.id=R.prod_id
						WHERE M.value != '' AND M.filter=1 AND M.char_id=$_char_id AND P.block=0 AND R.cat_id=$_cat_id 
						GROUP BY M.value 
						ORDER BY M.id 
					";
			
			//echo str_replace("[pre]","osc_",$query); exit();

			return $this->db->exec_query($query);

			}
		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function countFilterValues($_cat_id, $_char_id, $filters, $filter_joins)
	{
		try{
			$query = "SELECT SREF.value, COUNT(SREF.id) as count, SREF.id as ref_id 
						FROM [pre]shop_chars_prod_ref as SREF 
						LEFT JOIN [pre]shop_cat_prod_ref as CPR on CPR.prod_id=SREF.prod_id 
						LEFT JOIN [pre]shop_products as M on M.id=SREF.prod_id 
						
							$filter_joins
						
						WHERE SREF.char_id=$_char_id AND CPR.cat_id=$_cat_id AND M.block=0 AND SREF.filter=1   
						
							$filters
						
						GROUP BY SREF.value 
						ORDER BY SREF.id
						";
			
			//echo "<pre>" . $query . "</pre>";

			return $this->db->exec_query($query);

			}
		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function getCategoryMaxMinPrice($_cat_id)
	{
		try{
			$query = "SELECT MAX(M.price), MIN(M.price)
						FROM [pre]shop_products as M
						LEFT JOIN [pre]shop_cat_prod_ref as R ON R.cat_id=$_cat_id
						WHERE M.id = R.prod_id
						LIMIT 1
					";
			return $this->db->exec_query($query,1);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function getNewProducts()
	{
		try{
			$query = "SELECT M.id, M.alias, M.name, M.price, M.currency, R.file, 
						(SELECT quant FROM [pre]shop_cart WHERE prod_id=M.id AND uid='".ACCOUNT_ID."' LIMIT 1) as quant_in_cart
						FROM [pre]shop_products as M
						LEFT JOIN [pre]files_ref as R ON R.ref_id=M.id
						LEFT JOIN [pre]shop_prod_group_ref as G ON G.prod_id=M.id
						WHERE G.group_id=1 AND R.file!='fail' AND R.file!='' AND R.file!=''
						AND M.block=0
						GROUP BY M.id DESC
						LIMIT 10
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

		public function getPopularProducts()
	{
		try{
			$query = "SELECT M.id, M.alias, M.quant, M.name, M.price, M.currency, R.file,
						(SELECT quant FROM [pre]shop_cart WHERE prod_id=M.id AND uid='".ACCOUNT_ID."' LIMIT 1) as quant_in_cart
						FROM [pre]shop_products as M
						LEFT JOIN [pre]files_ref as R ON R.ref_id=M.id
						LEFT JOIN [pre]shop_prod_group_ref as G ON G.prod_id=M.id
						WHERE G.group_id=4
						AND M.block=0 AND R.file!='fail' AND R.file!='' AND R.file!=''
						GROUP BY M.id DESC
						LIMIT 10
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}
		

		public function getInCartProducts($userId)
	{
		try{
		$query = "SELECT C.*,
					(SELECT name FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_name,
					(SELECT square FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_square,
					(SELECT alias FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_alias,
					(SELECT model FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_model,
					(SELECT price FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_price,
					(SELECT currency FROM [pre]shop_products WHERE `id`=C.prod_id LIMIT 1) as product_currency,
					(SELECT file FROM [pre]files_ref WHERE `ref_id`=C.prod_id ORDER BY id DESC LIMIT 1) as product_image
					FROM [pre]shop_cart as C
					WHERE C.uid='$userId'
					ORDER BY C.id DESC
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}


	public function countCartSumm($uid)
	{
		try{
			$countQuery = "SELECT SUM(P.price*C.quant) as cart_price, SUM(C.quant) as cart_quant
							FROM [pre]shop_products as P 
							LEFT JOIN [pre]shop_cart as C ON C.prod_id=P.id
							WHERE C.uid='$uid'
							  ";

			return $this->db->exec_query($countQuery,1);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function getInCartItem($uid, $prod_id)
	{
		try{
			$query = "SELECT id, quant
					FROM [pre]shop_cart
					WHERE `uid`='$uid'
					AND `prod_id`=$prod_id
					ORDER BY id DESC
					LIMIT 1
					";
			return $this->db->exec_query($query,1);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}


	public function getMyOrdersById($account_id)
	{
		try{
			$query = "SELECT O.*, S.name
					FROM [pre]shop_orders as O
					LEFT JOIN [pre]shop_order_statuses as S ON S.id = O.status
					WHERE O.user_id='$account_id'
					ORDER BY O.id
					LIMIT 100
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

	public function getCitiesList()
	{
		try{
			$query = "SELECT *
					FROM next_np_cities
					ORDER BY id
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

		public function getPartsListByCity($city_id)
	{
		try{
			$query = "SELECT *
					FROM next_np_parts as P
					LEFT JOIN next_np_cities as C ON C.Ref=P.CityRef
					WHERE C.id='$city_id'
					ORDER BY id
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}


	function __destruct(){}
}