<?php
session_start();

if(!$_SESSION['sess_name']){
header("location:login.php");
die;
}

$name= $_SESSION['sess_name'];
$password= $_SESSION['sess_pwdd'];
//echo"$name";



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

date_default_timezone_set('Asia/Kolkata');
$timezone2 = date('Y-m-d H:i:s');

?>

<!DOCTYPE HTML>

<html>
<head>
<title>sendmoney</title>
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


<div id="id05" class="modal">
  
  <form class="modal-content animate"  name="myform3" autocomplete="on" method="post" onsubmit="return ValidateForm3()">
   

    <div class="container">

      <label><b>Mobile number or email</b></label><br><br>
      <div>
      <input type="text" placeholder="Enter Mobile no or Email" name="emailphno" onblur="ValidatePhno()" required><br>
      </div>
      <div id="EmailPhnoError3"></div><br>

      <label><b>Amount</b></label><br><br>
      <div>
      <input type="text" placeholder="Enter amount" name="amt" onblur="ValidateAmount()" required><br><br>
      </div>
      <div id="AmountError3"></div><br>
      
      <label><b>Enter comment</b></label><br><br>
      <div>
      <input type="text" placeholder="Enter comment" name="cmnt" onblur="ValidateComment()" ><br><br>
      </div>
      <div id="CommentError3"></div><br>

      <button type="submit" name="send_submit"  class="sendmoney">Send Money</button>
      
      <font color="red" size="4"><b><?php
      if(isset($_POST["send_submit"])){
      $dbreceiver;
      $receiver= $_POST['emailphno'];
      $sender=$email;
      $amount= $_POST['amt']; 
      $conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');

      

 if($receiver!=$sender)
 {        
   $query5="SELECT * FROM signup WHERE Email='".$receiver."' OR phoneno='".$receiver."'";
   $result5=mysqli_query($conn,$query5);
   $numrows5=mysqli_num_rows($result5);
   if($numrows5!=0)
   {
     
      
       if($balance!=0)
       {
        if($balance>=$amount)
        {
          //  IF USER HAVE TWO ACCOUNTS THE EMAILID AND PHONENO OF BOTH ACCOUNTS MUST DIFFERENT
          $sql1="UPDATE signup SET Balance=Balance+$amount WHERE Email='".$receiver."' OR phoneno='".$receiver."'";
          $sql2="UPDATE signup SET Balance=Balance-$amount WHERE Email='".$sender."'";                                  
          $result1=mysqli_query($conn,$sql1);
          $result2=mysqli_query($conn,$sql2);  


          $query23="SELECT Email,phoneno,Balance FROM signup WHERE Name='".$name."' AND Password='".$password."'";
          $result23=mysqli_query($conn,$query23);
          $row23= mysqli_fetch_assoc($result23);
          $mailmail1=$row23['Email'];
          $balance1=$row23['Balance'];

          $query24="SELECT Email,phoneno,Balance FROM signup WHERE Email='".$receiver."' OR phoneno='".$receiver."'";
          $result24=mysqli_query($conn,$query24);
          $row24= mysqli_fetch_assoc($result24);
          $mailmail2=$row24['Email'];
          $balance2=$row24['Balance'];




          $sql="INSERT INTO transaction(receiver,sender,amount,sendon,Balanceofsender,Balanceofreceiver)VALUES('$receiver','$sender','$amount','$timezone2','$balance1','$balance2')";
          $result3=mysqli_query($conn,$sql);



//sender smtp
$to      = $mailmail1;
$subject = ' MoneyEXchange Account Transaction ';
$message = ' Your Account is debited with INR ';
$message .=$amount;
$message .=' WDL ';
$message .=$timezone2;
$message .=' Avbl Bal ';
$message .=$balance1;
$message .=' .Click MoneyEXchange.com for more details. ';
$headers = 'From: walunja11@gmail.com' . "\r\n" .
           'Reply-To: walunja11@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    die("Failure: Email was not sent!");
}


//receiver smtp
$to      = $mailmail2;
$subject = ' MoneyEXchange Account Transaction ';
$message = ' Your Account is credited with INR ';
$message .=$amount;
$message .=' WDL ';
$message .=$timezone2;
$message .=' Avbl Bal ';
$message .=$balance2;
$message .=' .Click MoneyEXchange.com for more details. ';
$headers = 'From: walunja11@gmail.com' . "\r\n" .
           'Reply-To: walunja11@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if(mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    die("Failure: Email was not sent!");
}


          header('Location:sends.php');          
        }
        else{echo"You have not sufficient balance";}
       }
       else{echo"Your balance is zero";}
      
    }
    else{echo"No such user";}
 }
 else{echo"please enter valid receiver";}
}
      

      ?></b></font>


    </div>
  </form>
