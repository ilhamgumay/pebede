
<?php
session_start();
//error_reporting(0);

$idletime=60;//udah 60 detik dia logout gaees
if (time()-$_SESSION['timestamp']>$idletime){
    header('Location:sistem.php?op=out');
}else{
    $_SESSION['timestamp']=time();
}
//on session creation
$_SESSION['timestamp']=time();


if(!isset($_SESSION['username'])){ header("location:login.php"); }

 if($_SESSION['jenisuser'] !='1' || $_SESSION['level'] =='00') { header("location:index.php"); }

?>
<h2>
<?php
if($_SESSION['level']=='10'){$ju='Super-Admin';} else {$ju='User-Admin';}
echo $ju.'<hr>';
?>


</h2>
<h3>
<?php echo " Welcome ".$_SESSION['username'].' |
<a href=sistem.php?op=out>Log Out</a> '; ?>
?>
</h3>

<?php
require("../sistem/koneksi.php");
$hub=open_connection();
$a = @$_GET["a"];
$iduser = @$_GET["id"];
$sql = @$_POST["sql"];
switch ($sql) {
 case "create":
 create_user();
 break;
 case "update":
 update_user();
 break;
 case "delete":
 delete_user();
 break;
}
switch ($a) {
 case "list":
 read_data();
 break;
 case "input":
 input_data();
 break;
 case "edit":
 edit_data($iduser);
 break;
 case "hapus":
 hapus_data($iduser);
 break;
 default:
 read_data();
 break;
}
mysqli_close($hub);
?>
<?php
function read_data() {
global $hub;


if($_SESSION['level'] == '10') {
	$query= "select * from user where level != '10' ";
}else { 
$prodinya = $_SESSION['idprodi'];
$query= "select * from user where level = '00' and idprodi = ".$_SESSION['idprodi']; ;}


$result = mysqli_query($hub,$query);
?>
<h2>Read Data User</h2>
<table border=1 cellpadding=2>
<tr><td colspan="5">
<a href="curd_user.php?a=input">INPUT</a>
</td><td colspan="5">
<a href="index.php">BACK</a>
</td></tr>
<tr><td>ID</td><td>USERNAME</td><td>JENIS USER</td><td>LEVEL</td><td>STATUS</td><td>ID PRODI </td></tr>
<?php
while($row = mysqli_fetch_array($result))
{
?>
<tr>
<td><?php echo $row['iduser']; ?></td>
<td><?php echo $row['username']; ?></td>
<td><?php echo $row['jenisuser']; ?></td>
<td><?php echo $row['level']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['idprodi']; ?></td>
<td>
<a href="curd_user.php?a=edit&id=<?php echo $row['iduser']; ?>">EDIT</a>
<a href="curd_user.php?a=hapus&id=<?php echo $row['iduser']; ?>">HAPUS</a>
</td>
</tr>
<?php
}
?>
</table>
<?php
}
?>
<?php
function input_data() {
$row = array(
 "idprodi" => "1",
 "username" => "",
 "password" => "",
 "jenisuser" => "0",
 "level" => "00",
 "idprodi" => "1",
 "status" => "",
"akreditasi" => "-");
?>
<h2>Input Data user</h2>
<form name = "inputan" action="curd_user.php?a=list" method="post" onsubmit="return validasi_input(this)">
<input type="hidden" name="sql" value="create">
email&#160; &#160;&#160;&#160;&#160; 
<input type="text" name="username" maxlength="70" size="70" value="<?php echo trim($row["username"]) ?>" /><br>
password
<input type="text" name="password" maxlength="70" size="70" value="<?php
echo trim($row["password"]) ?>" /><br>
Jenis User
<input type="radio" name="jenisuser" value="0" <?php if($row["jenisuser"]=='0'
|| $row["jenisuser"]=='0') { echo "checked=\"checked\""; } else {echo ""; } ?>> 0
<input type="radio" name="jenisuser" value="1" <?php
if($row["jenisuser"]=='1') {echo "checked=\"checked\""; } else {echo ""; } ?> > 1
<br>
Jenis User
<input type="radio" name="level" value="00" <?php
if($row["level"]=='00') {echo "checked=\"checked\""; } else {echo ""; } ?> > 00
<input type="radio" name="level" value="11" <?php
if($row["level"]=='11') {echo "checked=\"checked\""; } else {echo ""; } ?> > 11
<input type="hidden" name="status" value="F">
<br>
idprodi
<input type="radio" name="idprodi" value="1" <?php
if($row["idprodi"]=='1') {echo "checked=\"checked\""; } else {echo ""; } ?> > 1
<input type="radio" name="idprodi" value="2" <?php
if($row["idprodi"]=='2') {echo "checked=\"checked\""; } else {echo ""; } ?> > 2
<input type="radio" name="idprodi" value="3" <?php
if($row["idprodi"]=='3') {echo "checked=\"checked\""; } else {echo ""; } ?> > 3
<input type="radio" name="idprodi" value="4" <?php
if($row["idprodi"]=='4') {echo "checked=\"checked\""; } else {echo ""; } ?> > 4
<input type="radio" name="idprodi" value="5" <?php
if($row["idprodi"]=='5') {echo "checked=\"checked\""; } else {echo ""; } ?> > 5
<br><input type="submit" name="action" value="Simpan"><br>
<a href="curd_user.php?a=list">Batal</a>
</form>
<?php
}
?>
<?php
function edit_data($iduser) {
global $hub;
$query= "select * from user where iduser = $iduser";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>
<h2>Edit Data User</h2>
<form action="curd_user.php?a=list" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="iduser" value="<?php echo trim($iduser) ?>">
username
<input type="text" disabled="disabled"  name="username" maxlength="70" size="70" value="<?php echo trim($row["username"]) ?>" /><br>
password
<input type="text" name="password" maxlength="70" size="70" value="<?php
echo trim($row["password"]) ?>" /><br>
Jenis User
<input type="radio" name="jenisuser" value="0" <?php if($row["jenisuser"]=='0'
|| $row["jenisuser"]=='0') { echo "checked=\"checked\""; } else {echo ""; } ?>> 0
<input type="radio" name="jenisuser" value="1" <?php
if($row["jenisuser"]=='1') {echo "checked=\"checked\""; } else {echo ""; } ?> > 1
<br>
Jenis User
<input type="radio" name="level" value="00" <?php
if($row["level"]=='00') {echo "checked=\"checked\""; } else {echo ""; } ?> > 00
<input type="radio" name="level" value="11" <?php
if($row["level"]=='11') {echo "checked=\"checked\""; } else {echo ""; } ?> > 11
<br>
<input type="hidden" name="status" value="F">
idprodi
<input type="radio" name="idprodi" value="1" <?php
if($row["idprodi"]=='1') {echo "checked=\"checked\""; } else {echo ""; } ?> > 1
<input type="radio" name="idprodi" value="2" <?php
if($row["idprodi"]=='2') {echo "checked=\"checked\""; } else {echo ""; } ?> > 2
<input type="radio" name="idprodi" value="3" <?php
if($row["idprodi"]=='3') {echo "checked=\"checked\""; } else {echo ""; } ?> > 3
<input type="radio" name="idprodi" value="4" <?php
if($row["idprodi"]=='4') {echo "checked=\"checked\""; } else {echo ""; } ?> > 4
<input type="radio" name="idprodi" value="5" <?php
if($row["idprodi"]=='5') {echo "checked=\"checked\""; } else {echo ""; } ?> > 5
<br><input type="submit" name="action" value="Simpan"><br>
<a href="curd_user.php?a=list">Batal</a>
</form>
<?php
}
?>
<?php
function hapus_data($iduser) {
global $hub;
global $usernameuser;
$query= "select * from user where iduser = $iduser";
$result = mysqli_query($hub,$query);
$row = mysqli_fetch_array($result);
?>
<h2>Hapus Data User</h2>
<form action="curd_user.php?a=list" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="iduser" value="<?php echo trim($iduser) ?>">
<table>
<tr><td width=100>username</td><td><?php

$_SESSION['usernameuser'] = $row["username"];
 echo trim($row["username"])?></td></tr>
</table>
<br><input type="submit" name="action" value="Hapus"><br>
<a href="curd_user.php?a=list">Batal</a>
</form>
<?php
}?>
<?php
function create_user()
{
 global $hub;
 global $_POST;
 $query = "INSERT INTO `user` (`iduser`, `username`, `password`, `jenisuser`, `level`, `status`, `idprodi`) VALUES ";
 $query .= " (NULL, '" .$_POST["username"]."', '" .$_POST["password"]."', '" .$_POST["jenisuser"]."', '" .$_POST["level"]."', 'F', '" .$_POST["idprodi"]."');";

 mysqli_query( $hub,$query) or die(mysqli_error($hub));

 $query2 ="CREATE USER '" .$_POST["username"]."'@'localhost' IDENTIFIED BY '" .$_POST["password"]."'";
  mysqli_query( $hub,$query2) or die(mysqli_error($hub));
  $query3 = "GRANT ALL PRIVILEGES ON pbd.* TO '" .$_POST["username"]."'@'localhost' IDENTIFIED BY '" .$_POST["password"]."'";
    mysqli_query( $hub,$query3) or die(mysqli_error($hub));
    header('Location: curd_user.php');
}
function update_user()
{
 global $hub;
 global $_POST;
 $query = "UPDATE `user` ";
 $query .= "  SET `username` = '" .$_POST["username"]."', `password` = '" .$_POST["password"]."', `jenisuser` = '" .$_POST["jenisuser"]."', `level` = '" .$_POST["level"]."', `status` = 'F', `idprodi` = '" .$_POST["idprodi"]."' WHERE `user`.`iduser` = " .$_POST["iduser"].";";
 mysqli_query( $hub,$query) or die(mysqli_error($hub));
$query2 = "SET PASSWORD FOR '" .$_POST["username"]."'@'localhost' = PASSWORD('" .$_POST["password"]."');";
 mysqli_query( $hub,$query2) or die(mysqli_error($hub));
 header('Location: curd_user.php');
}
function delete_user()
{
 global $hub;
 global $_POST;
$query2 = "DROP USER '" .$_SESSION['usernameuser']."'@'localhost';";
  mysqli_query( $hub,$query2) or die(mysqli_error($hub));
$query = "DELETE FROM `user` WHERE iduser = ".$_POST["iduser"];
 mysqli_query( $hub,$query) or die(mysqli_error());
 header('Location: curd_user.php');
}
?>


<script type="text/javascript">
function validasi_input(form){


var x=document.forms["inputan"]["username"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("email harus valid");
  return false;
  }
  if (form.username.value == ""){
    alert("Username masih kosong!");
    form.username.focus();
    return (false);
  }
  if (form.password.value == ""){
    alert("password masih kosong!");
    form.password.focus();
    return (false);
  }
return (true);
}
</script>