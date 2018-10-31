<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_REQUEST['cancelid'])) {
        $eid = intval($_GET['cancelid']);
        $status = 2;
        $sql = "UPDATE tblbooking SET Status=:status WHERE  BookingId=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Booking Successfully Cancelled";
    }
    if (isset($_REQUEST['confirmid'])) {
        $aeid = intval($_GET['confirmid']);
        $status = 1;
        $sql = "UPDATE tblbooking SET Status=:status WHERE  BookingId=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Booking Successfully Confirmed";
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
        <title>Event Management Portal |Admin Manage testimonials </title>
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

                        <h2 class="page-title">Manage Bookings</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Bookings Info</div>
                            <div class="panel-body">
                                <?php if ($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?>
                                    </div><?php } else if ($msg) { ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?>
                                    </div><?php } ?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover"
                                       cellspacing="0" width="100%">
                                    <tr>
                                        <th>#</th>
                                        <th>Booking Id</th>
                                        <th>Client Name</th>
                                        <th>Client ContactNo</th>
                                        <th>Client Address</th>
                                        <th>Client City</th>
                                        <th>Client Nid</th>
                                        <th>Performer Id</th>
                                        <th>Performance Date</th>
                                        <th>Performance Quantity</th>
                                        <th>Performance Cost</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                    <?php
                                    $sql = "SELECT * from tblbooking order by BookingId desc";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0)
                                    {
                                        foreach ($results as $result)
                                        {
                                            $performancedate = $result->PerformanceDate;
                                            $performdatearr = explode(', ', $performancedate);
                                            $fromcalender = $performdatearr[0];
                                            $tocalender = $performdatearr[1];
                                            $curdate = date('d-m-Y');
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $result->BookingId; ?></td>
                                                    <td><?php echo $result->ClientName; ?></td>
                                                    <td><?php echo $result->ClientContactNumber; ?></td>
                                                    <td><?php echo $result->ClientAddress; ?></td>
                                                    <td><?php echo $result->ClientCity; ?></td>
                                                    <td><?php echo $result->ClientNid; ?></td>
                                                    <td><?php echo $result->PerformerId; ?></td>
                                                    <td><?php echo $result->PerformanceDate; ?></td>
                                                    <td><?php echo $result->DateQuantity; ?></td>
                                                    <td><?php echo $result->PerformanceCost; ?></td>
                                                    <?php if ($result->Status == 1) {
                                                        ?>
                                                        <td style="background:lightgreen;">Confirmed</td>
                                                    <?php }
                                                    elseif ($result->Status == 2){
                                                        ?>
                                                        <td style="background:palevioletred;">Cancelled</td>
                                                        <?php
                                                    }
                                                    else { ?>

                                                        <td>
                                                            <a href="manage-bookings.php?confirmid=<?php echo htmlentities($result->BookingId); ?>"
                                                               onclick="return confirm('Do you really want to confirm')"><i
                                                                        class="fa fa-edit"></i></a>
                                                            <a href="manage-bookings.php?cancelid=<?php echo htmlentities($result->BookingId); ?>"
                                                               onclick="return confirm('Do you really want to cancel')"><i
                                                                        class="fa fa-close"></i></a>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
