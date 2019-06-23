<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    session_start();
    include('config.php');
    $id = $_SESSION['id'];
    $trade_id = mysqli_real_escape_string($mysqli,$_POST['trade-id']);

    $status = 1;

    $sql_update = "UPDATE initiate_trade SET Trade_Status = '$status' WHERE Trade_ID='$trade_id'";
    $retval_update = mysqli_query($mysqli , $sql_update);

    $sql1 = "SELECT * From initiate_trade WHERE Trade_ID=$trade_id";
    $retval1 = mysqli_query($mysqli , $sql1);
    $row1 = mysqli_fetch_assoc($retval1);

    //Variables from initiate_trade table
    $acc_wallet_id = $row1['Acceptor_Wallet_ID'];
    $ini_wallet_id = $row1['Initiator_Wallet_ID'];

    $result = "Cancelled";

    $sql2 = "INSERT INTO trade_records ". "(Trade_ID , Initiator_Wallet_ID, Acceptor_Wallet_ID , Trade_Result) ". "VALUES('$trade_id','$ini_wallet_id','$acc_wallet_id','$result')";
    $retval2 = mysqli_query($mysqli , $sql2);
    if ( $retval2 && $retval1 && $retval_update )
    {
    ?>
    <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Trade</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Trade Cancelled!');
            window.location = '../pending-trades.php';
        </script>
        </body>
        </html>
        <?php
} }
?>

