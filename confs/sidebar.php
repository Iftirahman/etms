<?php
session_start();
error_reporting(0);
include('config.php');
$uid = $_SESSION['detsuid'];
$sql = mysqli_query($conn, "SELECT name FROM tblusers WHERE id = '$uid'");
$result = mysqli_fetch_array($sql);
$name = $result['name'];
$lname= '<a href="user-profile.php">'.$name.'</a>'
?>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
        <a href="user-profile.php"><img src="150.jpg" class="img-responsive" alt=""></a>
        </div>
        <div class="profile-usertitle">            
            <div class="profile-usertitle-name"><?php echo $name;?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>
    <ul class="nav menu">

        <li class="active"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em>Dashboard</a></li>

        <li class="parent">
            <a href="#sub-item-1" data-toggle="collapse">
                <em class="fa fa-money">&nbsp;</em>Expenses <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>

            <ul class="children collapse" id="sub-item-1">
                <li><a href="add-expense.php"><span class="fa fa-arrow-right">&nbsp;</span>Add Expenses</a></li>
                <li><a href="manage-expense.php"><span class="fa fa-arrow-right">&nbsp;</span>Manage Expenses</a></li>
            </ul>

        </li>

        <li class="parent">
            <a href="#sub-item-2" data-toggle="collapse">
                <em class="fa fa-bar-chart">&nbsp;</em>Expense Report <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>

            <ul class="children collapse" id="sub-item-2">
                <li><a href="expense-daywise-report.php"><span class="fa fa-arrow-right">&nbsp;</span>Daywise Expenses</a></li>
                <li><a href="expense-monthwise-report.php"><span class="fa fa-arrow-right">&nbsp;</span>Monthwise Expenses</a></li>
                <li><a href="expense-yearwise-report.php"><span class="fa fa-arrow-right">&nbsp;</span>Yearwise Expenses</a></li>
            </ul>

        </li>

        <li><a href="user-profile.php"><em class="fa fa-user">&nbsp;</em>Profile</a></li>

        <li><a href="change-password.php"><em class="fa fa-lock">&nbsp;</em>Change Password</a></li>

        <li><a href="contacts.php"><em class="fa fa-comments">&nbsp;</em>Contact Us</a></li>

        <li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em>Log out</a></li>

    </ul>

</div>