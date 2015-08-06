<?php
	if(isset($_GET['action']) && $_GET['action'] == "aqua_slider_get_all_images"){
		$table_name = 'aqua_slider_image';
		
		$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
		mysql_select_db( DB_NAME, $con );

		$search_all_images = "SELECT * FROM $table_name ORDER BY position ASC";
		$query_search = mysql_query($search_all_images) OR die("Error: ".mysql_error());
		$counter_search = mysql_num_rows($query_search);
		if($counter_search > 0){
			$array = array();
			for($i=1;$i<=$counter_search;$i++){
				$aqua_slider_array = mysql_fetch_array($query_search);
				$link = $aqua_slider_array['link'];
				$url = $aqua_slider_array['url'];
				
				if($aqua_slider_array['position'] == "" || empty($aqua_slider_array['position']))
					$position = 0;
				else
					$position = $aqua_slider_array['position'];

				array_push($array,array(
					"url"=>$url,
					"link"=>$link,
					"position"=>$position
				));
			}
			$json = json_encode($array);
			echo $json;
			exit();
		}
		else{
			$array = " Nenhuma imagem! "; 
			$json = json_encode(array( "msg" => $array));
			echo $json;
			exit();
		}
	}else{
		echo "<h1> Nothing Here! </h1>";
		exit();
	}
?>