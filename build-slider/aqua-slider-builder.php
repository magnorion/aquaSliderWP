<?php
	$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD );
	mysqli_select_db( $con,DB_NAME );

	$table_images = "aqua_slider_image";
	$table_params = "aqua_slider_params";

	$search_images = "SELECT * FROM $table_images WHERE position != '0' ORDER BY position ASC";
	$search_params = "SELECT * FROM $table_params WHERE id = 1";

	//images ---
	$sql_images_slider = mysqli_query($con,$search_images) or die("ERROR ".mysqli_error($con));
	$num_rows_images = mysqli_num_rows($sql_images_slider);
	if($num_rows_images > 0){
		$build_html_img = "";
		for($i=1;$i<=$num_rows_images;$i++){
			$array_images = mysqli_fetch_array($sql_images_slider);
			if($array_images["link"] == "" || $array_images["link"] == " " || $array_images["link"] === NULL)
				$build_html_img .="<img src='".$array_images["url"]."' />\n";
			else
				$build_html_img .="<a href='".$array_images["link"]."'><img src='".$array_images["url"]."' image-link-click='".$array_images["link"]."' /></a>\n";
		}
	}else{
		echo "<h1> Não existem imagens! </h1>";
		echo "<h2> Vá para a página de adminstração do Wordpress e acesse a página de configurações do aqua slider. </h2>";
		return false; // Não existem imagens!
	}
	//params ---
	$sql_params_slider = mysqli_query($con,$search_params) or die("ERROR ".mysqli_error($con));
	$num_rows_params = mysqli_num_rows($sql_params_slider);
	if($num_rows_params > 0){
		$array_params = mysqli_fetch_array($sql_params_slider);
		$params = array(
			"width" => $array_params['width'],
			"height" => $array_params['height'],
			"bullet" => $array_params['bullet'],
			"animation" => $array_params['animation'],
			"type" => $array_params['type'],
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