<?php 
session_start();
error_reporting(0);
include('confs/config.php');

if(strlen($_SESSION['detsuid']==0)):
    header('location:logout.php');
else:
    if(isset($_POST['submit'])) {
        $userid = $_SESSION['detsuid'];
        $name = $_POST['Name'];
        $mbno = $_POST['contactnumber'];
        $query = mysqli_query($conn, "UPDATE tblusers SET name = '$name', mobile_number = '$mbno' WHERE id = '$userid'");
        if($query) {
            $msg = "User Profile has been updated.";
        }else {
            $msg = "Something Went Wrong. Please try again.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker || User Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    
        <?php include('confs/header.php') ?>
        <?php include('confs/sidebar.php') ?>
        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="dashboard.php"><em class="fa fa-home"></em></a></li>
                    <li class="active">Contact US</li>
                </ol>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                    <iframe src="https://bit.ly/3iODLNz" width="100%" height="400px" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                    </div>
                </div>                
            </div>
        </div>
    <?php include('confs/footer.php'); ?>
    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>

<?php endif; ?>