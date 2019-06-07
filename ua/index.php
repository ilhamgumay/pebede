<?php
session_start();
$idletime=60;//udah 60 detik dia logout gaees
if (time()-$_SESSION['timestamp']>$idletime){
    header('Location:sistem.php?op=out');
}else{
    $_SESSION['timestamp']=time();
}
//on session creation
$_SESSION['timestamp']=time();

if(!isset($_SESSION['username'])){ header("location:login.php"); }
$a = $_SESSION['level'];
//else { header("location:sistem.php"); }
?>
<h2>
<?php
If($_SESSION['jenisuser']=='0'){$ju='User-Client';} else {$ju='User-Admin';}
echo $ju.'<hr>';
?>
</h2>
<h3>
<?php echo " Welcome ".$_SESSION['username'].' |
<a href=sistem.php?op=out>Log Out</a> '; ?>
?>
</h3>
<?php
switch ($a) {
 case "10":
 read_datasuperadmin();
 break;
 case "11":
 read_admin();
 break;
 case "00":
 read_user();
 break;
 //case "guest":
 //read_guest();
 //break;
 default:
 read_data();
 break;}
?>
<?php
function read_data()
{
?>
-
<?php
}
?>
<?php
function read_datasuperadmin()
{
 ?>
<h1> <a href="curd_user.php?a=a">user</a>  
<h1><a href="curd_prodi.php?a=b">prodi</a> </h1>
<?php
}
?>
<?php
function read_admin()
{
?>
<h1> <a href="curd_user.php?a=a">user</a>  
<?php


/*if(ctype_alnum('a')) {
    echo "String contains only letters and numbers.";
}
else {
    echo "String doesn't contain only letters and numbers.";
}*/

}
?>
<?php
function read_user()
{
 ?>
<h1> anda login sebagai user biasa</h1> 

<?php
}

?>