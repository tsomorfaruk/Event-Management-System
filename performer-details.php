<?php
session_start();
include('includes/config.php');
error_reporting(0);

?>
<?php
if (isset($_POST['cartresult'])) {

    $performerid = $_GET['id'];
    $sql = "SELECT FullName, PerformanceCost, PerformerPhoto FROM tblusers WHERE id=:performerid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':performerid', $performerid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result)
        {
            $performername = $result->FullName;
            $perdayperformancecost = $result->PerformanceCost;
            $performerphoto = $result->PerformerPhoto;
        }
    }
    $sessionid = session_id();
    $performdate = $_POST['calendar'];
    $performdatearr = explode(', ', $performdate);
    $datequantity = count($performdatearr);
    $performancecost = $datequantity * $perdayperformancecost;

    $sqli = "INSERT INTO tblcart(SessionId,PerformerId,PerformerName,PerformanceCost,PerformanceDate,DateQuantity,PerformerPhoto) 
                    VALUES(:sessionid,:id,:performername,:performancecost,:performdate,:datequantity,:performerphoto)";
    $query = $dbh->prepare($sqli);
    $query->bindParam(':sessionid', $sessionid, PDO::PARAM_STR);
    $query->bindParam(':id', $performerid, PDO::PARAM_STR);
    $query->bindParam(':performername', $performername, PDO::PARAM_STR);
    $query->bindParam(':performancecost', $performancecost, PDO::PARAM_STR);
    $query->bindParam(':performdate', $performdate, PDO::PARAM_STR);
    $query->bindParam(':datequantity', $datequantity, PDO::PARAM_STR);
    $query->bindParam(':performerphoto', $performerphoto, PDO::PARAM_STR);
    $query->execute();
    header('Location: checkout.php');

    /*$newformat = strtotime($performdatearr[0]);
    $newnformat = date('d-m-y',$newformat);*/
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
    <link rel="stylesheet" type="text/css" href="assets/js/jquery-ui.css">
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

<!--Listing-Image-Slider-->

<?php
$id = intval($_GET['id']);
$sql = "SELECT tblusers.*,tblcategories.CategoryName,tblcategories.CategoryId from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId where tblusers.id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query->rowCount() > 0)
{
    foreach ($results as $result)
    {
        $_SESSION['categoryid'] = $result->CategoryId;
    ?>

    <section id="listing_img_slider">
        <div><img src="<?php echo htmlentities($result->PerformerPhoto); ?>" class="img-responsive" alt="image"
                  width="320" height="240"></div>
    </section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
    <div class="container">
        <div class="listing_detail_head row">
            <div class="col-md-9">
                <h2><?php echo htmlentities($result->CategoryName); ?>
                    , <?php echo htmlentities($result->FullName); ?></h2>
            </div>
            <div class="col-md-3">
                <div class="price_info">
                    <p>BDT<?php $price = htmlentities($result->PerformanceCost);
                        echo $price; ?> </p>Per Day

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="main_features">
                    <ul>

                        <li><i class="fa fa-calendar" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result->id); ?></h5>
                            <p>Reg. no</p>
                        </li>
                        <!--  <li> <i class="fa fa-cogs" aria-hidden="true"></i>
              <h5><?php echo htmlentities($result->City); ?></h5>
              <p>City</p>
            </li>-->

                        <li><i class="fa fa-user-plus" aria-hidden="true"></i>
                            <h5><?php echo htmlentities($result->City); ?></h5>
                            <p>Performed</p>
                        </li>
                    </ul>
                </div>
                <div class="listing_more_info">
                    <div class="listing_detail_wrap">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs gray-bg" role="tablist">
                            <li role="presentation" class="active"><a href="#vehicle-overview "
                                                                      aria-controls="vehicle-overview" role="tab"
                                                                      data-toggle="tab">Performer Overview </a></li>

                            <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab"
                                                       data-toggle="tab">Performer's Skill</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- vehicle-overview -->
                            <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                                <p><?php echo htmlentities($result->Address); ?></p>
                            </div>


                            <!-- Accessories -->
                            <div role="tabpanel" class="tab-pane" id="accessories">
                                <!--Accessories-->
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!--Side-Bar-->
            <aside class="col-md-3">

                <div class="share_vehicle">
                    <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i
                                    class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i
                                    class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i
                                    class="fa fa-google-plus-square" aria-hidden="true"></i></a></p>
                </div>
                <div class="sidebar_widget">
                    <?php
                    $activation = $result->Activation;
                    if ($activation == 'Active') {
                        ?>
                        <div class="form-group">
                            <h5 style="color: black; background-color: #6be83a; text-align: center ">ACTIVE</h5>
                        </div>
                        <form method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Date" name="calendar"
                                       id="calendar"/>
                            </div>
                            <div class="form-group">
                                <button class="btn" name="cartresult">Add to Cart</button>
                            </div>
                        </form>
                        <?php
                    } else {
                        ?>
                        <div class="widget_heading">
                            <h5 style="color: whitesmoke; background-color: #f73838; text-align: center ">INACTIVE</h5>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </aside>
            <?php }
            } ?>
            <!--/Side-Bar-->
        </div>

        <div class="space-20"></div>
        <div class="divider"></div>

        <!--Similar-Cars-->
        <div class="similar_cars">
            <h3>Similar Performer</h3>
            <div class="row">
                <?php
                $categoryid = $_SESSION['categoryid'];
                $sql = "SELECT tblusers.FullName,tblcategories.CategoryName,tblusers.PerformanceCost,tblusers.City,tblusers.id,tblusers.Address,tblusers.Video,tblvehicles.PerformerPhoto from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId where tblusers.PerformerCategoryId=:categoryid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':categoryid', $categoryid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
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

                                        <li><i class="fa fa-user" aria-hidden="true"></i> performed</li>
                                        <li><i class="fa fa-calendar"
                                               aria-hidden="true"></i><?php echo htmlentities($result->id); ?> reg. no
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
        <!--/Similar-Cars-->

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
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="assets/js/jquery-ui.multidatespicker.js"></script>

<script>
    $(document).ready(function () {
        $('#calendar').multiDatesPicker({
            dateFormate: 'dd-mm-yy',
            minDate: 0,
            maxDate: 90,
            beforeShowDay: function (date) {
                dateFormat: 'dd-mm-yy';

                var disableDays = ["16-10-2018", "16-12-2018"];
                var sdate = $.datepicker.formatDate('dd-mm-yy', date);
                console.log(sdate);
                if ($.inArray(sdate, disableDays) == -1) {
                    return [true]
                }
                else {
                    return [false]
                }
            }
        });
    });
</script>


</body>
</html>