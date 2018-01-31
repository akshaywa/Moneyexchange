
<?php


if(isset($_POST["signup_submit"])){
 // if(!empty($_POST['uname2'])  && !empty($_POST['email'])&& !empty($_POST['psw2'])){
     $name= $_POST['uname2'];
     $email= $_POST['email'];
     $password= $_POST['psw2'];
     $phnoo=$_POST['phno'];
     
     date_default_timezone_set('Asia/Kolkata');
     $timezone = date('Y-m-d H:i:s');

     $balance=0;
     $conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');
     $query=mysqli_query($conn,"SELECT * FROM signup WHERE Name='".$name."' AND Password='".$password."'");
     $numrows=mysqli_num_rows($query);
     if($numrows==0)
     {      
      
     //Insert into query
      
      $query40="SELECT vcd FROM verify ORDER BY vid ASC LIMIT 1;";
      $result40=mysqli_query($conn,$query40);
      $row40= mysqli_fetch_assoc($result40);
      $vertt=$row40['vcd'];


      $sql41="INSERT INTO signuping(Name,Email,Password,phoneno,vercode)VALUES('$name','$email','$password','$phnoo','$vertt')";
      $result41=mysqli_query($conn,$sql41);

      //verify smtp
      $to      = $email;
      $subject = ' MoneyEXchange Account Creation ';
      $message = ' This is message for verification';
      $message = $vertt;
      $message .=' .Click MoneyEXchange.com for more details. ';
      $headers = 'From: walunja11@gmail.com' . "\r\n" .
           'Reply-To: walunja11@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

      if(mail($to, $subject, $message, $headers)) {
      echo "Email sent successfully!"; 
      } 
      else {
      die("Failure: Email is invalid,no such account present!");
      }

      header('Location: '."verify.php"); 

     }


     
     else
     {
      echo"That username already exist!Please try again";
     } 

    // }

  }



     /*      
if(isset($_POST["signup_submit"])){
 // if(!empty($_POST['uname2'])  && !empty($_POST['email'])&& !empty($_POST['psw2'])){
     $name= $_POST['uname2'];
     $email= $_POST['email'];
     $password= $_POST['psw2'];
     $phnoo=$_POST['phno'];
     $verii=$_POST['vercc'];
     
     date_default_timezone_set('Asia/Kolkata');
     $timezone = date('Y-m-d H:i:s');

     $balance=0;
     $conn= mysqli_connect('localhost','root','','moneyexchange');
     $query=mysqli_query($conn,"SELECT * FROM signup WHERE Name='".$name."'");
     $numrows=mysqli_num_rows($query);
     if($numrows==0)
     {      
     $sql37="SELECT COUNT(*) FROM signuping";
     $result37=mysqli_query($conn,$sql37);
     $row37= mysqli_fetch_assoc($result37);
     $ticktic= implode(" ",$row37);
     $tict=$ticktic-1;
     

     if($ticktic>2)
     {
      $sql38="DELETE FROM signuping where LIMIT '".$tict."' ORDER BY usid ASC";
      $result38=mysqli_query($conn,$sql38);    
     }


             
      $query11="SELECT * FROM verify where LIMIT 1";
      $result11=mysqli_query($conn,$query11);
      $row11= mysqli_fetch_assoc($result11);
      $vertt=$row11['vcd']; 
      
      $sql33="INSERT INTO signuping(Name,Email,Password,phoneno,vercode)VALUES('$name','$email','$password','$phnoo','$verii')";
      $result33=mysqli_query($conn,$sql33);  



      if (empty($verii)){  

         //verify smtp
      $to      = $email;
      $subject = ' MoneyEXchange Account Creation ';
      $message = ' This is message for verification';
      $message = $vertt;
      $message .=' .Click MoneyEXchange.com for more details. ';
      $headers = 'From: walunja11@gmail.com' . "\r\n" .
           'Reply-To: walunja11@gmail.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

      if(mail($to, $subject, $message, $headers)) {
      echo "Email sent successfully!";
      header('Location: '."login.php"); 
      } 
      else {
      die("Failure: Email is invalid,no such acoount present!");
      }

      }
      else  
      {       
      if($verii==$vertt)
      {
      $sql34="DELETE FROM verify where LIMIT 1 ORDER BY vid ASC";
      $result34=mysqli_query($conn,$sql34);

      $sql35="DELETE FROM signuping where  LIMIT 1 ORDER BY usid ASC";
      $result35=mysqli_query($conn,$sql35);       

      //Insert into query
      $sql="INSERT INTO signup(Name,Email,Password,signupon,phoneno,Balance)VALUES('$name','$email','$password','$timezone','$phnoo','$balance')";
      $result=mysqli_query($conn,$sql);  
      }
       
      else
      {
        $sql36="DELETE FROM signuping where LIMIT 1 ORDER BY usid ASC";
        $result36=mysqli_query($conn,$sql36);       
      } 
     
      //result message
      if($result){ 
         session_start();
         $_SESSION['sess_name']=$name;
         $_SESSION['sess_pwdd']=$password;
        
         header('Location: '."Dashboard.php"); 
      }
      else
      {
        echo"failure code not matches";
      }
     }
   }
     else
     {
      echo"That username already exist!Please try again";
     } 

    // }

  }
*/
  else if(isset($_POST["login_submit"])){
        if(!empty($_POST['uname1']) && !empty($_POST['psw1'])){
          $name= $_POST['uname1'];
          $password= $_POST['psw1'];
      
          $conn= mysqli_connect('localhost','root','narayangaonn1','moneyexchange');
          $query="SELECT * FROM signup WHERE Name='".$name."' AND Password='".$password."'";
          $result=mysqli_query($conn,$query);
          $numrows=mysqli_num_rows($result);
          if($numrows!=0)
          {         
              session_start();
              $_SESSION['sess_name']=$name;
              $_SESSION['sess_pwdd']=$password;
              
              header('Location: '."Dashboard.php"); 
          }
          else
          {
            echo"Invalid Username or Password";
          }
     } 
  }  



