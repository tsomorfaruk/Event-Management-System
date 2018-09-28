<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['submit'])) {

        $fullname = $_POST['fullname'];
        $category = $_POST['category'];
        $mobile = $_POST['mobile'];
        $activationstatus = $_POST['activationstatus'];
        $publicationstatus = $_POST['publicationstatus'];
        $address = $_POST['address'];
        $performancecost = $_POST['performancecost'];
        $city = $_POST['city'];
        $dob = $_POST['dob'];
        $fathername = $_POST['fathername'];
        $mothername = $_POST['mothername'];
        $id = intval($_GET['id']);

        $sql = "update tblusers set FullName=:fullname,PerformerCategoryId=:category,FatherName=:fathername,MotherName=:mothername,ContactNo=:mobile,dob=:dob,Address=:address,City=:city,PerformanceCost=:performancecost
        ,Activation=:activationstatus,PublicationStatus=:publicationstatus where id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':fathername', $fathername, PDO::PARAM_STR);
        $query->bindParam(':mothername', $mothername, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':city', $city, PDO::PARAM_STR);
        $query->bindParam(':performancecost', $performancecost, PDO::PARAM_STR);
        $query->bindParam(':activationstatus', $activationstatus, PDO::PARAM_STR);
        $query->bindParam(':publicationstatus', $publicationstatus, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Performer data updated successfully";
        header('Location: manage-performer.php')->with($msg);
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

        <title>Event Management Portal | Admin Edit Performer Info</title>

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
                        <h2 class="page-title">Edit Performer</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="succWrap"><strong>SUCCESS</strong>
                                            :<?php echo htmlentities($msg); ?> </div><?php } ?>
                                        <?php
                                        $id = intval($_GET['id']);
                                        $sql = "SELECT tblusers.*,tblcategories.CategoryName,tblcategories.CategoryId from tblusers join tblcategories on tblcategories.CategoryId=tblusers.PerformerCategoryId where tblusers.id=:id";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results

                                                     as $result) { ?>

                                                <form method="POST" class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Performer Name<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="fullname" class="form-control"
                                                                   value="<?php echo htmlentities($result->FullName) ?>">
                                                        </div>
                                                        <label class="col-sm-2 control-label">Select Category<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="selectpicker" name="category" required>
                                                                <option value="<?php echo htmlentities($result->CategoryId); ?>"><?php echo htmlentities($categoryname = $result->CategoryName); ?> </option>
                                                                <?php $ret = "select CategoryId,CategoryName from tblcategories";
                                                                $query = $dbh->prepare($ret);
                                                                //$query->bindParam(':id',$id, PDO::PARAM_STR);
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
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Email Address<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="email" name="email" class="form-control"
                                                                   value="<?php echo htmlentities($result->EmailId); ?>"
                                                                   readonly>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Mobile No.<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="mobile" class="form-control"
                                                                   value="<?php echo htmlentities($result->ContactNo); ?>"
                                                                   >
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Activation Status<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="selectpicker" name="activationstatus">
                                                                <option value="<?php echo htmlentities($result->Activation) ?>"><?php echo htmlentities($result->Activation) ?></option>
                                                                <?php
                                                                if ($result->Activation == "Inactive") {
                                                                    ?>
                                                                    <option value="Active">Active</option>
                                                                    <?php
                                                                } else if ($result->Activation == "Active") {
                                                                    ?>
                                                                    <option value="Inactive">Inactive</option>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Publication Status<span
                                                                    style="color:red">***</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="selectpicker" name="publicationstatus">
                                                                <option value="<?php echo htmlentities($result->PublicationStatus) ?>"><?php echo htmlentities($result->PublicationStatus) ?></option>
                                                                <?php
                                                                if ($result->PublicationStatus == "Unpublished") {
                                                                    ?>
                                                                    <option value="Published">Published</option>
                                                                    <?php
                                                                } else if($result->PublicationStatus == "Published") {
                                                                    ?>
                                                                    <option value="Unpublished">Unpublished</option>
                                                                    <?php
                                                                }
                                                                else{
                                                                    ?>
                                                                    <option value="Published">Published</option>
                                                                    <option value="Unpublished">Unpublished</option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="hr-dashed"></div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Performer Address<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-10">
                                                    <textarea class="form-control" name="address" rows="3"
                                                              ><?php echo htmlentities($result->Address); ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Price Per Day(in BDT)<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="performancecost"
                                                                   class="form-control"
                                                                   value="<?php echo htmlentities($result->PerformanceCost); ?>">
                                                        </div>
                                                        <label class="col-sm-2 control-label">Select City<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <select class="selectpicker" name="city">
                                                                <option value="<?php echo htmlentities($results->City); ?>"> <?php echo htmlentities($result->City); ?> </option>
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
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Reg. no<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="id" class="form-control"
                                                                   value="<?php echo htmlentities($result->id); ?>"
                                                                   readonly>
                                                        </div>
                                                        <label class="col-sm-2 control-label">Date of Birth<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="dob" class="form-control"
                                                                   value="<?php echo htmlentities($result->dob); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Father Name<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="fathername" class="form-control"
                                                                   value="<?php echo htmlentities($result->FatherName); ?>"
                                                                   >
                                                        </div>
                                                        <label class="col-sm-2 control-label">Mother Name<span
                                                                    style="color:red">*</span></label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="mothername" class="form-control"
                                                                   value="<?php echo htmlentities($result->MotherName); ?>"
                                                                   >
                                                        </div>
                                                    </div>
                                                    <div class="hr-dashed"></div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <h4><b>Performer's Images</b></h4>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-4"><span>Performer Photo</span>
                                                            <div>
                                                                <img width="300" height="200"
                                                                     style="border:solid 1px #000"
                                                                     src="../<?php echo htmlentities($result->PerformerPhoto) ?>"
                                                                     alt="<?php echo 'Photo of ' . htmlentities($result->FullName) ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4"><span>Performer Nid Copy</span>
                                                            <div>
                                                                <img width="300" height="200"
                                                                     style="border:solid 1px #000"
                                                                     src="../<?php echo htmlentities($result->NidPhoto) ?>"
                                                                     alt="<?php echo 'Nid scan copy of ' . htmlentities($result->FullName) ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Performance Video</label>
                                                        <div>
                                                            <video height="320px" width="500px"
                                                                   src="../<?php echo htmlentities($result->Video) ?>"
                                                                   controls>
                                                            </video>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-8 col-sm-offset-2">
                                                            <input class="btn btn-success btn-block btn-microsoft" type="submit" name="submit" id="submit" style="margin-top:4%; margin-bottom: 5%;color: white;"/>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php }
                                        } ?>
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