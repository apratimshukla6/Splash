<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    include('config.php');
    session_start();
    $id = $_SESSION['id'];
    $your_wallet = mysqli_real_escape_string($mysqli,$_POST['wallet-id']);
    $trader_wallet = mysqli_real_escape_string($mysqli,$_POST['trader-id']);
    $send_currency = mysqli_real_escape_string($mysqli,$_POST['send-id']);
    $send_amount = mysqli_real_escape_string($mysqli,$_POST['send-amount']);
    $receive_currency = mysqli_real_escape_string($mysqli,$_POST['receive-id']);
    $receive_amount = mysqli_real_escape_string($mysqli,$_POST['receive-amount']);

    $n = 4; 
    $key = bin2hex(random_bytes($n)); 

    date_default_timezone_set("Asia/Calcutta");

    $date = date("Y-m-d");
    $time = date("h:i:s");
    $timestamp = $date." ".$time;
    $status=0;

    $sql1 = "SELECT * From wallet WHERE ID=$id AND Currency_ID=$send_currency";
    $retval1 = mysqli_query( $mysqli, $sql1 );
    $row1 = mysqli_fetch_assoc($retval1);

    $sql_ini = "SELECT * From wallet WHERE Wallet_ID='$trader_wallet'";
    $retval_ini = mysqli_query( $mysqli, $sql_ini );
    $row_ini = mysqli_fetch_assoc($retval_ini);

    if ( ( $send_amount <= $row1['Currency_Balance'] ) && ( $row_ini != 0 ) )
    {
        $sql2 = "INSERT INTO initiate_trade ". "(Initiator_Wallet_ID , Initiator_Currency_ID , Acceptor_Wallet_ID , Acceptor_Currency_ID , Initiator_Amount, Acceptor_Amount, Generated_Key, Trade_Timestamp, Trade_Status) ". "VALUES('$your_wallet','$send_currency','$trader_wallet','$receive_currency','$send_amount','$receive_amount','$key','$timestamp','$status')";
    
        $retval2 = mysqli_query( $mysqli, $sql2 );

        if ($retval2)
        {

        ?>
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Initiate Trade</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Trade Successfully Initiated!');
            window.location = '../my-trades.php';
        </script>
        </body>
        </html>

        <?php
        }

        else
        {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Initiate Trade</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Trade initiation failed.');
            window.location = '../start-trade.php';
        </script>
        </body>
        </html>
        <?php 
        }
    }

    else
    {

    ?>

        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Initiate Trade</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert("Insufficient Currency Balance or Invalid Acceptor Wallet ID.Currency Balance: <?php echo $row1['Currency_Balance']; ?> ");
            window.location = '../start-trade.php';
        </script>
        </body>
        </html>

    <?php } 

    }

?>