</div>



 <script type="text/javascript">     
    

function ValidatePhno()
        {
           // phone validation
           var emailID = document.myform3.emailphno.value;

           if(isNaN(emailID))
           {
             var letters= /^[a-zA-Z0-9_ ]*$/;
                if( document.myform3.emailphno.value == "" )
                 {
                    document.getElementById("EmailPhnoError3").innerHTML= "*Please provide your Email!";
                    //document.signup.Email.focus() ;
                    return false;
                 }
                
                atpos = emailID.indexOf("@");
                dotpos = emailID.lastIndexOf(".");
         
                 if(atpos < 1 || ( dotpos - atpos < 2 )) 
                 {
                    document.getElementById("EmailPhnoError3").innerHTML="*Please enter correct email ID";
                    //document.signup.Email.focus() ;
                    return false;
                 }  
                
                else{
                    return true;
                }         
           }
            

           else
           {    if(emailID.indexOf(" ")!=-1||emailID=="")
           {
              document.getElementById("EmailPhnoError3").innerHTML="*Please enter email or phone no";
              return false; 
           }
           if (emailID.length>10||emailID.length<10)
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter 10 digits phone no";
                return false;
           }
           
           if (emailID.charAt(0)!="9"&&x.charAt(0)!="8"&&x.charAt(0)!="7")
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter valid phone no";
                return false;
           }
           return true;  
           } 

        }


function ValidateAmount()
        {  
          //Amount validation
           var x = document.myform3.amt.value;
           
           if(isNaN(x)||x.indexOf(" ")!=-1||x=="")
           {
              document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
              return false; 
           }
           if (x.length>5)
           {
                document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
                return false;
           }
           
            if (x.charAt(0)=="0")
           {
                document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
                return false;
           }
           return true;
        }






  function ValidateComment(){    
               //comment VALIDATION
                var x= document.myform3.cmnt.value;             
               
                 if(x.length>9)
                {
                    document.getElementById("CommentError3").innerHTML="*comment should be less than 9 characters";
                    //document.signup.username.select();
                    return false;
                }
                 
                    return true;
              }





function ValidateForm3(){

           //Phno validation

           var emailID = document.myform3.emailphno.value;

           if(isNaN(emailID))
           {
             var letters= /^[a-zA-Z0-9_ ]*$/;
                if( document.myform3.emailphno.value == "" )
                 {
                    document.getElementById("EmailPhnoError3").innerHTML= "*Please provide your Email!";
                    //document.signup.Email.focus() ;
                    return false;
                 }
                
                atpos = emailID.indexOf("@");
                dotpos = emailID.lastIndexOf(".");
         
                 if(atpos < 1 || ( dotpos - atpos < 2 )) 
                 {
                    document.getElementById("EmailPhnoError3").innerHTML="*Please enter correct email ID";
                    //document.signup.Email.focus() ;
                    return false;
                 }  
                
                else{
                    return true;
                }
           }
            

           else
           {
            if(emailID.indexOf(" ")!=-1||emailID=="")
           {
              document.getElementById("EmailPhnoError3").innerHTML="*Please enter email or phone no";
              return false; 
           }
           if (emailID.length>10||emailID.length<10)
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter 10 digits phone no";
                return false;
           }
           
           if (emailID.charAt(0)!="9"&&x.charAt(0)!="8"&&x.charAt(0)!="7")
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter valid phone no";
                return false;
           }
           return true;
           } 




      /*// phone validation
           var x = document.myform3.emailphno.value;

           if(isNaN(x)||x.indexOf(" ")!=-1||x=="")
           {
              document.getElementById("EmailPhnoError3").innerHTML="*Please enter email or phone no";
              return false; 
           }
           if (x.length>10)
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter 10 digits phone no";
                return false;
           }
           
           if (x.charAt(0)!="9"&&"8"&&"7")
           {
                document.getElementById("EmailPhnoError3").innerHTML="*Please enter valid phone no";
                return false;
           }
           else{return true;}*/



          //Amount validation
           var x = document.myform3.amt.value;
           
           if(isNaN(x)||x.indexOf(" ")!=-1||x=="")
           {
              document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
              return false; 
           }
           if (x.length>5)
           {
                document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
                return false;
           }
           
            if (x.charAt(0)=="0")
           {
                document.getElementById("AmountError3").innerHTML="*Please enter valid amount";
                return false;
           }
           else{return true;}


           //comment validation
           var x= document.myform3.cmnt.value;            
           if(x.length>9)
          {
            document.getElementById("CommentError3").innerHTML="*comment should be less than 9 characters";
           //document.signup.username.select();
            return false;
          }
          else{return true;}

}

</script>
</body>
</html>