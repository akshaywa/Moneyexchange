<?php

session_start();

if(!$_SESSION['sess_name']){
header("location:login.php");
die;
}

$name= $_SESSION['sess_name'];
$password= $_SESSION['sess_pwdd'];




$conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$query="SELECT Email,phoneno,Balance FROM signup WHERE Name='".$name."' AND Password='".$password."'";
$result=mysqli_query($conn,$query);
$row= mysqli_fetch_assoc($result);
$email=$row['Email'];
$phnoo=$row['phoneno'];
$balance=$row['Balance'];



$sql15="SELECT COUNT(*) FROM enter";
$result15=mysqli_query($conn,$sql15);
$row15= mysqli_fetch_assoc($result15);
$ticktick= implode(" ",$row15);


$code= $_POST['promo'];


$sql25 = "SELECT tid FROM transaction WHERE sender='".$email."'  ORDER BY tid DESC LIMIT 1";
$result25=mysqli_query($conn,$sql25);
$row25= mysqli_fetch_assoc($result25);
$firstid=implode(" ",$row25);


$sql26 = "SELECT tid FROM transaction WHERE receiver='".$email."'  ORDER BY tid DESC LIMIT 1";
$result26=mysqli_query($conn,$sql26);
$row26= mysqli_fetch_assoc($result26);
$secondid=implode(" ",$row26);



$query11="SELECT * FROM enter WHERE pin='".$code."' ";
$result11=mysqli_query($conn,$query11);
$numrows11=mysqli_num_rows($result11);
if($numrows11!=0)
{

  $row11= mysqli_fetch_assoc($result11);

  $query12="SELECT Balance FROM signup WHERE Name='".$name."' AND Password='".$password."'";
  $result12=mysqli_query($conn,$query12);
  $row12= mysqli_fetch_assoc($result12);
  $balancee=$row12['Balance'];
  $addd=$row11['moneye'];

  $balancee=$balancee+$addd;
  $sql13="UPDATE signup SET Balance='".$balancee."' WHERE Name='".$name."' AND Password='".$password."' ";
  $result13=mysqli_query($conn,$sql13);


if($firstid>$secondid)
{
 $sql27="UPDATE transaction SET Balanceofsender='".$balancee."' WHERE tid='".$firstid."'";
 $result27=mysqli_query($conn,$sql27);
}
else
{
 $sql28="UPDATE transaction SET Balanceofreceiver='".$balancee."' WHERE tid='".$secondid."'";
 $result28=mysqli_query($conn,$sql28);
}

  $sql14="DELETE FROM enter WHERE pin='".$code."'";
  $result14=mysqli_query($conn,$sql14);

  echo"$balancee";

}
else{echo"Code does not matches";}



if($ticktick<100)
for($tick=$ticktick;$tick<100;$tick++)
{
$pin=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
$pincode= array(1000,5000,100,500);
$moneye= $pincode[array_rand($pincode, 1)];

//echo"$pin";

if($pin!=$pin++&&$moneye!=$moneye++)
{
$conn= mysqli_connect('localhost','root','','moneyexchange');
$sql="INSERT INTO enter(pin,moneye)VALUES('$pin','$moneye')";
$result=mysqli_query($conn,$sql);
}	
}



header('Location: Dashboard.php');

?>