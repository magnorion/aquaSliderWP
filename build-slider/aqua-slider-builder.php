<?php
	$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
	mysql_select_db( DB_NAME, $con );

	$table_images = "aqua_slider_image";
	$table_params = "aqua_slider_params";

	$search_images = "SELECT * FROM $table_images WHERE position != '0'";
	$search_params = "SELECT * FROM $table_params WHERE id = 1";

	//images ---
	$sql_images_slider = mysql_query($search_images) or die("ERROR ".mysql_error());
	$num_rows_images = mysql_num_rows($sql_images_slider);
	if($num_rows_images > 0){
		$build_html_img = "";
		for($i=1;$i<=$num_rows_images;$i++){
			$array_images = mysql_fetch_array($sql_images_slider);
			if($array_images["link"] == "" || $array_images["link"] == " " || $array_images["link"] === NULL)
				$build_html_img .="<img src='".$array_images["url"]."' />\n";
			else
				$build_html_img .="<img aqua-slider-link='".$array_images["link"]."' src='".$array_images["url"]."' image-link-click='".$array_images["link"]."' />\n";
		}
	}else{
		echo "<h3> Não há imagens no slider! </h3>";
		return false;
	}
	//params ---
	$sql_params_slider = mysql_query($search_params) or die("ERROR ".mysql_error());
	$num_rows_params = mysql_num_rows($sql_params_slider);
	if($num_rows_params > 0){
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
	}

	//Build HTML
	?>
	<script>
		jQuery(document).ready(function(){
			jQuery('#aqua-slider-image-container').aquaSlider({
				<?php
					if(isset($params)){
						foreach($params as $key => $value){
							if($value == "")
								continue;

							echo $key.":\"$value\",";
						}
						echo "aquaSlider:\"on\" ";
					}else{
						echo "aquaSlider:\"on\" ";
					}
				?>
			});
		});
	</script>
	<?php
	echo "<div id='aqua-slider-image-container'> \n";
	echo $build_html_img;
	echo "</div>\n";
?>