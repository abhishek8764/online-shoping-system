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

            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image" data-image-src="images/decouvrez-l-experience-food-d-airbnb.jpg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <p><span class="primary-color"><strong>Browse through our catalogue here</strong></span> </div>
            </p>

        </div>
    </div>
</div>
<!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
                            <div class="sidebar clearfix m-b-20">
                                 <form name="search" method="post" action="search-food.php">
                                <div class="main-block">
                                    <div class="sidebar-title white-txt">
                                        <h6>Search</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                                    <div class="input-group">
                                        <input type="text" class="form-control search-field" placeholder="Search for your requirements" name="searchdata" id="searchdata"> <span class="input-group-btn">
                                 <button class="btn btn-secondary search-btn" type="submit" name="search"><i class="fa fa-search"></i></button>
                                 </span> </div>
                                     </div>
                                     </form>



                                    <div class="main-block" style="margin-top: 10%">
                                    <div class="sidebar-title white-txt">
                                        <h6>Catgories</h6> <i class="fa fa-cutlery pull-right"></i> </div>
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

                            </div>

                            <!-- end:Pricing widget -->

                            <!-- end:Widget -->
                        </div>
                     <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                            <div class="row">
                                <!-- Each popular food item starts -->
                                                        <?php

  if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }

// Formula for pagination
$no_of_records_per_page = 9;
$offset = ($pageno-1) * $no_of_records_per_page;

// Getting total number of pages
        $total_pages_sql ="SELECT COUNT(*) FROM tblfood";
        $result = mysqli_query($con,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql = "SELECT * FROM tblfood LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($con,$sql);
        $cnt=1;
        while($row = mysqli_fetch_array($res_data)){




?>

                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 food-item">
                                    <div class="food-item-wrap">
                                        <div class="figure-wrap bg-image"> <img src="admin/itemimages/<?php echo $row['Image'];?>" width="200" height="120">



                                        </div>
                                        <div class="content">
                                            <h5><a href="food-detail.php?fid=<?php echo $row['ID'];?>"><?php echo $row['ItemName'];?></a></h5>
                                            <div class="product-name"><?php echo substr($row['ItemDes'],0,50);?></div>
                                            <div class="product-name" ><?php echo "available qty : ".$row['ItemQty']?></div>
                                            <div class="price-btn-block"> <span class="price">Rs. <?php echo $row['ItemPrice']?></span>

<?php if($_SESSION['fosuid']=="" ){?>
<a href="login.php" class="btn theme-btn-dash pull-right">Order Now</a>
<?php }
else if ($row['ItemQty']<=0) {?>
<a > Sold Out </a>

<?php
}
 else {?>
    <form method="post">
    <input type="hidden" name="foodid" value="<?php echo $row['ID'];?>">
<button type="submit" name="submit" class="btn theme-btn-dash pull-right">Order Now</button>
  </form>
<?php }?>
                                              </div>
                                        </div>

                                    </div>
                                </div>
                                    <?php } ?>

                                <!-- Each popular food item starts -->

                                <div class="col-xs-12" align="center">
                                    <nav aria-label="...">


<ul class="pagination" >
        <li class="page-link"><a href="?pageno=1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-link">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-link">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
        </li>
        <li class="page-link"><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>


                                    </nav>
                                </div>
                            </div>
                            <!-- end:right row -->
                        </div>
                    </div>
                </div>
            </section>

            <!-- start: FOOTER -->
            <?php include_once('includes/footer.php');?>
            <!-- end:Footer -->
<b style="margin-left:35%;">AN INITIATIVE BY SMVDU STUDENTS, FOR SMVDU STUDENTS</b>
        </div>
    </div>
    <!-- end:page wrapper -->
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
