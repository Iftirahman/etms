<?php 
session_start();
error_reporting(0);
include('confs/config.php');
if(strlen($_SESSION['detsuid']==0)):
    header('location: logout.php');
else:
    if(isset($_GET['delid'])) {
        $rowid = intval($_GET['delid']);
        $query = mysqli_query($conn, "DELETE FROM tblexpenses WHERE id = '$rowid'");
        if($query) {
            // echo "<script>alert('Record successfully deleted.');</script>";
            // echo "<script>window.location.href='manage-expense.php'</script>";
            // header('location:manage-expense.php');
            $msg = "A record deleted.";
        }else {
            $msg = "Something went wrong. Please try again!";
            // echo "<script>alert('Something went wrong. Please try again!');</script>";
        }
    }

// if(isset($_GET['order'])){
//   $order=$_GET['order'];
//   } else {
//   $order='expense_date';
//   }
//   if(isset($_GET['sort'])){
//   $sort=$_GET['sort'];
//   } else {
//   $sort='DESC';
//   }
if(isset($_GET['order'])){
  $order=$_GET['order'];
  } 
  else {
  $order='expense_date';
  }
if(isset($_GET['sort'])){
  $sort=$_GET['sort'];
  } 
  else {
  $sort='DESC';
  }
  
//  $sort == 'DESC' ? $sort='ASC': $sort='DESC';}
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($conn,"SELECT *,month(expense_date) AS rptmonth,
substring(
    concat('  January'
          ,' February'
          ,'    March'
          ,'    April'
          ,'      May'
          ,'     June'
          ,'     July'
          ,'   August'
          ,'September'
          ,'  October'
          ,' November'
          ,' December'
          )
     , month(expense_date)*9 - 8
     , 9 )as monthname,
     year(expense_date) AS rptyear,
     day(expense_date) AS rptdate FROM tblexpenses WHERE user_id='$userid'ORDER BY $order $sort");

// while ($row=mysqli_fetch_array($ret)):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expense Tracker || Manage Expenses</title>
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
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Expenses</li>
			</ol>
		</div>
		
		

<!--
$userid=$_SESSION['detsuid'];
$resultset=$mysqli->query ("SELECT * FROM tblexpenses WHERE user_id='$userid' ORDER BY $order $sort");

if($resultset->num_rows>0){
  echo"
    <table border='1'>
      <tr>
        <th>S.NO</th>
        <th>Expense Item</th>
        <th>Expense Cost</th>
        <th>Expense Date</th>
        <th>Action</th>
      


  ";
  while($rows=$resultset->fetch_assoc()){
    $expense_date=$rows['expense_date'];
    $cost=$rows['cost'];
    $expense_iteme=$rows['expense_item'];

    echo"
    <tr>
      <td>$expense_date</td>
      <td>$cost</td>
      <td>$expense_item</td>
    </tr>
    ";
  }

  echo" 
  </table>
  ";

}else{
  echo"No Record Return";
}
?>
-->
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Expenses</div>
					<div class="panel-body">
            <?php if($msg): ?>
              <div class="alert alert-info"><?php echo $msg; ?></div>
            <?php endif; ?>
		
						<div class="col-md-12">
							
						<div class="table-responsive">
               
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><a href='#'>S.NO</th>
                      <th><a href='?order=expense_item&&sort=ASC'>Expense Item</th>
                      <th><a href='?order=cost&&sort=DESC'>Expense Cost</th>
                      <th><a href='?order=expense_date&&sort=DESC'>Expense Date</th>
                      <th style="text-align: center;" colspan="2"><a href='#'>Action</th>
                    </tr>
                  </thead>
                  <?php
                    // if(isset($_GET['order'])){
                    //     $order=$_GET['order'];
                    //     } 
                    //     else {
                    //     $order='expense_date';
                    //     }
                    // if(isset($_GET['sort'])){
                    //     $sort=$_GET['sort'];
                    //     } 
                    //     else {
                    //     $sort='DESC';
                    //     }
                    // $sort == 'DESC'? $sort='ASC': $sort='DESC';
                    // $userid=$_SESSION['detsuid'];
                    // $ret=mysqli_query($conn,"SELECT * FROM tblexpenses WHERE user_id='$userid'ORDER BY $order $sort");
                    $cnt=1;
                    while ($row=mysqli_fetch_array($ret)):
                
                  ?>
                  <tbody>
                    <tr>
                      <td><?php echo $cnt;?></td>
                      <td><?php  echo $row['expense_item'];?></td>
                      <td><?php  echo $row['cost'];?></td>
                      <td><?php echo $row['rptdate']."-".$row['monthname']."-".$row['rptyear']; ?></td>
                      <td><a href="manage-expense.php?delid=<?php echo $row['id'];?>">Delete</a>
                      <td><a href="edit-expense.php?editid=<?php echo $row['id'];?>">Edit</a>
                    </tr>
                    <?php 
                      $cnt=$cnt+1;
                      endwhile; 
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