<?php
	if(isset($_POST['data_img'])){
		require_once("model/aqua-slider-model.php");
		$imgs = $_POST['data_img'];
		$check = 1;
		$counter_array = count($imgs['data']);
		foreach($imgs['data'] as $value){
			$url = mysqli_real_escape_string($con,$value["url"]);
			$link = mysqli_real_escape_string($con,$value["link"]);
			$pos = mysqli_real_escape_string($con,$value["pos"]);

			$search_image = mysqli_query($con,"SELECT id FROM $table_name WHERE position = '$pos'");
			$count_search = mysqli_num_rows($search_image);

			if($count_search < 1){
				//INSERT IMAGE ---
				$insert_values = "'$url' , '$link' , '$pos'";
				$insert_query = mysqli_query($con,"INSERT INTO $table_name (url,link,position) VALUES (".$insert_values.")") or die(mysqli_error($con));
				if($insert_query){
					$check++;
					continue;
				}
			}else{
				//UPDATE IMAGE ---
				$update_section = mysqli_query($con,"UPDATE $table_name SET url = '$url', link = '$link', position = '$pos' WHERE position = '$pos'") or die(mysqli_error($con));
				if($update_section){
					$check++;
					continue;
				}
			}
		}
		$msg = "Imagens alteradas!";
		$json = json_encode(array("msg"=>$msg));
		echo $json;
		exit();
	}else{
		echo "<h1> Nothing Here! </h1>";
		exit();
	}
?>