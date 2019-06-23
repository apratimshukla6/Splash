<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/index.php");
    exit;
}
else
{
$id=$_SESSION['id'];

include('./engine/config.php');
include('./engine/trade-notification.php');

$query1 = "SELECT * From wallet WHERE ID=$id";
$sql1 = mysqli_query($mysqli, $query1);
$query6 = "SELECT * From users WHERE ID=$id";
$sql6 = mysqli_query($mysqli, $query6);
$row5 = mysqli_fetch_array($sql6);
$sum = 0;
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Splash | Your Wallet</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../index.php" class="simple-text">
                    Splash
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="active">
                    <a href="wallet.php">
                        <i class="pe-7s-wallet"></i>
                        <p>Wallet</p>
                    </a>
                </li>
                <li>
                    <a href="currency.php">
                        <i class="pe-7s-server"></i>
                        <p>Currency</p>
                    </a>
                </li>
                <li>
                    <a href="my-trades.php">
                        <i class="pe-7s-repeat"></i>
                        <p>Trade</p>
                    </a>
                </li>
                <li>
                    <a href="transfer.php">
                        <i class="pe-7s-paper-plane"></i>
                        <p>Transfer</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="pe-7s-cash"></i>
                        <p>Add Money</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="pe-7s-plug"></i>
                        <p>API</p>
                    </a>
                </li>
				<li class="active-pro">
                    <a href="">
                        <i class="pe-7s-key"></i>
                        <p>Generate JWT</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">Wallet</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="newcurrency.php" class="dropdown-toggle">
                                <i class="fa fa-plus-square"></i>
								<p class="hidden-lg hidden-md">New Currency</p>
                            </a>
                        </li>
                        <li>
                              <a href="pending-trades.php" class="dropdown-toggle">
                                    <i class="fa fa-globe"></i>
                                    <span class="notification hidden-sm hidden-xs"><?php echo $rowcountnote; ?></span>
									<p class="hidden-lg hidden-md">
                                    <?php echo $rowcountnote; ?> Trades Pending
									</p>
                              </a>
                        </li>
                        <li>
                           <a href="currency-search.php">
                                <i class="fa fa-search"></i>
								<p class="hidden-lg hidden-md">Search</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <p>Account</p>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										API
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="">About our API</a></li>
                                <li><a href="">API Documentation</a></li>
                                <li><a href="">API Usage</a></li>
                                <li><a href="">Generate JWT</a></li>
                                <li class="divider"></li>
                                <li><a href="side-portfolio.php">Your Portfolio</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="logout.php">
                                <p>Log out</p>
                            </a>
                        </li>
						<li class="separator hidden-lg hidden-md"></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-8">
                       <div class="card">
                            <div class="header">
                                <h4 class="title">Currency Portfolio</h4>
                                <p class="category">Your account balance for different currencies.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Currency ID</th>
                                    	<th>Currency Name</th>
                                    	<th>Currency Balance</th>
                                        <th>INR Value</th>
                                    </thead>
                                     
                                    <tbody>
                                       <?php
                                            while($row = mysqli_fetch_array($sql1)){ 
                                        $currency_id = $row['Currency_ID'];
                                                
                                        $query2 = "SELECT * From currency WHERE Currency_ID=$currency_id";
                                        $sql2 = mysqli_query($mysqli, $query2);
                                        $row1 = mysqli_fetch_array($sql2);
                                                
                                        $query3 = "SELECT * From users WHERE ID=$id";
                                        $sql3 = mysqli_query($mysqli, $query3);
                                        $count1=mysqli_num_rows($sql3);
                                        $row2 = mysqli_fetch_array($sql3);
                                                
                                        $query4 = "SELECT * From balance WHERE ID=$id";
                                        $sql4 = mysqli_query($mysqli, $query4);
                                        $count2=mysqli_num_rows($sql4);
                                        $row3 = mysqli_fetch_array($sql4);
                                                
                                        $query5 = "SELECT * From currency_extra WHERE Currency_ID=$currency_id";
                                        $sql5 = mysqli_query($mysqli, $query5);
                                        $row4 = mysqli_fetch_array($sql5);
                                            
                                        $inrvalue = $row4['Unit_Cost'] * $row['Currency_Balance'];
                                        $sum = $sum + $inrvalue;
                                        
                                        ?>
                                        <tr>
                                        	<td><?php   echo   $row['Currency_ID']  ;    ?></td>
                                        
                                        <td><?php   echo  $row1['Currency_Name']  ;    ?></td>
                                    
                                        <td><?php   echo   $row['Currency_Balance'] ;    ?></td>
                                            
                                        <td><?php   echo   $inrvalue ;    ?></td>
                                        
                                        </tr>  
                                        
                                        <?php } ?> 
                                           
                                        
                                    </tbody>
                                 
                                </table>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/back-cover.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/faces/face-2.jpg" alt="..."/>

                                      <h4 class="title"><?php echo $row5['Username']."'s"; ?><br />
                                         <small>Wallet</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center">
                                    Wallet ID: <?php echo $row5['Wallet_ID'];?> <br>
                                    Account Balance: <b>&#8377;</b> 
                                    <?php 
                                    $queryacc = "SELECT * From balance WHERE ID=$id";
                                    $sqlacc = mysqli_query($mysqli, $queryacc);
                                    $count1 = mysqli_num_rows($sqlacc);
                                    if($count1 > 0)
                                    {echo $row3['Account_Balance'];}
                                    else
                                    {echo "0.00";} ?> <br>
                                    Currency Portfolio Balance: <b>&#8377;</b> <?php echo $sum; ?> <br>
                                                    
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">

                            <button href="#" class="btn btn-info btn-fill" style="font-size:20px;" onclick="location.href='start-trade.php';"><i class="pe-7s-repeat"> Trade</i></button>
                            <button href="#" class="btn btn-info btn-fill" style="font-size:20px;" onclick="location.href='transfer.php';"><i class="pe-7s-paper-plane"> Transfer</i></button>
                            <p style="color:white;">-----------------------</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="../index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="">
                                Policies
                            </a>
                        </li>
                        <li>
                            <a href="">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="../index.php">The Splash Project</a>, An Open Source Project
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome to your wallet!"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
