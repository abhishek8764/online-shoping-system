
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
    <link href="css/style.css" rel="stylesheet"> 
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
</head>

<body>
    <div class="site-wrapper animsition" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
       <?php include_once('includes/header.php');?>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
          
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image" data-image-src="images/online.jpg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3">
                           
                        </p>
                  
                    </div>
                </div>
            </div>
            <!-- //results show -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                            <div class="sidebar clearfix m-b-20">
                                <div class="main-block">
                                    <div class="sidebar-title white-txt">
                                        <h6>Food Category</h6> <i class="fa fa-cutlery pull-right"></i> </div>
                                   
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
                                <div class="widget-delivery">
                                    
                                </div>
                            </div>
                            
                            <!-- end:Pricing widget -->
                            
                            <!-- end:Widget -->
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                            <div class="bg-gray restaurant-entry">

<?php
$orderno=$_POST['ordernumber'];
      $query=mysqli_query($con,"select * from  tblorderaddresses  where Ordernumber='$orderno'");
      $count=1;
      $result=mysqli_num_rows($query);
      if($result=='0'){ ?>
<div class="row">
<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
No Record found against this order number.
</div>
</div>

       <?php }else {
              while($row=mysqli_fetch_array($query))
              { ?>                  
                                <div class="row">
                                    <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                                        <div class="entry-logo">
                                <a class="img-fluid" href="order-details.php?orderid=<?php echo $row['Ordernumber'];?>"><img src="images/order.jpg" width="100" height="100" alt="Order "></a>
                                        </div>
                                        <!-- end:Logo -->
                                        <div class="entry-dscr">
         <h5><a href="order-details.php?orderid=<?php echo $row['Ordernumber'];?>">Order # <?php echo $row['Ordernumber'];?></a></h5> 
         <p><b>Order Date :</b> <?php echo $row['OrderTime']?></p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item"><i class="fa fa-check"></i> 
                                                    <?php $status=$row['OrderFinalStatus'];
if($status==''){
 echo "Waiting for Restaurant confirmation";   
} else{
echo $status;
}

                                                    ?></li>
                                                <li class="list-inline-item"><i class="fa fa-motorcycle"></i> 
<?php    

$link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
?>
 <a href="javascript:void(0);" onClick="popUpWindow('trackorder.php?oid=<?php echo htmlentities($row['Ordernumber']);?>');" title="Track order">Track Order</a></li>
                                            </ul>
                                        </div>
                                        <!-- end:Entry description -->
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                        <div class="right-content bg-white">
                                            <div class="right-review">
                                             
                                     <a href="track-order-details.php?orderid=<?php echo $row['Ordernumber'];?>" class="btn theme-btn-dash">View Details</a> </div>
                                        </div>
                                        <!-- end:right info -->
                                    </div>
                                </div>
                                <hr />
                            <?php }} ?>
                                <!--end:row -->
                            </div>
                        
                           
                            
                      
                                <!--end:row -->
                            </div>
                            <!-- end:Restaurant entry -->
                            
                            <!-- end:Restaurant entry -->
                        </div>
                    </div>
                </div>
            </section>
           
            <!-- start: FOOTER -->
            <?php include('includes/footer.php');?>
            <!-- end:Footer -->
        </div>
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
