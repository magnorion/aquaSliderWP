<?php
	$table_name = 'aqua_slider_params';
	
	$con = mysqli_connect( DB_HOST, DB_USER, DB_PASSWORD );
	mysqli_select_db( $con,DB_NAME );

	$find_table = mysqli_query($con,"SELECT * FROM ".$table_name." WHERE id != '' ");

	if($find_table === FALSE){
		$aqua_slider_create_table = "CREATE TABLE ".$table_name."(
				id int(10) AUTO_INCREMENT,
				width varchar(10),
				height varchar(10),
				bullet varchar(20),
				type varchar(20),
				animation varchar(10),
				control varchar(5),
				autoPlay varchar(5),
				PRIMARY KEY (id)
			);";
		$build_table = mysqli_query($con,$aqua_slider_create_table) or die("ERROR CREATE! ".mysqli_error($con));
	}
?>