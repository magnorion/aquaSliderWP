<?php
	$table_name = 'aqua_slider_image';
	
	$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
	mysqli_select_db( $con, DB_NAME );

	$find_table = mysqli_query($con,"SELECT * FROM ".$table_name." WHERE id != '' ");

	if($find_table === FALSE){
		$aqua_slider_create_table = "CREATE TABLE ".$table_name."(
				id int(10) AUTO_INCREMENT,
				url varchar(200) NOT NULL,
				link varchar(200) NOT NULL,
				position varchar(3),
				PRIMARY KEY (id)
			);";
		$build_table = mysqli_query($con, $aqua_slider_create_table) or die("ERROR CREATE! ".mysqli_error($con));
	}
?>