<?php
	$table_name = 'aqua_slider_params';
	
	$con = mysql_connect( DB_HOST, DB_USER, DB_PASSWORD ) or trigger_error( mysql_error(), E_USER_ERROR );
	mysql_select_db( DB_NAME, $con );

	$find_table = mysql_query("SELECT * FROM ".$table_name." WHERE id != '' ");

	if($find_table === FALSE){
		$aqua_slider_create_table = "CREATE TABLE ".$table_name."(
				id int(10) AUTO_INCREMENT,
				width varchar(10) NOT NULL,
				height varchar(10) NOT NULL,
				bullet varchar(20),
				animation varchar(10),
				player varchar(5),
				control varchar(5),
				autoPlay varchar(5),
				PRIMARY KEY (id)
			);";
		$build_table = mysql_query($aqua_slider_create_table) or die("ERROR CREATE! ".mysql_error());
	}
?>