<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_GET['del']))
{
    $id = $_GET['del'];
    $sql = "delete from tblcart  WHERE CartId=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Event Management Port | Performer Details</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <!--Custome Style -->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!--OWL Carousel slider-->
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <!--slick-slider -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!--bootstrap-slider -->
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <!--FontAwesome Font Style -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <!-- SWITCHER -->
    <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
          data-default-color="true"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all"/>
    <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all"/>
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php'); ?>
<!-- /Switcher -->

<!--Header-->
<?php include('includes/header.php'); ?>
<!-- /Header -->



<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <!--/Similar-Cars-->


        <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
            <table class="timetable_sub">
                <thead>
                <tr>
                    <th>Remove</th>
                    <th>Performer Photo</th>
                    <th>Performer Name</th>
                    <th>Perform Date</th>
                    <th>How many Dates</th>
                    <th>Performance Cost</th>
                </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM tblcart WHERE SessionId=:sessionid";
                $query= $dbh -> prepare($sql);
                $query-> bindParam(':sessionid', $sessionid, PDO::PARAM_STR);
                $query-> execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                if($query->rowCount() > 0)
                {
                    $sum =0;
                    $i = 0;
                    foreach ($results as $result)
                    {
                        ?>
                        <tr class="rem1">
                            <td class="invert-closeb">
                                <div class="rem">
                                    <a href="checkout.php?del=<?php echo $result->CartId; ?>"
                                       onclick="return confirm('Are you want to delete this');"class="close1">X</a>
                                </div>
                            </td>
                            <td class="invert-image" align="center"><img width="120px"
                                                                         src="<?php echo $result->PerformerPhoto; ?>"
                                                                         alt=" "
                                                                         class="img-responsive"/></td>

                            <td class="invert"><?php echo $result->PerformerName;?></td>
                            <td class="invert"><?php echo $result->PerformanceDate;?></td>
                            <td class="invert"><?php

                                $datequantity = $result->DateQuantity;
                                echo $datequantity;?></td>
                            <td class="invert"><?php
                                $cost = $result->PerformanceCost;
                                echo $cost;?></td>
                        </tr>
                    <?php
                        $sum = $sum + $cost;
                        $performer = $result->PerformerId;
                        if ($performer){
                            $i++;
                        }
                        $_SESSION['sum'] = $sum;
                        $_SESSION['performer'] = $i;
                    }
                }
                ?>

            </table>
        </div>
        <div class="checkout-left">
            <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                <a href="performer-list.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To
                    Shopping</a>
            </div>
            <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                <a href="booking-confirm.php">Confirm Booking     <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>
            </div>
            <div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
                <h4>Shopping basket</h4>
                <ul>
                    <li>fhte</li>
                    <li>dsgv</li>
                    <li>sdgvs</li>
                </ul>
            </div>
            <div class="clearfix"></div>


    </div>
</section>
<!--/Listing-detail-->

<!--Footer -->
<?php include('includes/footer.php'); ?>
<!-- /Footer-->

<!--Back to top-->
<div id="back-top" class="back-top"><a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a></div>
<!--/Back to top-->

<!--Login-Form -->
<?php include('includes/login.php'); ?>
<!--/Login-Form -->

<!--Register-Form -->
<?php include('includes/registration.php'); ?>

<!--/Register-Form -->

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php'); ?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>