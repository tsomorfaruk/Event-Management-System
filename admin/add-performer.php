<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['addprofile'])) {
        $fullname = $_POST['fullname'];
        $categoryid = $_POST['category'];
        $fathername = $_POST['fathername'];
        $mothername = $_POST['mothername'];
        $email = $_POST['emailid'];
        $password = md5($_POST['password']);
        $mobileno = $_POST['mobilenumber'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $performancecost = $_POST['performancecost'];
        $activationstatus = $_POST['activationstatus'];
        $publicationstatus = $_POST['publicationstatus'];
        //for performer photo upload
        $tmp_performerphoto = $_FILES['performerphoto']['tmp_name'];
        $performerphoto = $_FILES['performerphoto']['name'];
        $moveperformerphoto = move_uploaded_file($tmp_performerphoto, 'assets/uploads/' . $performerphoto);
        $performerphotopath = 'assets/uploads/' . $performerphoto;;
        //for nid photo upload
        $nidphoto = $_FILES['nidphoto']['name'];
        $tmp_nidphoto = $_FILES['nidphoto']['tmp_name'];
        $movenidphoto = move_uploaded_file($tmp_nidphoto, 'assets/uploads/' . $nidphoto);
        $nidphotopath = 'assets/uploads/' . $nidphoto;

        //for video upload
        $video = $_FILES['video']['name'];
        $tmp_video = $_FILES['video']['tmp_name'];
        $movevideo = move_uploaded_file($tmp_video, 'assets/uploads/' . $video);
        $videopath = 'assets/uploads/' . $video;

        $sql = "INSERT INTO  tblusers(FullName,PerformerCategoryId,FatherName,MotherName,EmailId,Password,ContactNo,dob,Address,City,PerformanceCost,PerformerPhoto,NidPhoto,Video,Activation,PublicationStatus) VALUES(:fullname,:categoryid,:fathername,:mothername,:email,:password,:mobileno,:dob,:address,:city,:performancecost,:performerphotopath,:nidphotopath,:videopath,:activationstatus,:publicationstatus)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':categoryid', $categoryid, PDO::PARAM_STR);
        $query->bindParam(':fathername', $fathername, PDO::PARAM_STR);
        $query->bindParam(':mothername', $mothername, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':performancecost', $performancecost, PDO::PARAM_STR);
        $query->bindParam(':performerphotopath', $performerphotopath, PDO::PARAM_STR);
        $query->bindParam(':nidphotopath', $nidphotopath, PDO::PARAM_STR);
        $query->bindParam(':videopath', $videopath, PDO::PARAM_STR);
        $query->bindParam(':activationstatus', $activationstatus, PDO::PARAM_STR);
        $query->bindParam(':publicationstatus', $publicationstatus, PDO::PARAM_STR);
        $rslt = $query->execute();
        $msg = "Profile Updated Successfully";
//$lastInsertId = $dbh->lastInsertId();
        if ($rslt) {
            $msg = "Vehicle posted successfully";
        } else {
            $error = "Something went wrong. Please try again";
        }

    }


    ?>
    <!doctype html>
    <html lang="en" class="no-js">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Event Management Portal | Admin Post Performer</title>

        <!-- Font awesome -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- Sandstone Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- Bootstrap Datatables -->
        <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
        <!-- Bootstrap social button library -->
        <link rel="stylesheet" href="css/bootstrap-social.css">
        <!-- Bootstrap select -->
        <link rel="stylesheet" href="css/bootstrap-select.css">
        <!-- Bootstrap file input -->
        <link rel="stylesheet" href="css/fileinput.min.css">
        <!-- Awesome Bootstrap checkbox -->
        <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
        <!-- Admin Stye -->
        <link rel="stylesheet" href="css/style.css">
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
    <?php include('includes/header.php'); ?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <h2 class="page-title">Post A Performer</h2>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>
                                    <?php if ($error) { ?>
                                        <div class="errorWrap"><strong>ERROR</strong>
                                        :<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?>
                                        <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                        </div><?php } ?>

                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data"
                                              multiple>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Full Name<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="fullname" class="form-control">
                                                </div>
                                                <label class="col-sm-2 control-label">Category<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="category">
                                                        <option></option>
                                                        <?php $ret = "select CategoryId,CategoryName from tblcategories";
                                                        $query = $dbh->prepare($ret);
                                                        $query->execute();
                                                        $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($resultss as $results) {
                                                                if ($results->CategoryName == $categoryname) {
                                                                    continue;
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo htmlentities($results->CategoryId); ?>"><?php echo htmlentities($results->CategoryName); ?></option>
                                                                <?php }
                                                            }
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Father Name<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="fathername" class="form-control">
                                                </div>
                                                <label class="col-sm-2 control-label">Mother Name<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="mothername" class="form-control">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Email Address<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="email" name="emailid" class="form-control">
                                                </div>
                                                <label class="col-sm-2 control-label">Password<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Phone Number<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="mobilenumber" class="form-control"
                                                           max="11">
                                                </div>
                                                <label class="col-sm-2 control-label">Date of
                                                    Birth&nbsp;(dd/mm/yyyy)<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="dob" class="form-control">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Price Per Day(in BDT)<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="performancecost" class="form-control">
                                                </div>
                                                <label class="col-sm-2 control-label">Select City<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="city">
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
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address<span
                                                            style="color:red">*</span></label>
                                                <textarea class="col-sm-4 form-control" name="address"
                                                          rows="4"></textarea>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label>Performer Photo<span style="color:red">*</span></label>
                                                <div class="col-sm-4 form-control">
                                                    <input name="performerphoto" type="file" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label>Performer Nid Copy<span style="color:red">*</span></label>
                                                <div class=" col-sm-4 form-control">
                                                    <input name="nidphoto" type="file" accept="image/*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Performance Video</label>
                                                <div class="col-sm-4 form-control">
                                                    <input name="video" type="file" accept="video/*">
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Activation Status<span
                                                            style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="activationstatus">
                                                        <option></option>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 control-label">Publication Status<span
                                                            style="color:red">***</span></label>
                                                <div class="col-sm-4">
                                                    <select class="selectpicker" name="publicationstatus">
                                                        <option value="Published">Published</option>
                                                        <option value="Unpublished">Unpublished</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <input class="btn btn-success btn-block btn-microsoft" type="submit"
                                                           name="addprofile" id="submit"
                                                           style="margin-top:4%; margin-bottom: 5%;color: white;"
                                                           value="Add new Performer"/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
    </body>
    </html>
<?php } ?>