/*
else if(isset($_POST["login_submit"])){
    $name= $_POST["uname1"];
    $password= $_POST["psw1"];

    // Create connection
    $con=mysqli_connect("localhost","root","","moneyexchange");
    //Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);        }

    //$username = mysqli_real_escape_string($con, $_POST['uname1']); 
    //$password = mysqli_real_escape_string($con, $_POST['psw1']);   

    $query="SELECT * FROM signup WHERE Name='$name' AND Password='$password'";
    $result = mysqli_query($con,$query);

    //print_r($result);exit;    
    $res = mysqli_fetch_row($result);
    //print_r($res);exit;
    if(empty($res))
    {
      echo "Username or password does not exist";
    } 
    else{
      echo "Login Successful";
      header('Location: '."Dashboard.html?$res[0]");
      //redirect();                 Redirect code will go here
    }


    /*if (mysqli_num_rows($result)) {
        echo "SELECT * FROM moneyexchange WHERE Name='$newUsername' AND Password='$newPassword'";
    } 
    else
    {      
        echo "login unsuccessfull, please try again";     
    }*/
   // $con->close();
  //}

?>







<!DOCTYPE html>
<html>
<head>
<title>Get Started</title>

    <link rel="stylesheet" type="text/css" href="log.css">
    <link rel="stylesheet" href="css/stylee.css" type="text/css">


<!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="css/zerogrid.css">
  <link rel="stylesheet" href="css/style.css">
   
  <!-- Custom Fonts --> 
  <link rel="stylesheet" href="css/menu.css">  
</head>


<div class="wrap-body">

  <!--////////////////////////////////////Header-->
  <header class="zerogrid">
      <div class="header">
      <h2>MoneyEXchange</h2>        
    </div>
      <div id='cssmenu'>
      <ul>
         <li><a href='index.html'><span>Home</span></a></li>
         <li><a href='about.html'><span>About</span></a></li>
         <li><a href='contact.html'><span>contact</span></a></li>
         <li class="active"><a  href='login.php'><span>login/signup</span></a></li>
      </ul>
    </div>
    </header>
</div>
<div class="logo"><img src="images/ewallet1.jpg" alt=""/></div>


<body onload="document.getElementById('id01').style.display='block';document.getElementById('id02').style.display='block'">

<div class="mib1">
<div class="caught1">

  <div id="id01">
  
    <h2 class="mm2">Login Form</h2>
      <form class="modal-content1 animate" name="myform1" method="post">

      <div class="container">
        <label><b>Username</b></label>
        <div>
        <input type="text" placeholder="Enter Username"  name="uname1" onblur="NameValidation()" required>        
        </div>
        <div id="NameError1">
        </div>
        </div>
        <div class="container">
        <label><b>Password</b></label>
        <div>
        <input id="pass1" type="password" placeholder="Enter Password" name="psw1" onblur="PasswordValidation()" required>
        </div>
        <div id="PasswordError1">
        </div>
      </div>

      <div class="container">
        <button type="submit" name="login_submit">Login</button>
        <input type="checkbox" checked="checked"> Remember me
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button class="cancelbtn">Cancel</button>
        <span class="pswd">Forgot <a href="#">password?</a></span>
      </div>

      </form>

  </div>
</div>
</div>

