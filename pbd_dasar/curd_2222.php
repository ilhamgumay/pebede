<?php
require("../sistem/koneksi.php");
$hub=open_connection();
$a=@$_GET["a"];
$sql=@$_POST["sql"];
switch ($sql) {
	case "create":
		create_prodi();
				break;
	
	}
	switch ($a) {
		case "list":
			# code...
		read_data();
			break;
			case "input":
				input_data();
				break;
		
		default:
			read_data();
			break;
	}