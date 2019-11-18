<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
$foodid=$_POST['foodid'];
$userid= $_SESSION['fosuid'];
$query=mysqli_query($con,"insert into tblorders(UserId,FoodId) values('$userid','$foodid') ");
if($query)
{
 echo "<script>alert('Food has been added in to the cart');</script>";
} else {
 echo "<script>alert('Something went wrong.');</script>";
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
                <div class="container">

                </div>
            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
                                     <?php
 $cid=$_GET['fid'];
$ret=mysqli_query($con,"select * from tblfood where ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
            <section class="inner-page-hero bg-image" data-image-src="images/decouvrez-l-experience-food-d-airbnb.jpg">
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">

                                    <figure><img src="admin/itemimages/<?php echo $row['Image'];?>" width="200" height="100"></figure>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text white-txt">
                                    <h6><a href="#"><?php echo $row['ItemName'];?></a></h6>
                                        <ul class="nav nav-inline">
                                            <li class="nav-item ratings">
                                            <a class="nav-link" href="#"> <span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    </span> </a>
                                        </li>
                                    </ul>
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
                        <li><a href="#" class="active">Home</a></li>
                        <li><a href="#">Food</a></li>
                        <li>Food Detail</li>
                    </ul>
                </div>
            </div>
            <div class="container m-t-30">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-9">
                        <div class="menu-widget m-b-30">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">
                              <?php echo $row['ItemName'];?> <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular" aria-expanded="true">
                              <i class="fa fa-angle-right pull-right"></i>
                              <i class="fa fa-angle-down pull-right"></i>
                              </a>
                           </h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="collapse in" id="1">

                                <!-- end:Food item -->

                                <!-- end:Food item -->

                                <!-- end:Food item -->
                                <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <div class="rest-logo pull-left">
                                                <a class="restaurant-logo pull-left" href="#"><img src="admin/itemimages/<?php echo $row['Image'];?>" width="200" height="100"></a>
                                            </div>
                                            <!-- end:Logo -->
                                            <div class="rest-descr">
                                                <h6><a href="#"><?php echo $row['ItemName'];?></a></h6>
                                                <p> <?php echo $row['ItemDes'];?></p>
                                            </div>
                                            <!-- end:Description -->
                                        </div>
                                        <!-- end:col -->
                                        <div class="col-xs-12 col-sm-12 col-lg-4 pull-right item-cart-info"> </div>
                                    </div>
                                    <!-- end:row -->
                                </div>
                                <!-- end:Food item -->
                            </div>
                            <!-- end:Collapse -->
                        </div>
                        <!-- end:Widget menu -->

                        <!-- end:Widget menu -->

                        <!--/row -->
                    </div>
                    <!-- end:Bar -->
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget widget-cart">



                                <!-- end:Order row -->

                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>TOTAL</p>
                                        <h3 class="value"><strong>Rs.<?php echo $row['ItemPrice'];?></strong></h3>
                                          <div class="product-name" ><?php echo "available qty : ".$row['ItemQty']?></div

                                        <p>Free Shipping</p>
                                        <?php if($_SESSION['fosuid']==""){?>
<a href="login.php" class="btn theme-btn-dash pull-right">Order Now</a>
<?php }
else if ($row['ItemQty']<=0) {?>
<a > Sold Out </a>

<?php
}else {?>
    <form method="post">
    <input type="hidden" name="foodid" value="<?php echo $row['ID'];?>">
                                        <button type="submit" name="submit" class="btn theme-btn btn-lg">Order Now</button>
  </form>
<?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }  ?>
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->

            <!-- start: FOOTER -->
            <?php include_once('includes/footer.php');?>
            <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Modal -->

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
