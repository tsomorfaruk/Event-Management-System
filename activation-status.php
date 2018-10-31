<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['changeactive'])) {
        $fromcalender =$_POST['fromcalendar'];
        $tocalender = $_POST['tocalendar'];
        $userid = $_POST['userid'];
        $sql = "INSERT INTO tblactivationstatus(PerformerId,FromInactive,ToInactive) VALUES(:pid,:fromcalender,:tocalender)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':pid', $userid, PDO::PARAM_STR);
        $query->bindParam(':fromcalender', $fromcalender, PDO::PARAM_STR);
        $query->bindParam(':tocalender', $tocalender, PDO::PARAM_STR);
        $query->execute();
        $msg = "Activation Status Set Successfully";
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
        <title>Event Management | My Profile</title>
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
        <link href="assets/js/jquery-ui.css" rel="stylesheet">
        <!--FontAwesome Font Style -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">

        <!-- SWITCHER -->
        <link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all"
              data-default-color="true"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange"
              media="all"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green"
              media="all"/>
        <link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple"
              media="all"/>
        <link rel="apple-touch-icon-precomposed" sizes="144x144"
              href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114"
              href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
        <link rel="apple-touch-icon-precomposed" sizes="72x72"
              href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #dd3d36;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #fff;
                border-left: 4px solid #5cb85c;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>
    <body>

    <!-- Start Switcher -->
    <?php include('includes/colorswitcher.php'); ?>
    <!-- /Switcher -->

    <!--Header-->
    <?php include('includes/header.php'); ?>
    <!-- /Header -->
    <!--Page Header-->
    <section class="page-header profile_page">
        <div class="container">
            <div class="page-header_wrap">
                <div class="page-heading">
                    <h1>Your Profile</h1>
                </div>
                <ul class="coustom-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Profile</li>
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

             as $result) { ?>
        <section class="user_profile inner_pages">
            <div class="container">
                <div class="user_profile_info gray-bg padding_4x4_40">
                    <div class="upload_user_logo"><img src="<?php echo htmlentities($result->PerformerPhoto); ?>"
                                                       alt="image">
                    </div>

                    <div class="dealer_info">
                        <h5><?php echo htmlentities($result->FullName); ?></h5>
                        <p><?php echo htmlentities($result->Address); ?><br>
                            <?php echo htmlentities($result->City); ?>
                            &nbsp;<?php echo htmlentities($result->Country); ?>
                        </p>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-sm-3">
                        <?php include('includes/sidebar.php'); ?>
                        <div class="col-md-6 col-sm-8">
                            <div class="profile_wrap">
                                <h5 class="uppercase underline">Activation Status</h5>

                                    <?php
                                    $pid = $result->id;
                                    $sql = "SELECT * FROM tblactivationstatus WHERE PerformerId=:performerid order by id desc LIMIT 1";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':performerid', $pid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result)
                                        {
                                            $frominactive = date('d-m-Y',strtotime($result->FromInactive));
                                            $toinactive = date('d-m-Y',strtotime($result->ToInactive));

                                            date_default_timezone_set('Asia/Dhaka');
                                            $timezone = date_default_timezone_get();
                                            if (strtotime($timezone)>=strtotime($frominactive) & strtotime($timezone)<=strtotime($toinactive))
                                            {
                                                ?>
                                                <div class="widget_heading">
                                                    <h5 style="color: whitesmoke; background-color: #f73838; text-align: center ">INACTIVE</h5>
                                                    <p>You are InActive from <?php echo $frominactive;?> to <?php echo $toinactive;?></p>
                                                </div>
                                                <?php
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="form-group">
                                                    <h5 style="color: black; background-color: #6be83a; text-align: center ">Now You are Active</h5>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }

                                    ?>
                                <?php
                                if ($msg) {
                                    ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                    </div><?php } ?>
                                <form method="post">
                                    <input type="hidden" name="userid" value="<?php echo $result->id;?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="InActive From" name="fromcalendar"
                                               id="fromcalender"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="InActive To" name="tocalendar"
                                               id="tocalender"/>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn" name="changeactive">Add to Cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!--/Profile-setting-->
        <?php
    } }}?>
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
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/jquery-ui.js"></script>

    <script>
        $(document).ready(function () {
            $( "#fromcalender" ).datepicker({
                minDate: 0,
                maxDate: 90
            });
            $('#tocalender').datepicker({
                minDate: 0,
                maxDate: 90
            });
        });
    </script>
    </body>
</html>
