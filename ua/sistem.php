<?php
error_reporting(0);
session_start();
$idletime=60;//udah 60 detik dia logout gaees
if (time()-$_SESSION['timestamp']>$idletime){
    header('Location:sistem.php?op=out');
}else{
    $_SESSION['timestamp']=time();
}
//on session creation
$_SESSION['timestamp']=time();
$_SESSION['unamedb'] = $_POST['usr'];
$_SESSION['pswdb'] = $_POST['psw'];
require("../sistem/koneksi.php");
$hub=open_connection();
$hub2=open_connectionguest();
$usr = $_POST['usr'];
$psw = $_POST['psw'];
$op = $_GET['op'];
$id =  $_SESSION['iduser'];
if($op=="in"){
 $cek = mysqli_query($hub, "SELECT * FROM user WHERE username='$usr' AND
password='$psw' AND status = 'F' ");
 if(mysqli_num_rows($cek)==1){
 $c = mysqli_fetch_array($cek);
 $_SESSION['username'] = $c['username'];
 $_SESSION['jenisuser'] = $c['jenisuser'];
 $_SESSION['level']= $c['level'];
  $_SESSION['iduser'] = $c['iduser'];
    $_SESSION['idprodi'] = $c['idprodi'];
 $iduser =$c['iduser'];
 $cek = mysqli_query($hub, "UPDATE `user` SET `status` = 'T' WHERE `user`.`iduser` = $iduser; ");
  header("location:index.php");
}

 /*if($_SESSION['jenisuser']=='1' && $_SESSION['level']=='11') { header("location:page_admin.php"); } // untuk redirect admin biasa
 else  if($_SESSION['jenisuser']=='1' && $_SESSION['level']=='10') { header("location:page_admin.php"); } // untuk redirect super admin
 else { header("location:index.php"); }

 }else{
 die("username / password salah  atau user sedang login <a
href=\"javascript:history.back()\">kembali</a>");
 */
else{
 die("username / password salah  atau user sedang login <a
href=\"javascript:history.back()\">kembali</a>");
 }

mysqli_close($hub);
}else if($op=="out"){


	$cekk = mysqli_query($hub2, "UPDATE `user` SET `status` = 'F' WHERE `user`.`iduser` = $id ; ");
session_unset(); 
session_destroy();
 header("location:index.php");
}

?>