<div class="mib2">
<div class="caught2">
  <div id="id02">

    <h2 class="mm1">Signup Form</h2>
    <form class="modal-content2 animate" name="myform2" autocomplete="off" method="post">
    
      <div class="container">
        <label><b>Username</b></label>
        <div>
        <input type="text" placeholder="Enter Username"  name="uname2" onblur="ValidateName()" required>
        </div>
        <div id="NameError2">
        </div>
      </div>

      <div class="container"> 
        <label><b>Email Address</b></label>
        <div>
        <input type="text" placeholder="Enter Email" name="email" onblur="ValidateEmail()" required>
        </div>
        <div id="EmailError2">
        </div>
      </div>

       <div class="container">
        <label><b>Phone No</b></label>
        <div>
        <input type="text" placeholder="Enter Phone No"  name="phno" onblur="ValidatePhNo()" required>
        </div>
        <div id="PhNoError2">
        </div>
      </div>

      <div class="container">
        <label><b>Password</b></label>
        <div>
        <input id="pass2" type="password" placeholder="Enter Password"  name="psw2" onblur="ValidatePassword()" required>
        </div>
        <div id="PasswordError2">
        </div>
      </div>

      <div class="container">  
        <label><b>Recheck Password</b></label>
        <div>
        <input id="pass3" type="password" placeholder="Re-enter Password" name="pswr" onblur="ValidateRecheck()" required>
        </div> 
        <div id="ConfirmError2">
        </div> 
      </div>

      <div class="container">  
        <button type="submit" name="signup_submit">Signup</button>
      </div>
      </form>      
  </div>
</div>
</div>
 
 <script type="text/javascript">
  function NameValidation(){    
               //NAME VALIDATION
                var x= document.myform1.uname1.value;
             
                //var ck_password =  /^[0-9]/;
                if(x==null||x==""||x.indexOf(" ")!=-1){
                 document.getElementById("NameError1").innerHTML="*Name must be filled out";
                 //document.signup.username.focus() ;
                    return false;
                }
                else if(x.length>25)
                {
                    document.getElementById("NameError1").innerHTML="*Name should be less than 25 characters";
                    //document.signup.username.select();
                    return false;
                }
                  else if(x.length<4)
                {
                    document.getElementById("NameError1").innerHTML="*Name should be greater than 4 characters";
                    //document.signup.username.select();
                    return false;
                }
                    return true;
              }







  function ValidateName(){    
               //NAME VALIDATION
                var y= document.myform2.uname2.value;
             
                //var ck_password =  /^[0-9]/;
                if(y==null||y==""||y.indexOf(" ")!=-1){
                 document.getElementById("NameError2").innerHTML="*Name must be filled out";
                 //document.signup.username.focus() ;
                    return false;
                }
                else if(y.length>25)
                {
                    document.getElementById("NameError2").innerHTML="*Name should be less than 25 characters";
                    //document.signup.username.select();
                    return false;
                }
                  else if(y.length<4)
                {
                    document.getElementById("NameError2").innerHTML="*Name should be greater than 4 characters";
                    //document.signup.username.select();
                    return false;
                }
                    return true;
              }             







function PasswordValidation() { 

    //Validate Password 
     var x= document.getElementById("pass1").value;
                //var letters= /^[A-Za-z\d$@$!%*?&]{8,}/;  
                if(x==""||x.indexOf(" ")!=-1)
                    {
                        document.getElementById("PasswordError1").innerHTML="*Enter Password";
                        //document.signup.password.focus() ;
                        return false;
                    }
                
                if ((x.length < 8))
                {
                        document.getElementById("PasswordError1").innerHTML="*Your Password must be greater than 8 Characters";
                        //document.signup.password.focus();
                        return false;
                }
               
                re = /[0-9]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError1").innerHTML="*Password must contain at least one number (0-9)!";
                        //document.signup.password.focus();
                        return false;
                }
      
                re = /[a-z]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError1").innerHTML="*Password must contain at least one lowercase letter (a-z)!";
                        //document.signup.password.focus();
                        return false;
                }
      

                re = /[A-Z]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError1").innerHTML="*Password must contain at least one uppercase letter (A-Z)!";
                        //document.signup.password.focus();
                        return false;
                }
                else
                {return true;}
 } 





 function ValidatePassword() { 

    //Validate Password 
     var y= document.getElementById("pass2").value;
                //var letters= /^[A-Za-z\d$@$!%*?&]{8,}/;  
                if(y==""||y.indexOf(" ")!=-1)
                    {
                        document.getElementById("PasswordError2").innerHTML="*Enter Password";
                        //document.signup.password.focus() ;
                        return false;
                    }
                
                if ((y.length < 8))
                {
                        document.getElementById("PasswordError2").innerHTML="*Your Password must be greater than 8 Characters";
                        //document.signup.password.focus();
                        return false;
                }
               
                re = /[0-9]/;
                if(!re.test(y)) {
                        document.getElementById("PasswordError2").innerHTML="*Password must contain at least one number (0-9)!";
                        //document.signup.password.focus();
                        return false;
                }
      
                re = /[a-z]/;
                if(!re.test(y)) {
                        document.getElementById("PasswordError2").innerHTML="*Password must contain at least one lowercase letter (a-z)!";
                        //document.signup.password.focus();
                        return false;
                }
      

                re = /[A-Z]/;
                if(!re.test(y)) {
                        document.getElementById("PasswordError2").innerHTML="*Password must contain at least one uppercase letter (A-Z)!";
                        //document.signup.password.focus();
                        return false;
                }
                else
                {return true;}
 } 







