<?php
error_reporting(0);
$a = $_GET["a"];
switch ($a) {
 case "f":
 forgotpass();
 break;
 case "register":
 read_admin();
 break;
 case "prosses":
 prosses();
 break;
 default:
 login();
 break;}
?>
<?php
function login()
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>USER AUTHENTICATION</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->

	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
				
				<form action="sistem.php?op=in" method="post" class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-51">
						Login
					</span>

					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Username is required">
						<input class="input100" type="text" name="usr" placeholder="Username">
						<span class="focus-input100"></span>
					</div>
					
					
					<div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="psw" placeholder="Password">
						<span class="focus-input100"></span>
					</div>
					
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="login.php?a=f" class="txt1">
								Forgot?
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
}
?>
<?php
function forgotpass()
{
?>
<form action="login.php?a=prosses" method="post">
<h3> masukan email anda</h3>
<div>email : <input type="text" name="Username" /></div>
<div><input type="submit" value="kirim" /></div>
</form>
<?php
}
function prosses()
{ 
require("../sistem/koneksi.php");
$hub=open_connectionguest();
$query= "select * from user where Username = '".$_POST['Username']."'";
$result = mysqli_query($hub,$query);
if($row = mysqli_fetch_array($result))
{
$headers='';
$to = $row['username'];
$subject = 'lupa pass';
$messages ='password anda adalahhhh'.$row['password'];
    
$headers .= 'From:<apanamanya006@gmail.com>' . "rn"; //bagian ini diganti sesuai dengan email dari pengirim
@mail($to, $subject, $messages, $headers.php);
if(@mail) 
{
    echo "pengiriman password berhasil, silakan cek email anda "; 
}
else 
{
    echo "pengiriman gagal";
}
}
else {echo "email yang anda masukan tidak tersedia di database  ada";}
} 
?>