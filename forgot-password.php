<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit']))
  {
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];

        $query=mysqli_query($con,"select ID from tbluser where  Email='$email' and MobileNumber='$contactno'");
    $ret=mysqli_fetch_array($query);
    if($ret>0){
      $_SESSION['contactno']=$contactno;
      $_SESSION['email']=$email;

    //message system for forget Password
    function rand_string( $length ) {

    $chars = "ABCDEFGH123456789";
    return substr(str_shuffle($chars),0,$length);
    }
    $pass =(rand_String(6));


    $username = "your mail id ";
       $hash = "yout hash code of text local account ";

       // Config variables. Consult http://api.textlocal.in/docs for more info.
     /*	$test = "0";
      //	$otp=mt_rand(10000,30000);
       */

       // Data for text message. This is the text message data.
       $sender = "TXTLCL"; // This is who the message appears to be from.
       $numbers = $contactno; // A single number or a comma-seperated list of numbers
       $message = " your password have been succesfully changed and new details are  login id -> $contactno and password -> $pass  ";
       // 612 chars or less
       // A single number or a comma-seperated list of numbers
       $message = urlencode($message);
       $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
       $ch = curl_init('http://api.textlocal.in/send/?');
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $result = curl_exec($ch); // This is the result from the API
       curl_close($ch);
       $password=md5($pass);
       $query=mysqli_query($con,"update tbluser set Password='$password'  where  Email='$email' && MobileNumber='$contactno' ");
       session_destroy();
       $msg="your password has been succesfully and new password is sent you on your registerd mobile number ";


    }
    else{
      $msg="Invalid Details. Please try again.";
    }
  }
  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Food Ordering Managment System</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
         <!--header starts-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <?php include('includes/header.php');?>
            <!-- /.navbar -->

         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="index.php" class="active">Home</a></li>
                     <li><a href="forgot-password.php">Forgot Password</a></li>
                     <li>Forgot Password</li>
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- REGISTER -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                              <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
                              <form action="" name="submit" method="post">
                                 <div class="row">
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Registered Email</label>
                                       <input type="email" name="email" id="email" class="form-control"    required="true" >
                                    </div> </div>
                                    <div class="row">
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Mobile Number</label>
<input type="text" class="form-control" required="true" name="contactno" maxlength="10" pattern="[0-9]{10}">

                                    </div>

                                      </div>

                                 <div class="row">
                                    <div class="col-sm-4">
                                      <button type="submit" name="submit" class="btn theme-btn"><i class="ft-user"></i>Reset</button>

                                    </div>
                                    <div class="col-sm-4">
                          <a href="login.php" class="btn theme-btn"><i class="ft-user"></i>Sign In</a>

                        </div>
                                 </div>
                              </form>
                           </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /REGISTER -->
                     </div>
                     <!-- WHY? -->
                    <div class="col-md-4">
                        <h4>Registration is fast, easy, and free.</h4>
                        <hr>
                        <img src="images/login.jpg" alt="" class="img-fluid">
                        <p></p>


                        <!-- end:Panel -->
                        <h4 class="m-t-20">Contact Customer Support</h4>
                        <p> If you"re looking for more help or have a question to ask, please </p>
                        <p> <a href="contact.php" class="btn theme-btn m-t-15">contact us</a> </p>
                     </div>
                     <!-- /WHY? -->
                  </div>
               </div>
            </section>

            <!-- start: FOOTER -->
           <?php include('includes/footer.php');?>
            <!-- end:Footer -->
         </div>
         <!-- end:page wrapper -->
      </div>
      <!--/end:Site wrapper -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
