
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
//echo"$balance";

           
/*      
function resultToArray($result1) {
    $rows = array();
    while($row2 = $result->fetch_assoc()) {
        $rows[] = $row2;
    }
    return $rows;
}
$query1="SELECT tid,receiver,sender,amount,sendon FROM transaction WHERE sender='".$email."' ";
$result1= $mysqli->query($query1);
$rows = resultToArray($result1);
var_dump($rows); // Array of rows
$result1->free();
*/
//$phnoo=$_SESSION['phones'];
//$timezone=$_SESSION['signs'];
//$balance=$_SESSION['bals'];



 
//if(isset($_POST["logout_submit"])){
 //unset($_SESSION['sess_name'])
 //session_destroy();
  //header('Location: '."login.php"); 
  //}

?>

<!DOCTYPE html>
<html>
<head>
     <title>Dashboard</title>	

   
  
    <link href="custom.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" type="text/css" href="log.css">
    <link rel="stylesheet" href="css/stylee.css" type="text/css">
    
    <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="css/zerogrid.css">
  <link rel="stylesheet" href="css/style.css">
  
  <link rel="stylesheet" href="css/menu.css"> 
</head>
<body>  
<div class="wrap-body"> 
   <header class="zerogrid">
      <div class="header">
      <h2>MoneyEXchange</h2>        
    </div>
      <div id='cssmenu'>
      <ul>
        <li class="active"><a href="#section1">Balance</a></li>
        <li class="active"><a href="#section5">History</a></li>
        <li class="active"><a href="#section3">business</a></li>
        <li class="active"><a href="#section4">interest</a></li>
        <li><a href='logout.php'><span>logout</span></a></li>
      </ul>
    </div>
    </header>
</div>


        <!-- /. NAV SIDE  -->
        
        <div id="page-inner">


                     <div>
                    <div>
                     <h2><strong>ADMIN DASHBOARD</strong></h2>   
                    </div>
                    </div> 


                 <!-- /. ROW  -->
            
                        <div>
                        <div>
                        <div class="alert alert-info">
                        <strong>Welcome <font color="red"><b><?=$_SESSION['sess_name'];?></b></font> ! </strong>
                        </div>                       
                        </div>
                        </div>             

                     
                     
                
                 <!-- /. ROW  --> 
               
                 
                      
                      <div class="div-square" id="section1">             
                      <strong><p>  MoneyEXchange BALANCE </p></strong>
                      <p>  Your balance is:₹  <strong><font color="red"><b><?php echo"$balance"; ?></b></font></p></strong>                      
                      </div>
                      

                      <div class="div-square" id="section5">
                      <b><p>Transaction History</p></b>
                      <?php 

                                      $sql1 = "SELECT * FROM transaction  WHERE sender='".$email."' OR receiver='".$email."' OR receiver='".$phnoo."' ORDER BY tid DESC limit 5";
                                      
                                      $result1 = $result=mysqli_query($conn,$sql1);
                                      echo "<table>";
                                      echo "<tr><th>Tid</th><th>Sender</th><th>Receiver</th><th>Amount</th><th>Date of Transaction</th></tr>";
                                      for($tot=1;$tot<6;$tot++)
                                     { 
                                      while($row1 = mysqli_fetch_array($result1)) {
                                      $tid = $row1['tid'];
                                      $sender=$row1['sender'];
                                      $receiver= $row1['receiver'];
                                      $amount = $row1['amount'];
                                      $timezone2 = $row1['sendon'];
                                      echo "<tr><td style='width: 40px;'>'".$tot."'</td><td style='width: 200px;'>'".$sender."'</td><td style='width: 200px;'>'".$receiver."'</td><td style='width: 70px;'>'".$amount."'</td><td style='width: 200px;'>'".$timezone2."'</td></tr>";
                                      break;
} 
}
echo "</table>";

                      ?>
                      </div>                  


                      <div class="div-square" id="section3">    
                      <p>send money to freinds or pay bills using MoneyEXchange</p>       
                      <a href="sends.php"><button class="cancelbtn">Send Money</button></a>                     
                      </div>


                      <div class="div-square" id="section4">
                      <a href="">Add Your Business Account</a>                      
                      <P>you can withdraw and deposit money to your and customer MoneyEXchange account</P>
                      <p>safe online banking</p>               
                      </div>                  
                                          
                      
                      <div class="div-square" id="section6">
                      <a>Interest on your wallet</a>                   
                      <P>you can delete a set transaction anytime you want</P>   
                        </div>                                               
    </div>       
   
</body>
</html>
