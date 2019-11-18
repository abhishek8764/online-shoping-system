<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
  

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
    <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
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
$oid=$_GET['orderid'];
$query=mysqli_query($con,"select tblfood.Image,tblfood.ItemName,tblfood.ItemDes,tblfood.ItemPrice,tblfood.ItemQty,tblorders.FoodId from tblorders join tblfood on tblfood.ID=tblorders.FoodId where  tblorders.IsOrderPlaced=1 and tblorders.OrderNumber='$oid'");
$num=mysqli_num_rows($query);
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
                                    </div>
                                    <!-- end:row -->

                                <?php 
$grandtotal+=$total;
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
                
   <?php
$query=mysqli_query($con,"select * from  tblorderaddresses  where Ordernumber='$oid'");
while($row=mysqli_fetch_array($query))
              { ?>
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                            <div class="widget widget-cart">
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Order # <?php echo $oid;?> Details
                              </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="order-row bg-white">
                                    <div class="widget-body">
                                 
                                        <div class="form-group row no-gutter">
                                            <div class="col-lg-12">
<p><b>Order Date :</b> <?php echo $row['OrderTime']?></p>
<hr />
<p><b>Flat No / Building No.:</b> <?php echo $row['Flatnobuldngno']?></p>
 <p><b>Street Name: </b> <?php echo $row['StreetName']?></p>
  <p><b>Area :</b> <?php echo $row['Area']?></p>
   <p><b>Landmark :</b> <?php echo $row['Landmark']?></p>
    <p><b>City :</b> <?php echo $row['City']?></p>

              
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            
                          
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
<p class="btn theme-btn btn-lg" ><?php    

$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
?>
 <a href="javascript:void(0);" onClick="popUpWindow('invoice.php?oid=<?php echo htmlentities($row['Ordernumber']);?>');" title="Order Invoice" style="color:#fff">Invoice</a></p>



                                        <p>TOTAL</p>
                                        <h3 class="value"><strong><?php echo $grandtotal;?></strong></h3>
                                        <p>Free Shipping</p>
                                                    <?php $status=$row['OrderFinalStatus'];
if($status==''){
 echo "Waiting for Restaurant confirmation";   
} else{
 ?>

        <p name="status" class="btn theme-btn btn-lg">
<a href="javascript:void(0);" onClick="popUpWindow('trackorder.php?oid=<?php echo htmlentities($row['Ordernumber']);?>');" title="Track order" style="color:#fff">

    <?php echo $status;?></a></p>
    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
         
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
