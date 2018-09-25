<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['updateprofile'])) {
        $name = $_POST['fullname'];
        $fathername = $_POST['fathername'];
        $mothername = $_POST['mothername'];
        $mobileno = $_POST['mobilenumber'];
        $dob = $_POST['dob'];
        $adress = $_POST['address'];
        $city = $_POST['city'];
        $performancecost = $_POST['performancecost'];
        $tmp_performerphoto = $_FILES['performerphoto']['tmp_name'];
        $performerphoto = $_FILES['performerphoto']['name'];
        if ($performerphoto){
            $oldperformerphotopath = $_POST['oldperformerphoto'];
            unlink($oldperformerphotopath);
            $moveperformerphoto = move_uploaded_file($tmp_performerphoto,'assets/uploads/'.$performerphoto);
            $performerphotopath ='assets/uploads/'.$performerphoto;
        }
        else{
            $performerphotopath = $_POST['oldperformerphoto'];
        }
        $nidphoto =$_FILES['nidphoto']['name'];
        $tmp_nidphoto = $_FILES['nidphoto']['tmp_name'];
        if ($nidphoto){
            $oldnidphotopath = $_POST['oldnidphoto'];
            unlink($oldnidphotopath);
            $movenidphoto = move_uploaded_file($tmp_nidphoto,'assets/uploads/'.$nidphoto);
            $nidphotopath ='assets/uploads/'.$nidphoto;
        }
        else{
            $nidphotopath = $_POST['oldnidphoto'];
        }
        $video = $_FILES['video']['name'];
        $tmp_video = $_FILES['video']['tmp_name'];
        if ($video){
            $oldvideopath = $_POST['oldvideo'];
            unlink($oldvideopath);
            $movevideo = move_uploaded_file($tmp_video,'assets/uploads/'.$video);
            $videopath ='assets/uploads/'.$video;
        }
        else{
            $videopath = $_POST['oldvideo'];
        }
        move_uploaded_file($tmp_video,'assets/uploads/'.$video);
        $movevideo ='assets/uploads/'.$video;
        $email = $_SESSION['login'];
        $sql = "update tblusers set FullName=:name,FatherName=:fathername,MotherName=:mothername,ContactNo=:mobileno,dob=:dob,Address=:adress,City=:city,PerformanceCost=:performancecost
        ,PerformerPhoto=:performerphotopath,NidPhoto=:nidphotopath,Video=:videopath where EmailId=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':fathername', $fathername, PDO::PARAM_STR);
        $query->bindParam(':mothername', $mothername, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':adress', $adress, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':performancecost', $performancecost, PDO::PARAM_STR);
        $query->bindParam(':performerphotopath', $performerphotopath, PDO::PARAM_STR);
        $query->bindParam(':nidphotopath', $nidphotopath, PDO::PARAM_STR);
        $query->bindParam(':videopath', $videopath, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $msg = "Profile Updated Successfully";
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

             as $result)
    { ?>
    <section class="user_profile inner_pages">
        <div class="container">
            <div class="user_profile_info gray-bg padding_4x4_40">
                <div class="upload_user_logo"><img src="<?php echo htmlentities($result->PerformerPhoto);?>" alt="image">
                </div>

                <div class="dealer_info">
                    <h5><?php echo htmlentities($result->FullName); ?></h5>
                    <p><?php echo htmlentities($result->Address); ?><br>
                        <?php echo htmlentities($result->City); ?>&nbsp;<?php echo htmlentities($result->Country); ?>
                    </p>

                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <?php include('includes/sidebar.php'); ?>
                    <div class="col-md-6 col-sm-8">
                        <div class="profile_wrap">
                            <h5 class="uppercase underline">Genral Settings</h5>
                            <?php
                            if ($msg) {
                                ?>
                                <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                </div><?php } ?>
                            <form method="post" enctype="multipart/form-data" multiple>
                                <div class="form-group">
                                    <label class="control-label">Reg Date -</label>
                                    <?php echo htmlentities($result->RegDate); ?>
                                </div>
                                <?php if ($result->UpdationDate != "") { ?>
                                    <div class="form-group">
                                        <label class="control-label">Last Update at -</label>
                                        <?php echo htmlentities($result->UpdationDate); ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <input class="form-control white_bg" name="fullname"
                                           value="<?php echo htmlentities($result->FullName); ?>" id="fullname"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Father Name</label>
                                    <input class="form-control white_bg" name="fathername"
                                           value="<?php echo htmlentities($result->FatherName); ?>" id="fathername"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Mother Name</label>
                                    <input class="form-control white_bg" name="mothername"
                                           value="<?php echo htmlentities($result->MotherName); ?>" id="mothername"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email Address</label>
                                    <input class="form-control white_bg"
                                           value="<?php echo htmlentities($result->EmailId); ?>" name="emailid"
                                           id="email" type="email" required readonly>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Phone Number</label>
                                    <input class="form-control white_bg" name="mobilenumber"
                                           value="<?php echo htmlentities($result->ContactNo); ?>" id="phone-number"
                                           type="text" required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Date of Birth&nbsp;(dd/mm/yyyy)</label>
                                    <input class="form-control white_bg"
                                           value="<?php echo htmlentities($result->dob); ?>" name="dob"
                                           placeholder="dd/mm/yyyy" id="birth-date" type="text">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Your Address</label>
                                    <textarea class="form-control white_bg" name="address"
                                              rows="4"><?php echo htmlentities($result->Address); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <select class="form-control white_bg" id="city" name="city">
                                        <option value="<?php echo htmlentities($result->City); ?>"><?php echo htmlentities($result->City); ?></option>
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
                                <?php }
                                } ?>
                                <div class="form-group">
                                    <label class="control-label">Demand for Performance</label>
                                    <input class="form-control white_bg" name="performancecost"
                                           value="<?php echo htmlentities($result->PerformanceCost); ?>" type="number"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Photo</label>
                                    <input class="form-control white_bg" name="performerphoto" type="file" accept="image/*"
                                           >
                                    <input type="hidden" name="oldperformerphoto" value="<?php echo htmlentities($result->PerformerPhoto);?>">
                                    <div>
                                        <img height="180px" width="230px" src="<?php echo htmlentities($result->PerformerPhoto)?>" alt="<?php echo htmlentities($result->FullName)?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Nid Photocopy</label>
                                    <input class="form-control white_bg" name="nidphoto" type="file" accept="image/*"
                                           >
                                    <input type="hidden" name="oldnidphoto" value="<?php echo htmlentities($result->NidPhoto);?>">
                                    <div>
                                        <img height="180px" width="230px" src="<?php echo htmlentities($result->NidPhoto)?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Performance Video</label>
                                    <input class="form-control white_bg" name="video" type="file" accept="video/*"
                                           >
                                    <input type="hidden" name="oldvideo" value="<?php echo htmlentities($result->Video);?>">
                                    <div>
                                        <video height="320px" width="500px" src="<?php echo htmlentities($result->Video)?>" controls>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button id="insert" type="submit" name="updateprofile" class="btn">Save Changes <span
                                                class="angle_arrow"><i class="fa fa-angle-right"
                                                                       aria-hidden="true"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--/Profile-setting-->

    <<!--Footer -->
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
    </html>
<?php

} ?>
<script>
    $(document).ready(function () {
        $('#insert').click(function () {
           var image_name = $
        });
    })
</script>