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

$query1 = "SELECT * From users WHERE ID=$id";
$sql1 = mysqli_query($mysqli, $query1); 
$row1 = mysqli_fetch_assoc($sql1);
$wallet_id = $row1['Wallet_ID'];
$query2 = "SELECT * From initiate_trade WHERE Acceptor_Wallet_ID='$wallet_id' AND Trade_Status=0";
$sql2 = mysqli_query($mysqli, $query2); 
$query3 = "SELECT * From trade_records WHERE Acceptor_Wallet_ID='$wallet_id'";
$sql3 = mysqli_query($mysqli, $query3); 
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Splash | Trades Pending Acceptance</title>
    

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
                <li>
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
                <li class="active">
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
                    <a class="navbar-brand" href="">My Trades</a>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Pending Trades initiated by others</h4>
                                <p class="category">Note:You need the <b>Secure Key</b> to complete these trades.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Initiator Wallet ID</th>
                                    	<th>Currency being Received</th>
                                    	<th>Currency Amount being Received</th>
                                    	<th>Currency being Sent</th>
                                        <th>Currency Amount being Sent</th>
                                        <th>Trade Timestamp</th>    
                                    	<th style="color:white">empty 2</th>
                                    </thead>
                                     
                                    <tbody>
                                       <?php
                                           
                                            
                                        while($row = mysqli_fetch_array($sql2)){
                                         $send_id = $row['Initiator_Currency_ID'];
                                         $receive_id = $row['Acceptor_Currency_ID'];
                                         $query4 = "SELECT * From currency WHERE Currency_ID=$send_id";
                                         $sql4 = mysqli_query($mysqli, $query4);
                                         $row4 = mysqli_fetch_assoc($sql4);
                                         $query5 = "SELECT * From currency WHERE Currency_ID=$receive_id";
                                         $sql5 = mysqli_query($mysqli, $query5);
                                         $row5 = mysqli_fetch_assoc($sql5);
                                         ?>
                                        <tr>
                                        	<td><?php   echo   $row['Initiator_Wallet_ID']  ;    ?></td>
                                        
                                        <td><?php   echo  $row4['Currency_Name']  ;    ?></td>
                                    
                                        <td><?php   echo   $row['Initiator_Amount'] ;    ?></td>

                                        <td><?php   echo   $row5['Currency_Name'] ;    ?></td>

                                        <td><?php   echo   $row['Acceptor_Amount'] ;    ?></td>

                                        <td><?php   echo   $row['Trade_Timestamp'] ;    ?></td>
                                    
                                        <td><form method="post" action="./authorize-trade.php"><input type="hidden" value="<?php   echo   $row['Trade_ID']  ;    ?>" name="tradeid"><button type="submit" class="btn btn-info btn-fill"><i class="pe-7s-door-lock"></i> Proceed</button></form></td>
                                        
                                        </tr>  <?php } ?> 
                                
                                        
                                    </tbody>
                                 
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Trades Accepted initiated by others</h4>
                                <p class="category">List of the trades which you have accepted.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover">
                                    <thead>
                                        <th>Trade ID</th>
                                    	<th>Initiator Wallet ID</th>
                                    	<th>Acceptor Wallet ID</th>
                                    	<th>Trade Result</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                              
                                            <?php
                                         while($row = mysqli_fetch_array($sql3)){
                                            $trade_id = $row['Trade_ID'];
                                            $initiator_id = $row['Initiator_Wallet_ID']; 
                                            $acceptor_id = $row['Acceptor_Wallet_ID']; 
                                            $trade_result = $row['Trade_Result']; 
                                         ?>
                                        <tr>
                                        	<td><?php   echo   $trade_id  ;    ?></td>
                                        
                                        <td><?php   echo  $initiator_id  ;    ?></td>
                                    
                                        <td><?php   echo   $acceptor_id ;    ?></td>

                                        <td><?php   echo   $trade_result ;    ?></td>
                                        
                                        </tr>  <?php } ?> 
                                    
                                       
                                    </tbody>
                                </table>
                                <div align="centre">  <button  class="btn btn-info btn-fill pull-right" onclick="location.href='start-trade.php';">Start a New Trade</button></div>
        

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


</html>