<?php
	if(isset($_POST['action']) && $_POST['action'] == "aqua_slider_send_params"){
		include_once("model/aqua-slider-param-model.php");
		$table_name = 'aqua_slider_params';
		
		$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
		mysql_select_db( DB_NAME, $con );

		$all_params = $_POST['params'];

		$width = mysql_real_escape_string($all_params['width']);
		$height = mysql_real_escape_string($all_params['height']);
		$bullet = mysql_real_escape_string($all_params['bullet']);
		$animation = mysql_real_escape_string($all_params['animation']);
		$player = mysql_real_escape_string($all_params['player']);
		$control = mysql_real_escape_string($all_params['control']);
		$autoPlay = mysql_real_escape_string($all_params['autoPlay']);

		$search_row = "SELECT * FROM $table_name";
		$query_row = mysql_query($search_row) or die("Error: ".mysql_error());
		$counter_rows = mysql_num_rows($query_row);
		if($counter_rows < 1){ // If row does not exists
			$sql_params_to_send = "'$width','$height','$bullet','$animation','$player','$control','$autoPlay'";	
			$sql_position = "width,height,bullet,animation,player,control,autoPlay";
			$sql_insertion = mysql_query("INSERT INTO $table_name (".$sql_position.") VALUES (".$sql_params_to_send.")")or die("ERROR: ".mysql_error());
			if($sql_insertion){
				$msg = "Parametros inseridos";
			}else{
				$msg = "Erro no insert parametros";
			}
		}else{ // If row exists
			$update_params = "width = '$width',height = '$height', bullet = '$bullet', animation = '$animation', player = '$player', control = '$control', autoPlay = '$autoPlay'";
			$sql_update = mysql_query("UPDATE $table_name SET ".$update_params."  WHERE id = 1 LIMIT 1") or die("ERROR: ".mysql_error());
			if($sql_update){
				$msg = "Parametros atualizados!";
			}else{
				$msg = "Erro no update parametros!";
			}
		}
		$json = json_encode(array("msg"=>$msg));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing here! </h1>";
		exit();
	}
?>