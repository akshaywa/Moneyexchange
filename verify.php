<?php

$conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


$sql15="SELECT COUNT(*) FROM verify";
$result15=mysqli_query($conn,$sql15);
$row15= mysqli_fetch_assoc($result15);
$ticktic= implode(" ",$row15);


if($ticktic<5)
for($tic=$ticktic;$tic<5;$tic++)
{
$pi=rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
$sql46="INSERT INTO verify(vcd)VALUES('$pi')";
$result46=mysqli_query($conn,$sql46);
}


date_default_timezone_set('Asia/Kolkata');
$timezone = date('Y-m-d H:i:s');
$balance=0;



if(isset($_POST["ver_submit"])){
$verii= $_POST['verifi'];



$query40="SELECT vcd FROM verify ORDER BY vid ASC LIMIT 1;";
$result40=mysqli_query($conn,$query40);
$row40= mysqli_fetch_assoc($result40);
$vertt=$row40['vcd'];
    
if($verii==$vertt)
{
$query43="SELECT Name,Email,Password,phoneno,vercode FROM signuping WHERE vercode='".$verii."'";
$result43=mysqli_query($conn,$query43);
$row43= mysqli_fetch_assoc($result43);
$name=$row43['Name'];
$email=$row43['Email'];
$password=$row43['Password'];
$phnoo=$row43['phoneno'];
$vertt=$row43['vercode'];


	
$sql="INSERT INTO signup(Name,Email,Password,signupon,phoneno,Balance)VALUES('$name','$email','$password','$timezone','$phnoo','$balance')";
$result=mysqli_query($conn,$sql);



$sql44="DELETE FROM signuping WHERE vercode='".$vertt."'";
$result44=mysqli_query($conn,$sql44);


$sql45="DELETE FROM verify WHERE vcd='".$vertt."'";
$result45=mysqli_query($conn,$sql45);



      //result message
      if($result){ 
         session_start();
         $_SESSION['sess_name']=$name;
         $_SESSION['sess_pwdd']=$password;
        
         header('Location: '."Dashboard.php"); 
      }
      else
      {
        echo"failure";
      }


}

}

/*
$query12="SELECT * FROM signuping LIMIT1";
$result12=mysqli_query($conn,$query12);
$row12= mysqli_fetch_assoc($result12);
$email=$row12['Email'];
$phnoo=$row12['phoneno'];
$name=$row12['Name'];
$password=$row12['Password'];
$verii=$row12['vercode'];


$query11="SELECT * FROM verify LIMIT 1";
$result11=mysqli_query($conn,$query11);
$row11= mysqli_fetch_assoc($result11);
$vertt=$row11['vcd'];


if($verii==$vertt)
{
$sql14="DELETE FROM verify LIMIT1";
$result14=mysqli_query($conn,$sql14);


$sql14="DELETE FROM signuping LIMIT1";
$result14=mysqli_query($conn,$sql14);

	
$sql="INSERT INTO signup(Name,Email,Password,signupon,phoneno,Balance)VALUES('$name','$email','$password','$timezone','$phnoo','$balance')";
$result=mysqli_query($conn,$sql);


if($result){ 
         session_start();
         $_SESSION['sess_name']=$name;
         $_SESSION['sess_pwdd']=$password;
        
         header('Location: '."Dashboard.php"); 
      }

}

*/




?>

<!DOCTYPE html>
<body>

<form name="myform6" method="post">
<input type="password" placeholder="Enter verification Code" name="verifi" required><br><br>   
<button type="submit" name="ver_submit">Enter verification code</button>
</form>	

</body>
</html>




