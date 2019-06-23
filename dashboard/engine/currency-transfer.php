<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    session_start();
    include('config.php');
    $id = $_SESSION['id'];
    $wallet_id = mysqli_real_escape_string($mysqli,$_POST['wallet-id']);

    date_default_timezone_set("Asia/Calcutta");

    $date = date("Y-m-d");
    $time = date("h:i:s");
    $timestamp = $date." ".$time;
    $payee_id = mysqli_real_escape_string($mysqli,$_POST['payee-id']);
    $send_id = mysqli_real_escape_string($mysqli,$_POST['send-id']);
    $send_amount = mysqli_real_escape_string($mysqli,$_POST['send-amount']);

    $sql3 = "SELECT * From users WHERE Wallet_ID=$payee_id";
    $retval3 = mysqli_query($mysqli , $sql3);
    $row3 = mysqli_fetch_assoc($retval3);

    $payee_user_id = $row3['ID'];
    
    $sql4 = "SELECT * From wallet WHERE ID='$id' AND Currency_ID='$send_id'";
    $retval4 = mysqli_query($mysqli , $sql4);
    $row4 = mysqli_fetch_assoc($retval4);

    if ( $send_amount <= $row4['Currency_Balance'] )

    {
    $sql5 = "SELECT * From wallet WHERE Wallet_ID='$payee_id' AND Currency_ID='$send_id'";
    $retval5 = mysqli_query( $mysqli, $sql5 );
    $row5 = mysqli_fetch_assoc($retval5);

    $rowcount=mysqli_num_rows($retval5);

    if ( $rowcount==0 )
    {
        $sql6 = "INSERT INTO wallet ". "(ID , Currency_ID , Currency_Balance , Wallet_ID) ". "VALUES('$payee_user_id','$send_id','$send_amount','$payee_id')";
        $retval6 = mysqli_query( $mysqli, $sql6 );

        $final_amount = $row4['Currency_Balance'] - $send_amount;

        $sql7 = "UPDATE wallet SET Currency_Balance = '$final_amount' WHERE ID='$id' AND Currency_ID='$send_id'";
        $retval7 = mysqli_query( $mysqli, $sql7 );

        $result = "Success";

        $sql8 = "INSERT INTO transfer_records ". "(Payer_Wallet_ID , Payee_Wallet_ID, Currency_ID , Transfer_Amount , Transfer_Result, Transfer_Time) ". "VALUES('$wallet_id','$payee_id','$send_id','$send_amount','$result','$timestamp')";
        $retval8 = mysqli_query( $mysqli, $sql8 );

    ?>

        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Transfer</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Currency Amount Successfully Transferred!');
            window.location = '../my-trades.php';
        </script>
        </body>
        </html>

        <?php
        } 
        else
        {

        $amount = $row5['Currency_Balance'] + $send_amount;
        $sql6 = "UPDATE wallet SET Currency_Balance = '$amount' WHERE ID='$payee_user_id' AND Currency_ID='$send_id'";
        $retval6 = mysqli_query( $mysqli, $sql6 );

        $final_amount = $row4['Currency_Balance'] - $send_amount;

        $sql7 = "UPDATE wallet SET Currency_Balance = '$final_amount' WHERE ID='$id' AND Currency_ID='$send_id'";
        $retval7 = mysqli_query( $mysqli, $sql7 );

        $result = "Success";

        $sql8 = "INSERT INTO transfer_records ". "(Payer_Wallet_ID , Payee_Wallet_ID, Currency_ID , Transfer_Amount , Transfer_Result, Transfer_Time) ". "VALUES('$wallet_id','$payee_id','$send_id','$send_amount','$result','$timestamp')";
        $retval8 = mysqli_query( $mysqli, $sql8 );
        ?>
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Transfer</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Currency Amount Successfully Transferred!');
            window.location = '../my-trades.php';
        </script>
        </body>
        </html>
        <?php } }
        else {
        ?>
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Transfer</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Insufficient Currency Balance!');
            window.location = '../my-trades.php';
        </script>
        </body>
        </html>
        <?php } 
} ?>
