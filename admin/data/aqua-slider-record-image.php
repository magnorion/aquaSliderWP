<?php
	if(isset($_GET['action']) && $_GET['action'] == "aqua_slider_image_insert"){
		$img_url = $_GET['img_url'];
		$img_link = $_GET['img_link'];

		include_once("model/aqua-slider-model.php");

		$insert_aqua_slider_values =  "'$img_url','$img_link'";
		$insert_aqua_slider_position = "url,link";
		$build_sql_insert = mysql_query("INSERT INTO $table_name (".$insert_aqua_slider_position.") VALUES (".$insert_aqua_slider_values.")") or die ("ERROR INSERT! ".mysql_error());

		if($build_sql_insert){
			$status = 200;
			$msg = "Imagem inserida";
			$json = array(
				"status"=>$status,
				"msg"=>$msg
			);
			$json = json_encode($json);
			echo $json;
			exit();
		}
	}
	else{
		echo "<h1> Nothing here! </h1>";
		exit();
	}

?>