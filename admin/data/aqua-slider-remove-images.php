<?php
	if(isset($_GET['action']) && $_GET['action'] == "aqua_slider_remove_image"){
		$table_name = 'aqua_slider_image';

		$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
		mysql_select_db( DB_NAME, $con );

		$url = mysql_real_escape_string($_GET['url']);

		$select_to_remove = "DELETE FROM $table_name WHERE url = '".$url."' LIMIT 1";
		$query_to_remove = mysql_query($select_to_remove) OR die ("Error: ".mysql_error());

		if($query_to_remove){
			$msg = "Imagem removida!";
			$data = 200;
		}else{
			$msg = "Erro na query!";
			$data = 500;
		}
		$json = json_encode(array(
			"status"=>$data,
			"msg"=>$msg
		));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing Here! </h1>";
		exit();
	}

?>