function ValidateEmail(){  
      //EMAIL VALIDATION
     var emailID = document.myform2.email.value;
                var letters= /^[a-zA-Z0-9_ ]*$/;
                if( document.myform2.email.value == "" )
                 {
                    document.getElementById("EmailError2").innerHTML= "*Please provide your Email!";
                    //document.signup.Email.focus() ;
                    return false;
                 }
                
                atpos = emailID.indexOf("@");
                dotpos = emailID.lastIndexOf(".");
         
                 if(atpos < 1 || ( dotpos - atpos < 2 )) 
                 {
                    document.getElementById("EmailError2").innerHTML="*Please enter correct email ID";
                    //document.signup.Email.focus() ;
                    return false;
                 }  
                
                else{
                    return true;
                }
    }


function ValidatePhNo()
        {
           // phone validation
           var x = document.myform2.phno.value;

           if(isNaN(x)||x.indexOf(" ")!=-1||x=="")
           {
              document.getElementById("PhNoError2").innerHTML="*Please enter phone no";
              return false; 
           }
           if (x.length>10||x.length<10)
           {
                document.getElementById("PhNoError2").innerHTML="*Please enter 10 digits phone no";
                return false;
           }
           
           if (x.charAt(0)!="9"&&x.charAt(0)!="8"&&x.charAt(0)!="7")
           {
                document.getElementById("PhNoError2").innerHTML="*Please enter valid phone no";
                return false;
           }
           return true;
        }






 function ValidateRecheck(){

    //check password
    var x= document.getElementById("pass2").value;

    var y= document.myform2.pswr.value;
     
    if(x!=y)
    {
      document.getElementById("ConfirmError2").innerHTML="*Password does not matches";
      return false;
    }
    return true;     
}



 function FormValidation(){

    
               //NAME VALIDATION
                var x= document.myform1.uname1.value;
             
                //var ck_password =  /^[0-9]/;
                if(x==null||x==""||x.indexOf(" ")!=-1){
                 document.getElementById("NameError1").innerHTML="*Name must be filled out";
                 //document.signup.username.focus() ;
                    return false;
                }
                else if(x.length>25)
                {
                    document.getElementById("NameError1").innerHTML="*Name should be less than 25 characters";
                    //document.signup.username.select();
                    return false;
                }
                  else if(x.length<4)
                {
                    document.getElementById("NameError1").innerHTML="*Name should be greater than 4 characters";
                    //document.signup.username.select();
                    return false;
                }
                else 
                {  return true;}
              







    //Password Validation
     var x= document.getElementById("pass1").value;
                //var letters= /^[A-Za-z\d$@$!%*?&]{8,}/;  
                if(x==""||x.indexOf(" ")!=-1)
                    {
                        document.getElementById("PasswordError1").innerHTML="*Enter Password";
                        //document.signup.password.focus() ;
                        return false;
                    }
                
                if ((x.length < 8))
                {
                        document.getElementById("PasswordError1").innerHTML="*Your Password must be greater than 8 Characters";
                        //document.signup.password.focus();
                        return false;
                }
               
                re = /[0-9]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError1").innerHTML="*Password must contain at least one number (0-9)!";
                        //document.signup.password.focus();
                        return false;
                }
      
                re = /[a-z]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError1").innerHTML="*Password must contain at least one lowercase letter (a-z)!";
                        //document.signup.password.focus();
                        return false;
                }
      

                re = /[A-Z]/;
                if(!re.test(x)) {
                        document.getElementById("PasswordError").innerHTML="*Password must contain at least one uppercase letter (A-Z)!";
                        //document.signup.password.focus();
                        return false;
                }
                else
                {return true;}  
}


</script>

<center><a href="busiacc.html" id="ca1">Create Business Account</a></center>
</body>
</html>




























































              

