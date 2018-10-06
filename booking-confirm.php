<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_POST['confirmbooking'])) {

    $sessionid = session_id();
    $sql = "SELECT * FROM tblcart WHERE SessionId=:sessionid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sessionid', $sessionid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        foreach ($results as $result)
        {
            $performerid = $result->PerformerId;
            $performername = $result->PerformerName;
            $performancecost = $result->PerformanceCost;
            $performancedate = $result->PerformanceDate;
            $datequantity = $result->DateQuantity;
        }
    }
    $name = $_POST['fullname'];
    $emailid = $_POST['emailid'];
    $mobileno = $_POST['mobilenumber'];
    $nid = $_POST['nid'];
    $adress = $_POST['address'];
    $city = $_POST['city'];
    $accnumber = $_POST['accnumber'];
    $accpass = $_POST['accpass'];
    $sql = "INSERT INTO tblbooking(ClientName,ClientEmail,ClientContactNumber,ClientAddress,ClientCity,ClientNid,ClientAccNumber,ClientAccPass,PerformerId,PerformerName,PerformanceDate,DateQuantity,PerformanceCost) 
                    VALUES(:name,:emailid,:mobileno,:address,:city,:nid,:accnumber,:accpass,:performerid,:performername,:performancedate,:datequantity,:performancecost)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':emailid', $emailid, PDO::PARAM_STR);
    $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
    $query->bindParam(':address', $adress, PDO::PARAM_STR);
    $query->bindParam(':city', $city, PDO::PARAM_STR);
    $query->bindParam(':nid', $nid, PDO::PARAM_STR);
    $query->bindParam(':accnumber', $accnumber, PDO::PARAM_STR);
    $query->bindParam(':accpass', $accpass, PDO::PARAM_STR);
    $query->bindParam(':performerid', $performerid, PDO::PARAM_STR);
    $query->bindParam(':performername', $performername, PDO::PARAM_STR);
    $query->bindParam(':performancedate', $performancedate, PDO::PARAM_STR);
    $query->bindParam(':datequantity', $datequantity, PDO::PARAM_STR);
    $query->bindParam(':performancecost', $performancecost, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $sql = "delete from tblcart  WHERE SessionId=:sessionid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sessionid', $sessionid, PDO::PARAM_STR);
        $query->execute();
        header('Location: index.php');
    }

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
<section class="user_profile inner_pages">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <?php include('includes/sidebar.php'); ?>
                <div class="col-md-6 col-sm-8">
                    <div class="profile_wrap">
                        <h5 class="uppercase underline">Genral Settings</h5>
                            <div class="succWrap"><strong>SUCCESS</strong>:
                            </div>
                        <form method="post">
                            <div class="form-group">
                                <label class="control-label">Full Name</label>
                                <input class="form-control white_bg" name="fullname" id="fullname"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email Address</label>
                                <input class="form-control white_bg" name="emailid"
                                       id="email" type="email" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Phone Number</label>
                                <input class="form-control white_bg" name="mobilenumber" maxlength="11"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">NID Number</label>
                                <input class="form-control white_bg" name="nid"
                                       type="text" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Your Full Address</label>
                                <textarea class="form-control white_bg" name="address" placeholder="Village, Sub-District, District"
                                          rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <select class="form-control white_bg" id="city" name="city">
                                    <option></option>
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
                            <div class="form-group">
                                <label class="control-label">Account Number</label>
                                <input class="form-control white_bg" name="accnumber"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Account Pin Number</label>
                                <input class="form-control white_bg" name="accpass"
                                       type="text" required>
                            </div>
                            <div class="form-group">
                                <button id="insert" type="submit" name="confirmbooking" class="btn">Confirm <span
                                            class="angle_arrow"><i class="fa fa-angle-right"
                                                                   aria-hidden="true"></i></span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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