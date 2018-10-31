<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Online Event Portal</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
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

<!-- Banners -->
<section id="banner" class="banner-section" style="height: 470px;">
    <div class="container">
        <div class="div_zindex">
            <div class="row">
                <div class="col-md-5 col-md-push-7">
                    <div class="banner_content">
                        <h1>Find the right Performer for your Event.</h1>
                        <p>We have more than a thousand Performer for you to choose. </p>
                        <a href="#" class="btn">Read More <span class="angle_arrow"><i class="fa fa-angle-right"
                                                                                       aria-hidden="true"></i></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Banners -->


<!-- Resent Cat-->
<section class="section-padding gray-bg">
    <div class="container">
        <div class="section-header text-center">
            <h2>Find the Best <span>PerformerForYou</span></h2>
            <p>Welcome to our website, Here you can find lots of entertainer for your event. Here is
                Photographer,Musician,Magician,Actor,Comedian etc. Find your Performer</p>
        </div>
        <div class="row">

            <!-- Nav tabs -->
            <div class="recent-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Best
                            Performer</a></li>
                </ul>
            </div>
            <!-- Recently Listed New Cars -->
            <div class="similar_cars">
                <div class="row">
                    <?php
                    $categoryid = $_SESSION['categoryid'];
                    $sql = "SELECT tblusers.FullName,tblcategories.CategoryName,tblusers.PerformanceCost,tblusers.City,tblusers.id,tblusers.Address,tblusers.PerformerPhoto from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="col-md-3 grid_listing">
                                <div class="product-listing-m gray-bg">
                                    <div class="product-listing-img"><a
                                                href="performer-details.php?id=<?php echo htmlentities($result->id); ?>"><img
                                                    src="<?php echo htmlentities($result->PerformerPhoto); ?>"
                                                    class="img-responsive" alt="image"/> </a>
                                    </div>
                                    <div class="product-listing-content">
                                        <h5>
                                            <a href="performer-details.php?id=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?>
                                                , <?php echo htmlentities($result->FullName); ?></a></h5>
                                        <p class="list-price">BDT<?php echo htmlentities($result->PerformanceCost); ?></p>

                                        <ul class="features_list">

                                            <li><i class="fa fa-user" aria-hidden="true"></i>
                                                <?php
                                                $id = $result->id;
                                                $status = 1;
                                                $sql = "SELECT * from tblbooking where PerformerId=:pid AND Status=:status";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':pid', $id, PDO::PARAM_STR);
                                                $query->bindParam(':status', $status, PDO::PARAM_STR);
                                                $query->execute();
                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 0;
                                                if ($query->rowCount() > 0) {
                                                    foreach ($results as $resul) {
                                                        $cnt = $cnt + 1;
                                                    }

                                                }
                                                echo $cnt; ?>
                                                performed
                                            </li>
                                            <li><i class="fa fa-calendar"
                                                   aria-hidden="true"></i><?php echo htmlentities($id); ?> reg. no
                                            </li>
                                            <!--  <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->City); ?></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>

                </div>
            </div>
            </div>
        </div>
</section>
<!-- /Resent Cat -->

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
<!--/Forgot-password-Form -->

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

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
</html>