<?php
session_start();
//error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['fosuid']==0)) {
  header('location:logout.php');
  } else{
//placing order

if(isset($_POST['Delete'])){

  $id=$_POST['id'];
  $foodid=$_POST['foodid'];
$query1="DELETE FROM `tblorders` WHERE `tblorders`.`ID` = $id ";
$result= mysqli_multi_query($con, $query1);
if($result){
  echo '<script>alert("Your item has been succesfully deleted form cart")</script>';
}


}

if(isset($_POST['placeorder'])){
//getting address
$fnaobno="Not available";
$street=$_POST['Roomno'];
$area=$_POST['Hostelname'];
$lndmark="SMVDU";
$city="Kakkrayal";
$userid=$_SESSION['fosuid'];
//genrating order number
$orderno= mt_rand(100000000, 999999999);
$query="update tblorders set OrderNumber='$orderno',IsOrderPlaced='1' where UserId='$userid' and IsOrderPlaced is null;";
$query.="insert into tblorderaddresses(UserId,Ordernumber,Flatnobuldngno,StreetName,Area,Landmark,City) values('$userid','$orderno','$fnaobno','$street','$area','$lndmark','$city');";



$result = mysqli_multi_query($con, $query);
if ($result) {

  include_once('includes/dbconnection.php');
    $oid=345104162;
    echo $oid;
    $querym=mysqli_query($con,"select * from tblorders where OrderNumber like '$oid' order by id asc");
    $num=mysqli_num_rows($querym);
    $m=mysqli_fetch_array($querym);
    echo $m;
    while ($rowm=mysqli_fetch_array($querym)) {

    echo $rowm['FoodId'];


    $foodid=$rowm['FoodId'];
    echo $foodid;
    $query2="select ItemQty from tblfood where ID='$foodid'";
    $x=mysqli_query($con,$query2);
    $y=mysqli_fetch_array($x);
    $z= $y['ItemQty'];
    $z=$z-1;
    $query3="update `tblfood` set `ItemQty` = '$z' where `tblfood`.`ID` = '$foodid'";
    mysqli_query($con,$query3);


  }
  echo '<script>alert("Your order placed successfully. Order number is "+"'.$orderno.'")</script>';



  echo "<script>window.location.href='my-order.php'</script>";


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
    <title>Food Ordering System</title>
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
          <?php include_once('includes/header.php');?>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <div class="top-links">

            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <section class="inner-page-hero bg-image" data-image-src="images/decouvrez-l-experience-food-d-airbnb.jpg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><img src="images/decouvrez-l-experience-food-d-airbnb.jpg" alt="Profile Image"></figure>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- end:Inner page hero -->
            <div class="breadcrumb">
                <div class="container">
                    <ul>
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li>Detail Cart</li>
                    </ul>
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                        <div class="sidebar clearfix m-b-20">
                            <div class="main-block">
                                <div class="sidebar-title white-txt">
                                    <h6>Food Categories</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                                    <?php

      $query=mysqli_query($con,"select * from  tblcategory");
              while($row=mysqli_fetch_array($query))
              {
              ?>

                               <ul>

                                            <li>
                                                <label class="custom-control custom-checkbox">
                                                    <span class="custom-control-description"><a href="viewfood-categorywise.php?catid=<?php echo $row['CategoryName'];?>"><?php echo $row['CategoryName'];?></a></span> </label>
                                            </li>


                                        </ul>
                                        <?php } ?>
                                <div class="clearfix"></div>
                            </div>
                            <!-- end:Sidebar nav -->

                        </div>
                        <!-- end:Left Sidebar -->

                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                        <div class="menu-widget m-b-30">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              Your ORDERS Delicious hot food! <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="1">
                                <div class="food-item white">

<?php
$userid= $_SESSION['fosuid'];
$query=mysqli_query($con,"select tblorders.ID,tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblorders.FoodId from tblorders join tblfood on tblfood.ID=tblorders.FoodId where tblorders.UserId='$userid' and tblorders.IsOrderPlaced is null");
$num=mysqli_num_rows($query);
if($num>0){
while ($row=mysqli_fetch_array($query)) {


?>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><img src="admin/itemimages/<?php echo $row['Image']?>" width="100" height="80" alt="<?php echo $row['ItemName']?>"></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
<h6><a href="food-detail.php?fid=<?php echo $_SESSION['fid']=$row['FoodId'];?>"><?php echo $row['ItemName']?> (<?php echo $row['ItemQty']?>) </a></h6>
                                                <p> <?php echo $row['ItemDes']?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>

                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> <span class="price pull-left">Rs. <?php echo $total=$row['ItemPrice']?></span></div>


                                    <form method='POST'>
                                      <input type="hidden" name="foodid" value="<?php echo $row['FoodId'];?>">
                                    <input type="hidden" name="id" value="<?php echo $row['ID'];?>">
                                    <input type="submit" name="Delete" id="Delete" value="Delete" class="btn theme-btn-dash pull-right">
                                    </form>
  </div>
                                    <!-- end:row -->

                                <?php
$grandtotal+=$total;
                            }

} else {

    echo "You cart is empty.";
}
                            ?>
                                </div>

                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->

                        <!--/row -->
                    </div>
                    <!-- end:Bar -->
                    <?php if($num>0){?>
                        <form method="post">
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Your Shopping Cart
                              </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">

                                        <div class="form-group row no-gutter">
                                            <div class="col-lg-12">
<!--<input type="text" name="flatbldgnumber"  placeholder="Flat or Building Number" class="form-control" required="true">-->
<input type="text" name="Roomno" placeholder="Room no" class="form-control" required="true">
<!--<input type="text" name="Hostel name"  placeholder="Hostel name" class="form-control" required="true">-->
<p></p>
<select name="Hostelname" class="form-control" required="true">
  <option value="nilgiri">nilgiri</option>
  <option value="old vaisholi">old vaisholi</option>
    <option value="new vaisholi">new vaisholi</option>
  <option value="trikuta">trikuta</option>
  <option value="kailash">kailash</option>
  <option value="vaishanvi ">vaishanvi</option>
  <option value="shivalik">shivalik</option>
</select>
<!--<input type="text" name="landmark" placeholder="Landmark if any" class="form-control"> -->
<!--<input type="text" name="city" placeholder="City" class="form-control">  -->

                                        </div>
                                    </div>
                                </div>
                                <hr />


                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo $grandtotal;?></strong></h3>
                                        <p>Free Shipping</p>
                                        <button  type="submit" name="placeorder" class="btn theme-btn btn-lg">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
            </form>
            <?php } ?>
                <!-- end:row -->
            </div>
            <!-- end:Container -->

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
<?php } ?>
