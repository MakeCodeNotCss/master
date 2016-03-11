<?php // Users class

	/*	***************************	*/
	/*	Author: Sivkovych Maksym	*/
	/*	Developed: 01.09.2015		*/
	/*	***************************	*/

// exec_query ( query , once , update )

class Menu
{
	protected $db;
	function __construct($db_obj)
	{
		$this->db = $db_obj;
	}

	public function getCompanyInformation()
	{
		try{
			$query = "SELECT * FROM [pre]total_config WHERE `active`=1 LIMIT 10";
			return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getDeliveryMethods()
	{
		try{
			$query = "SELECT * FROM [pre]shop_delivery_methods LIMIT 10";
			return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getPayMethods()
	{
		try{
			$query = "SELECT * FROM [pre]shop_payment_methods LIMIT 10";
			return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getMenuById($_id)
	{
		try{
			$query = "SELECT * FROM [pre]menu WHERE `block`=0 AND `id`='$_id' LIMIT 1";
			return $this->db->exec_query($query,1);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	public function getMenuByAlias($_alias)
	{
		try{
			$query = "SELECT * FROM [pre]menu WHERE `block`=0 AND `alias`='$_alias' LIMIT 1";
			return $this->db->exec_query($query,1);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}
	
	public function getAllMenu()
	{
		try{
			$query = "SELECT * FROM [pre]menu WHERE `block`=0 AND `pos_id`=1 LIMIT 100";
			return $this->db->exec_query($query);
		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	// Reqursive get shop catalog tree

	public function rec_cat_tree($arr,$cat_id,$step=0)
	{
		$query = "SELECT id,name,alias,parent FROM [pre]shop_catalog WHERE `id`=$cat_id LIMIT 1";
		$res = $this->db->exec_query($query,1);
		
		if($res)
		{
			array_push($arr, $res);
			$arr = $this->rec_cat_tree($arr,$res['parent'],($step+1));
		}
		
		return ($step==0 ? array_reverse($arr) : $arr);
	}

	
	public function getCatalogParents($catalog=array(), $parent=0)
		{
			$query = "SELECT id,parent,name,alias 
			        	 FROM [pre]shop_catalog
			         	 WHERE `parent`=$parent AND `block`=0
			        	 ORDER BY pos,id 
			        	 LIMIT 10000";


			
			$childs = $this->db->exec_query($query);
			
			foreach($childs as $step => $child)
			{
				$childID = $child['id'];
				
				$catalog[$step] = $child; 

				$catalog[$step]['childs'] = $this->getCatalogParents(array(),$childID);
			}

			return $catalog;
		}

	
	public function convTreeToHTML($tree=array(),$lvl=0,$val=0,$prev_link="")
		{
			if(!$tree) return "";
		
			$lvl_padding = "";
		
			for($i=0; $i<$lvl; $i++) $lvl_padding .= "&nbsp;&nbsp;";
		
			$res = ($lvl==0 ? '<ul id="topMain" class="nav nav-pills nav-main colored">' : "<ul class=\"dropdown-menu\">");
		
			foreach($tree as $child)
			{
				$childID = $child['id'];
				$childName = $child['name'];
				$childAlias = $child['alias'];
				
				$curr_link = $prev_link."/".$childAlias;
				
				$selected = ($childID==$val ? "active" : "");
				
				$dToggle = ($child['childs'] ? "dropdown-toggle" : "");
				
				$res .= "<li class='$selected'>";
				
				$res .= "<a class=\"$dToggle\" href=\"$curr_link/\" title=\"$childName\">$childName</a>";
			
				$res .= $this->convTreeToHTML($child['childs'],($lvl+1),$val,$curr_link);
				
				$res .= "</li>";
			}
			
			$res .= "</ul>";
		
		return $res;
		}

	/* public function getAllNews()
			try{{

			$query = "SELECT *
						FROM [pre]articles
						WHERE `cat_id`=1
						AND `block`=0
						ORDER BY `dateModify` DESC
						LIMIT 10
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	} */

	public function getNewByAlias($_alias)
	{
		try{
			$query = "SELECT *
						FROM [pre]articles
						WHERE `alias`='$_alias'
						AND `block`=0
						LIMIT 1
					";
			return $this->db->exec_query($query,1);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

		public function getArticleComments($_alias)
	{
		try{
			$query = "SELECT SQL_CALC_FOUND_ROWS M.name, M.fname, M.comment, M.caption, M.dateModify
						FROM [pre]article_comments as M
						LEFT JOIN [pre]articles as A ON A.id=M.art_id
						WHERE M.block=0
						AND A.alias='$_alias'
						LIMIT 20
					";
			return $this->db->exec_query($query);

		}

		catch (Exception $e) {
				echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
			}

	}

		public function getAllNewsPag($cat_id, $page_num, $page_lim)
	{
		try{
		$query= "SELECT SQL_CALC_FOUND_ROWS M.*,
					(SELECT COUNT(id) FROM [pre]article_comments WHERE art_id=M.id) as com_count
					FROM [pre]articles as M
					WHERE `cat_id`=1 
					ORDER BY `dateModify` DESC
					LIMIT ".(($page_num-1)*$page_lim).",$page_lim
				";

		return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}

	}

		public function getUserById($userId)
	{
		try{
			$query= "SELECT *
						FROM [pre]users 
						WHERE `id`=$userId 
						LIMIT 1
					";

		return $this->db->exec_query($query,1);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

		public function getSearchResults($searchQuery)
	{
		try{
			$query= "SELECT *
						FROM [pre]shop_products as P
						LEFT JOIN [pre]files_ref as R ON R.ref_id=P.id
						WHERE P.block=0 AND R.file!='fail' AND R.file!= ''
						AND P.name LIKE '%$searchQuery%' 
						OR P.id LIKE '%$searchQuery%' 
						OR P.alias LIKE '%$searchQuery%' 
						OR P.sku LIKE '%$searchQuery%'
						ORDER BY P.name
					";

		return $this->db->exec_query($query);

		}
		catch (Exception $e) {
			echo "Error (File: ".$e->getFile().", line ".$e->getLine()."): ".$e->getMessage();
		}
	}

	function __destruct(){}
}