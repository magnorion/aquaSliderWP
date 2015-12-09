<?php
	if(isset($_GET['action'])){
		include_once("model/aqua-slider-param-model.php");
		
		$query_find_param = mysqli_query($con,"SELECT * FROM $table_name WHERE id = 1 ");
		$counter_params = mysqli_num_rows($query_find_param);
		if($counter_params > 0){
			$array = mysqli_fetch_array($query_find_param);
			$msg = "Existe!";
			$params = array(
				"width" => $array['width'],
				"height" => $array['height'],
				"bullet" => $array['bullet'],
				"type" => $array['type'],
				"animation" => $array['animation'],
				"control" => $array['control'],
				"autoPlay" => $array['autoPlay']
			);
			$json = json_encode(array("msg"=>$msg,"params"=>$params));
		}else{
			$msg = "0";
			$json = json_encode(array("msg"=>$msg));
		}

		echo $json;
		exit();
	}else{
		echo "<h1> Nothing Here! </h1>";
		exit();
	}
?>