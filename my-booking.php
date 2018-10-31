<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login']) == 0)
{
    header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>EventForYou - HTML5 Template</title>
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

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
          href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
          href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
    <!-- Google-Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php'); ?>
<!-- /Switcher -->

<!--Header-->
<?php include('includes/header.php'); ?>
<!--Page Header-->
<!-- /Header -->

<!--Page Header-->
<section class="page-header profile_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>My Booking</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>My Booking</li>
            </ul>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<?php
$useremail = $_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0)
{
foreach ($results

         as $result)
{ ?>
<section class="user_profile inner_pages">
    <div class="container">
        <div class="user_profile_info gray-bg padding_4x4_40">
            <div class="upload_user_logo"><img src="<?php echo $result->PerformerPhoto;?>" alt="image">
            </div>

            <div class="dealer_info">
                <h5><?php echo htmlentities($result->FullName); ?></h5>
                <p><?php echo htmlentities($result->Address); ?><br>
                    <?php echo htmlentities($result->City); ?>&nbsp;<?php echo htmlentities($result->Country);
                    }
                    } ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <?php include('includes/sidebar.php'); ?>
                <h5 class="uppercase underline">My Booikngs </h5>
                <div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
                    <?php
                    $userid = $result->id;
                    $status = 1;
                    $sql = "SELECT * from tblbooking where PerformerId=:pid AND Status=:status";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':pid', $userid, PDO::PARAM_STR);
                    $query->bindParam(':status', $status, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        ?>
                        <h5>Upcoming Work List</h5>
                        <table style="width: 100%">
                            <tr bgcolor="#adff2f">
                                <td>Booking Id</td>
                                <td>Client Name</td>
                                <td>Client Contactno</td>
                                <td>Client Address</td>
                                <td>Client city</td>
                                <td>Performance Date</td>
                                <td>Date Quantity</td>
                            </tr>
                            <?php
                            foreach ($results as $result) {
                                $performancedate = $result->PerformanceDate;
                                $performdatearr = explode(', ', $performancedate);
                                $fromcalender = $performdatearr[0];
                                $tocalender = $performdatearr[1];
                                $curdate = date('d-m-Y');
                                if (strtotime($curdate) <= strtotime($tocalender)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result->BookingId; ?></td>
                                        <td><?php echo $result->ClientName; ?></td>
                                        <td><?php echo $result->ClientContactNumber; ?></td>
                                        <td><?php echo $result->ClientAddress; ?></td>
                                        <td><?php echo $result->ClientCity; ?></td>
                                        <td><?php echo $result->PerformanceDate; ?></td>
                                        <td><?php echo $result->DateQuantity; ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </table>
                        <h5>Work History</h5>
                        <table style="width: 100%">
                            <tr bgcolor="red"style="color: white;">
                                <td >Booking Id</td>
                                <td>Client Name</td>
                                <td>Client Contactno</td>
                                <td>Client Address</td>
                                <td>Client city</td>
                                <td>Performance Date</td>
                                <td>Date Quantity</td>
                            </tr>
                            <?php
                            foreach ($results as $result) {
                                $performancedate = $result->PerformanceDate;
                                $performdatearr = explode(', ', $performancedate);
                                $fromcalender = $performdatearr[0];
                                $tocalender = $performdatearr[1];
                                $curdate = date('d-m-Y');
                                if (strtotime($curdate) > strtotime($tocalender)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $result->BookingId; ?></td>
                                        <td><?php echo $result->ClientName; ?></td>
                                        <td><?php echo $result->ClientContactNumber; ?></td>
                                        <td><?php echo $result->ClientAddress; ?></td>
                                        <td><?php echo $result->ClientCity; ?></td>
                                        <td><?php echo $result->PerformanceDate; ?></td>
                                        <td><?php echo $result->DateQuantity; ?></td>
                                    </tr>

                                    <?php
                                }
                            } ?>
                        </table>
                        <?php
                    } else {
                    ?>
                    <ul class="vehicle_listing">
                        <li>
                            <div style="color: red;">No work history and no upcoming work in your booking
                                list.
                            </div>
                        </li>
                        <?php
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!--/my-vehicles-->
<?php include('includes/footer.php'); ?>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/interface.js"></script>
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS-->
<script src="assets/js/bootstrap-slider.min.js"></script>
<!--Slider-JS-->
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>