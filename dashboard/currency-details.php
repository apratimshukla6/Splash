<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/index.php");
    exit;
}
else
{
$currency_id=$_REQUEST["cid"];
$id=$_SESSION['id']; 

include('./engine/config.php');
include('./engine/trade-notification.php');

$query1 = "SELECT * From currency WHERE Currency_ID = $currency_id";
$query2 = "SELECT * From currency_extra WHERE Currency_ID = $currency_id";
$query3 = "SELECT * From wallet WHERE Currency_ID=$currency_id AND ID=$id";
$sql1 = mysqli_query($mysqli, $query1);
$sql2 = mysqli_query($mysqli, $query2) or die( mysqli_error($mysqli));
$sql3 = mysqli_query($mysqli, $query3);
$row1=mysqli_fetch_array($sql1);
$row2=mysqli_fetch_array($sql2);
$rowcount=mysqli_num_rows($sql3);
}
?>
<!doctype html>
<html lang="en">
<head>
    
    
    
    
<style>
p,label1 {
    font: 1rem 'Fira Sans', sans-serif;
}

input1 {
    margin: .4rem;
}

</style>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Splash | <?php echo $row1['Currency_Name']; ?></title>

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
                <li class="active">
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
                    <a class="navbar-brand" href="">Currency Details</a>
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
                                <h4 class="title">Currency Details</h4>
                                <p class="category">Here are some details about the currency you have chosen.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Currency Name</th>
                                    	<th>Currency Amount</th>
                                    	<th>Unit Cost</th>
                                        <th>Currency Valuation</th>
                                        <th> Currency ID</th>
                                    </thead>
                                     
                                    <tbody>
                                        <tr>
                                        	<td><?php   echo   $row1['Currency_Name']  ;    ?></td>
                                        
                                        <td><?php   echo  $row1['Currency_Amount']  ;    ?></td>
                                    
                                        <td><?php   echo   $row2['Unit_Cost'] ;    ?></td>
                                            
                                        <td><?php   echo   $row2['Currency_Valuation'] ;    ?></td>
                                            
                                        <td><?php   echo   $row2['Currency_ID'] ;    ?></td> 
                                        
                                        </tr>  
                                        
                                        
                                           
                                        
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
                                    <div class="avatar border-gray" style="margin: auto;background-image: linear-gradient(#16BFFD,#CB3066);color:white;">
                                        <br><br>
                                        <p style="font-size:35px;-webkit-text-stroke: 1px purple;font-weight:bold;text-shadow:2px 1.5px white;"><?php echo $row2['Currency_Symbol']; ?></p>
                                    </div> 
                                    <!--<img class="avatar border-gray" src="assets/img/btc.png" alt="..."/>-->
                                      <br>
                                      <h4 class="title"><?php echo $row2['Currency_Symbol']; ?><br />
                                         <small>Currency Description</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"><?php
                                      echo   $row1['Currency_Desc']  ;    
                                        
                                    ?>
                                </p>
                            </div>
                         
                            <hr>
                            <div class="text-center">
                                <?php if ($rowcount==0) { ?>
    
                
                               <p>Add <?php echo $row1['Currency_Name']; ?> to your wallet?</p>
                                <form method="post" action="./engine/add-to-wallet.php">
                                <input type="hidden" value="<?php echo $currency_id; ?>" name="currency-id">
                                <button href="#" class="btn btn-info btn-fill" style="font-size:20px;"><i class="pe-7s-angle-right-circle"> Yes!</i></button>
                                </form>
                                <p style="color:white;">-----------------------</p>
                                
                                <?php } else { ?>
    
                
                               <p><?php echo $row1['Currency_Name']; ?> is already added in your Wallet.</p>
                                <p style="color:white;">-----------------------</p>
                                
                               <?php } ?>


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
            	icon: 'pe-7s-cash',
            	message: "Information about <?php echo $row1['Currency_Name']; ?>"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
