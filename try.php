<?php
include_once('includes/dbconnection.php');
  $oid=345104162;
  $querym=mysqli_query($con,"select * from tblorders where OrderNumber like '$oid' order by id asc");
  $num=mysqli_num_rows($querym);
  echo $num;
  $m=mysqli_fetch_array($querym);
  echo $m;
  while ($row=mysqli_fetch_array($querym)) {

  echo $row['FoodId'];


  $foodid=$row['FoodId'];
  echo $foodid;
  $query2="select ItemQty from tblfood where ID='$foodid'";
  $x=mysqli_query($con,$query2);
  $y=mysqli_fetch_array($x);
  $z= $y['ItemQty'];
  $z=$z-1;
  $query3="update `tblfood` set `ItemQty` = '$z' where `tblfood`.`ID` = '$foodid'";
  mysqli_query($con,$query3);


} ?>
