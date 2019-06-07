<?php
function open_connection()
{ 
	$hostname="localhost";
	$username='root';
	$password='';
	$dbname="pbd";
	$koneki=@mysqli_connect($hostname,$username,$password,$dbname);
	if($koneki)
		$db=@mysqli_select_db($koneki,$dbname) or die("koneki gagal");
	return $koneki;
}

function open_connectionguest()
{ 
	$hostname="localhost";
	$username='guest';
	$password='guest';
	$dbname="pbd";
	$koneki=@mysqli_connect($hostname,$username,$password,$dbname);
	if($koneki)
		$db=@mysqli_select_db($koneki,$dbname) or die("koneki gagal");
	return $koneki;
}
?>