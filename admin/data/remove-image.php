<?php
	if(isset($_POST['action'])){
		require_once("model/aqua-slider-model.php");
		$array = $_POST['img_data'];
		
		$img = mysqli_real_escape_string($con,$array['url']);
		$pos = mysqli_real_escape_string($con,$array['pos']);

		$query_find_delete = mysqli_query($con,"DELETE FROM $table_name WHERE position = '$pos' AND url = '$img' LIMIT 1 ") or die("Imagem não existe! - ".mysqli_error($con));
		if(mysqli_affected_rows($con) > 0){
			$msg = "Imagem deletada!";
		}else{
			$msg = "Houve algum erro!";
		}
		$json = json_encode(array("msg"=>$msg));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing here!</h1>";
		exit();
	}
?>