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
    <title>Event Management | Performer list</title>
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
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php'); ?>
<!-- /Switcher -->

<!--Header-->
<?php include('includes/header.php'); ?>
<!-- /Header -->

<!--Page Header-->
<section class="page-header listing_page">
    <div class="container">
        <div class="page-header_wrap">
            <div class="page-heading">
                <h1>Performer List</h1>
            </div>
            <ul class="coustom-breadcrumb">
                <li><a href="#">Home</a></li>
                <li>Performer List</li>
            </ul>
        </div>
    </div>
    <!-- Dark Overlay-->
    <div class="dark-overlay"></div>
</section>
<!-- /Page Header-->

<!--Listing-->
<section class="listing-page">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-md-push-3">
                <?php
                //Query for Listing count
                $categoryid = $_POST['categoryid'];
                $city = $_POST['city'];
                $published = 'Published';
                $budget = $_POST['budget'];
                $budgetadd = explode(',', $budget);
                $sql = "SELECT tblusers.*,tblcategories.CategoryName,tblcategories.CategoryId from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId where tblusers.PublicationStatus='Published' AND tblusers.PerformerCategoryId=:categoryid AND tblusers.City=:city";
                $query = $dbh->prepare($sql);
                $query->bindParam(':categoryid', $categoryid, PDO::PARAM_STR);
                $query->bindParam(':city', $city, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) {
                        $searchbudget = $result->PerformanceCost;
                        if ($searchbudget >= $budgetadd[0] && $searchbudget <= $budgetadd[1]) {
                            ?>
                            <div class="product-listing-m gray-bg">
                                <div class="product-listing-img"><img height="150px" width="200px"
                                                                      src="<?php echo htmlentities($result->PerformerPhoto); ?>"
                                                                      class="img-responsive" alt="Image"/> </a>
                                </div>
                                <div class="product-listing-content">
                                    <h5>
                                        <a href="performer-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?>
                                            , <?php echo htmlentities($result->FullName); ?></a></h5>
                                    <p class="list-price">BDT<?php echo htmlentities($result->PerformanceCost); ?> Per
                                        Day</p>
                                    <ul>
                                        <li><i class="fa fa-user"
                                               aria-hidden="true"></i><?php echo htmlentities($result->City); ?>
                                        </li>
                                        <li><i class="fa fa-calendar"
                                               aria-hidden="true"></i><?php echo htmlentities($result->id); ?> Reg.
                                            no
                                        </li>
                                    </ul>
                                    <a href="performer-details.php?vhid=<?php echo htmlentities($result->id); ?>"
                                       class="btn">View
                                        Details <span class="angle_arrow"><i class="fa fa-angle-right"
                                                                             aria-hidden="true"></i></span></a>
                                </div>
                            </div>
                        <?php }
                    }
                } ?>
            </div>

            <!--Side-Bar-->
            <aside class="col-md-3 col-md-pull-9">
                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h5><i class="fa fa-filter" aria-hidden="true"></i> Find Your Performer </h5>
                    </div>
                    <div class="sidebar_filter">
                        <form method="post" action="search-performerresult.php">
                            <div class="form-group select">
                                <select class="form-control" name="categoryid">
                                    <option>Select Category</option>

                                    <?php $sql = "SELECT * from  tblcategories ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <option value="<?php echo htmlentities($result->CategoryId); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                                        <?php }
                                    } ?>

                                </select>
                            </div>
                            <div class="form-group select">
                                <select class="form-control" name="city">
                                    <option>Select City</option>
                                    <option value="Bagerhat">Bagerhat</option>
                                    <option value="Bandarban">Bandarban</option>
                                    <option value="Barguna">Barguna</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Brammonbaria">Brammonbaria</option>
                                    <option value="Bogra">Bogra</option>
                                    <option value="Bhola">Bhola</option>
                                    <option value="Chandpur">Chandpur</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Chuadanga">Chuadanga</option>
                                    <option value="Comilla">Comilla</option>
                                    <option value="Cox's Bazar">Cox's Bazar</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Dinajpur">Dinajpur</option>
                                    <option value="Foridpur">Foridpur</option>
                                    <option value="Feni">Feni</option>
                                    <option value="Gaibanda">Gaibanda</option>
                                    <option value="Gazipur">Gazipur</option>
                                    <option value="Gopanganj">Gopanganj</option>
                                    <option value="Hobiganj">Hobiganj</option>
                                    <option value="Jaypurhat">Jaypurhat</option>
                                    <option value="Jamalpur">Jamalpur</option>
                                    <option value="Jessore">Jessore</option>
                                    <option value="Jhalokathi">Jhalokathi</option>
                                    <option value="Jhinaidaho">Jhinaidaho</option>
                                    <option value="Khagrachori">Khagrachori</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Kishoreganj">Kishoreganj</option>
                                    <option value="Kurigram">Kurigram</option>
                                    <option value="Kushtia">Kushtia</option>
                                    <option value="Lakshmipur">Lakshmipur</option>
                                    <option value="Lalmonirhat">Lalmonirhat</option>
                                    <option value="Madaripur">Madaripur</option>
                                    <option value="Magura">Magura</option>
                                    <option value="Manikgonj">Manikgonj</option>
                                    <option value="Meherpur">Meherpur</option>
                                    <option value="Moluvibazar">Moluvibazar</option>
                                    <option value="Munshiganj">Munshiganj</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Naogaon">Naogaon</option>
                                    <option value="Narayanganj">Narayanganj</option>
                                    <option value="Narsingdi">Narsingdi</option>
                                    <option value="Nator">Nator</option>
                                    <option value="Nawabgonj">Nawabgonj</option>
                                    <option value="Netrokona">Netrokona</option>
                                    <option value="Nilphamari">Nilphamari</option>
                                    <option value="Noakhali">Noakhali</option>
                                    <option value="Norail">Norail</option>
                                    <option value="Pabna">Pabna</option>
                                    <option value="Panchagar">Panchagar</option>
                                    <option value="Potuakhali">Potuakhali</option>
                                    <option value="Pirojpur">Pirojpur</option>
                                    <option value="Rajbari">Rajbari</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangamati">Rangamati</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Shatkhira">Shatkhira</option>
                                    <option value="Shariyatpur">Shariyatpur</option>
                                    <option value="Sherpur">Sherpur</option>
                                    <option value="Shirajgonj">Shirajgonj</option>
                                    <option value="Sunamgonj">Sunamgonj</option>
                                    <option value="Shylet">Shylhet</option>
                                    <option value="Tangail">Tangail</option>
                                    <option value="Thakurgaon">Thakurgaon</option>
                                </select>
                            </div>
                            <div class="form-group select">
                                <select class="form-control" name="budget">
                                    <option>Add Budget</option>
                                    <option value="1000,5000">1,000-5,000</option>
                                    <option value="5001,10000">5,001-10,000</option>
                                    <option value="10001,15000">10,001-15,000</option>
                                    <option value="15001,20000">15,001-20,000</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-block"><i class="fa fa-search"
                                                                                             aria-hidden="true"></i>
                                    Search Performer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="sidebar_widget">
                    <div class="widget_heading">
                        <h6><i aria-hidden="true"> Recently Listed Performer in Same Category & City</h6>
                    </div>
                    <div class="recent_addedcars">
                        <ul>
                            <?php
                            $sql = "SELECT tblusers.*,tblcategories.CategoryName,tblcategories.CategoryId from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId where tblusers.PublicationStatus='Published' AND tblusers.PerformerCategoryId=:categoryid AND tblusers.City=:city order by id desc limit 4";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':categoryid', $categoryid, PDO::PARAM_STR);
                            $query->bindParam(':city', $city, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>

                                    <li class="gray-bg">
                                        <div class="recent_post_img"><a
                                                href="performer-details.php?vhid=<?php echo htmlentities($result->id); ?>"><img
                                                    src="<?php echo htmlentities($result->PerformerPhoto); ?>"
                                                    alt="image"></a></div>
                                        <div class="recent_post_title"><a
                                                href="performer-details.php?vhid=<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->CategoryName); ?>
                                                , <?php echo htmlentities($result->FullName); ?></a>
                                            <p class="widget_price">
                                                BDT<?php echo htmlentities($result->PerformanceCost); ?> Per Day</p>
                                        </div>
                                    </li>
                                <?php }
                            } ?>

                        </ul>
                    </div>
                </div>
            </aside>
            <!--/Side-Bar-->
        </div>
    </div>
</section>
<!-- /Listing-->

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
