<?php
$host ="localhost";
$username ="root";
$password ="";
$database ="akademik";
$koneksi = mysqli_connect($host,$username,$password);

if($koneksi)
{
echo ("koneksi sukses");
}
else
{
echo ("koneksi gagal");
}


?>