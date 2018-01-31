<?php 


$conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$query="SELECT * FROM signup";
$result=mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
   $email=$row['Email'];
   $phnoo=$row['phoneno'];
   $balance=$row['Balance'];

/*
$sql17="SELECT signupon FROM signup WHERE Email='".$email."'";
$result17=mysqli_query($conn,$sql17);
$row17= mysqli_fetch_assoc($result17);
$tmzn= implode(" ",$row17);
$timezone1 = substr($tmzn, 0, 4);
$timezone2= substr($tmzn, 5,2);
$timezone3 = substr($tmzn, 8, 2);
$timezone4=$timezone1.$timezone2.$timezone3;
//echo"$timezone4";

date_default_timezone_set('Asia/Kolkata');
$timezone5 = date('Ymd');
//echo"-$timezone5";


$date1 = new DateTime($tmzn);
$date2 = new DateTime($timezone5);
$date3=$date2->diff($date1)->format("%a");
echo"$date3";
*/


date_default_timezone_set('Asia/Kolkata');
$timezone6 = date('Y-m-d H:i:s');
//echo"-$timezone6";

date_default_timezone_set('Asia/Kolkata');
$timezone7= strtotime(date('Y-m-d H:i:s') . ' -30 days');
//echo(date('Y-m-d H:i:s', $timezone7));


/*
for($i=0;$i<=100;$i++)
{
  if($date3<=30*$i)
  {
    $j=$i-1;
    echo"$j";
    break;

  } 
} 
*/






/*

$sql25 = "SELECT tid FROM transaction WHERE sender='".$email."'  ORDER BY tid DESC LIMIT 1";
$result25=mysqli_query($conn,$sql25);
$row25= mysqli_fetch_assoc($result25);
$firstid=implode(" ",$row25);

$sql26 = "SELECT tid FROM transaction WHERE receiver='".$email."' OR receiver='".$phnoo."' ORDER BY tid DESC LIMIT 1";
$result26=mysqli_query($conn,$sql26);
$row26= mysqli_fetch_assoc($result26);
$secondid=implode(" ",$row26);

*/

if($date3==30){
$rate=0.04;

      

        $sql31 = "SELECT MIN(Balanceofsender) FROM transaction WHERE sender='".$email."' AND sendon between '$timezone7' AND '$timezone6'";
        $result31=mysqli_query($conn,$sql31);
        $row31= mysqli_fetch_assoc($result31);
        $principal1=implode(" ",$row31);
        //echo"-$principal1";

        
        $sql32 = "SELECT MIN(Balanceofreceiver) FROM transaction WHERE receiver='".$email."' OR receiver='".$phnoo."' AND sendon between '$timezone7' AND '$timezone6'";
        $result32=mysqli_query($conn,$sql32);
        $row32= mysqli_fetch_assoc($result32);
        $principal2=implode(" ",$row32);
        //echo"-$principal2";



        if($firstid>$secondid) 
        {
          $principal=$principal1;
        }  
        else
        {
          $principal=$principal2;
        }

        echo"-$principal";


       
       $balance=$balance+($principal*1*$rate)/100);
       $balance=round($balance,2);
              
       $sql22="UPDATE signup SET Balance=$balance WHERE Email='".$email."'" ;
       $result22=mysqli_query($conn,$sql22);
       
       if($firstid>$secondid)
       {
        $sql29="UPDATE transaction SET Balanceofsender=$balance WHERE tid='".$firstid."'";
        $result29=mysqli_query($conn,$sql29);
       }
       else
       {
        $sql30="UPDATE transaction SET Balanceofreceiver=$balance WHERE tid='".$secondid."'";
        $result30=mysqli_query($conn,$sql30);
       }
        
       

    }
 }


/*
$numlen=strlen((string)$date3);
$numlen2=$numlen-1;

$m=substr($date3,$numlen2,$numlen);

if($m==0)
for($i=1;$i<=100;$i++)
{
 if($date3==30*($i))
 {
  $n=$i;
  break;
 }
}

$l=2;
$k=3;

if($l!=$l++){
$l=$l+$l++;
$k++;
}

$p=$l/$k++;
echo"$k++";
$i=0.05;
$p=10000;

$loo=1+$i;
$poo=pow($loo,$n);

$ci=$p*($poo-1);

$p=$p+$ci;
*/
   


 ?>