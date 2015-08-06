<?php
	if(isset($_POST['action']) && $_POST['action'] == "aqua_slider_send_images"){
		$table_name = 'aqua_slider_image';
		$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
		mysql_select_db( DB_NAME, $con );

		$image_array = $_POST['img_array'];
		$size_array = $_POST['number_images'];

		for($i=0;$i<=$size_array;$i++){
			
			if($image_array["image"][$i] === NULL)
				continue;
			
			$position = mysql_real_escape_string($image_array["image"][$i][0]);
			$url = mysql_real_escape_string($image_array["image"][$i][1]);
			$link = mysql_real_escape_string($image_array["image"][$i][2]);

			// Update each image!
			$update_image = "position = '$position', link = '$link'";
			$image_update_query = mysql_query("UPDATE $table_name SET ".$update_image." WHERE url = '$url'") or die("ERRO: ".mysql_error());

			if(!$image_update_query){
				$count_error = 1;
			}
		}
		if(!isset($count_error)){
			$msg = "Imagens Atualizadas!";
			$status = 200;
		}else{
			$msg = "Erro na atualização!";
			$status = 200;
		}
		$json = json_encode(array("msg"=>$msg,"status"=>$status));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing Here! </h1>";
		exit();
	}	
?>