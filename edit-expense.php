<?php 
session_start();
error_reporting(0);
include('confs/config.php');
if(strlen($_SESSION['detsuid']==0)):
    header("location: logout.php");
else:
    // if(isset($_POST['submit'])) {
    //     $userid = $_SESSION['detsuid'];
    //     $exdate = $_POST['expense_date'];
    //     $item = $_POST['expense_item'];
    //     $itemcost = $_POST['cost'];
    //     $query = mysqli_query($conn, "INSERT INTO tblexpenses(user_id, expense_date, expense_item, cost) VALUES ('$userid', '$exdate', '$item', '$itemcost')");
    //     if($query) {
    //         echo "<script>alert('Expense has been added');</script>";
    //         header("location: manage-expense.php");
    //     }else { echo "<script>alert('Something went wrong. Please try again!');</script>"; }
    // } 
    
    if(isset($_POST['submit'])) {
        $editid = $_GET['editid'];
        $exdate = $_POST['expense_date'];
        $item = $_POST['expense_item'];
        $itemcost = $_POST['cost'];
        $query = mysqli_query($conn, "UPDATE tblexpenses SET expense_date = '$exdate', expense_item = '$item', cost = '$itemcost' WHERE id = '$editid'");
        if($query) {
            // echo '<script>alert("Record has been updated.");window.location.href="manage-expense.php";</script>';
            //header("location: manage-expense.php");
            $msg = "Record has been updated.";
        }else {
            // echo "<script>alert('Something went wrong. Please try again!');</script>";
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
    <title>Expense Tracker || Edit Expense</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>

    <?php include('confs/header.php'); ?>
    <?php include('confs/sidebar.php'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
            <ol class="breadcrumb">
                <li><a href="dashboard.php"><em class="fa fa-home">&nbsp;</em></a></li>
                <li class="active">Edit Expenses</li>
            </ol>
        </div>
        
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Expense Editing</div>
                    <div class="panel-body">
                    <?php if($msg): ?>
                        <div class="alert alert-info"><?php echo $msg; ?></div>
                    <?php endif; ?>
                        
                        <div class="col-md-12">
                        <?php
                                    $editid = $_GET['editid'];
                                    $result = mysqli_query($conn, "SELECT * FROM tblexpenses WHERE id = '$editid'");
                                    while($row = mysqli_fetch_array($result)):
                                ?>
                            <form role="form" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Date of Expense</label>

                                        <input type="date"  class="form-control" name="expense_date" value="<?php echo $row['expense_date']; ?>" required>
                                    
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Item Name</label>
                                        <input type="text" class="form-control" name="expense_item" value="<?php echo $row['expense_item']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" class="form-control" name="cost" value="<?php echo $row['cost']; ?>" required>
                                    </div>
                                    <div class="form-group pull-right">
                                        <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                    </div>
                                </fieldset> 
                            </form>
                            <?php endwhile; ?>
                        </div>
                    </div>
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
    <script src="js/dates.js"></script>
</body>
</html>
<?php endif; ?>