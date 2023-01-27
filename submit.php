<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "lottery";
$conn = new mysqli($servername, $username, $password, $dbname);
if(empty($_POST['email'])  		||
   empty($_POST['name']) 		||
   empty($_POST['address'])     ||
   empty($_POST['phone']))
   {
	echo "No arguments Provided!";
	return false;
   }
$name = $_POST['name'];
$email_address = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$query= "insert into entries(Email,Name,Address,Phone) values('$email_address','$name','$address','$phone')";
header('Location: Lottery Submitted.html');
mysqli_query($conn,$query);

return true;






?>