<?php
 	$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
	mysql_select_db( DB_NAME, $con );

	$table_params = "aqua_slider_params";
	$search_params = "SELECT * FROM $table_params WHERE id = 1";

	$sql_params_slider = mysql_query($search_params) or die("ERROR ".mysql_error());
	if($sql_params_slider){
		$array_params = mysql_fetch_array($sql_params_slider);
		$params = array(
			"width" => $array_params['width'],
			"height" => $array_params['height'],
			"bullet" => $array_params['bullet'],
			"animation" => $array_params['animation'],
			"player" => $array_params['player'],
			"autoPlay" => $array_params['autoPlay'],
			"control" => $array_params['control']
		);
		$json = json_encode($params);
		echo $json;
		exit();
	}else{
		$json = json_encode(array("msg"=>"error"));
		echo $json;
		exit();
	}
?>