<?php
	if(isset($_POST['action'])){
		include_once("model/aqua-slider-param-model.php");
		
		$params = $_POST['params'];
		$width = mysqli_real_escape_string($con,$params['width']);
		$height = mysqli_real_escape_string($con,$params['height']);
		$bullet = mysqli_real_escape_string($con,$params['bullet']);
		$animation = mysqli_real_escape_string($con,$params['animation']);
		$control = mysqli_real_escape_string($con,$params['control']);
		$autoPlay = mysqli_real_escape_string($con,$params['autoPlay']);
		$type = mysqli_real_escape_string($con,$params['effect']);

		$search_params = mysqli_query($con,"SELECT id FROM $table_name WHERE id != '' LIMIT 1") or die(mysqli_error($con));
		$counter_search = mysqli_num_rows($search_params);
		if($counter_search < 1){
			// Primeira vez!
			$params_values = " '$width' , '$height' , '$bullet' , '$animation' , '$control' , '$autoPlay' , '$type'";
			$params_place = "INSERT INTO $table_name (width , height , bullet , type , animation,  control , autoPlay)";

			$params_query_insert = mysqli_query($con,$params_place." VALUES (".$params_values.") ") or die(mysqli_error($con));
			if($params_query_insert){
				$msg = "Dados atualizados!";
			}
		}else{
			// Atualiza!
			$params_update = mysqli_query($con,"UPDATE $table_name SET width = '$width', height = '$height', bullet = '$bullet', animation = '$animation', control = '$control', autoPlay = '$autoPlay', type = '$type' WHERE id = 1") or die(mysqli_error($con));
			if($params_update){
				$msg = "Dados atualizados!";
			}
		}
		$json = json_encode(array("msg"=>$msg));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing Here!</h1>";
		exit();
	}

?>