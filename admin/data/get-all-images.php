<?php
	if(isset($_GET['action'])){
		require_once("model/aqua-slider-model.php");
		$table_name = 'aqua_slider_image';
		
		$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysqli_error(), E_USER_ERROR );
		mysqli_select_db( $con, DB_NAME );

		$search_all_images = "SELECT * FROM $table_name ORDER BY position ASC";
		$query_search = mysqli_query($con,$search_all_images) OR die("Error: ".mysqli_error($con));
		$counter_search = mysqli_num_rows($query_search);
		if($counter_search > 0){
			$array = array();
			for($i=1;$i<=$counter_search;$i++){
				$aqua_slider_array = mysqli_fetch_array($query_search);
				$link = $aqua_slider_array['link'];
				$url = $aqua_slider_array['url'];
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