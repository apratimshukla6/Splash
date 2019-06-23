<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    session_start();
    include('config.php');
    $id = $_SESSION['id'];
    $trade_id = mysqli_real_escape_string($mysqli,$_POST['trade-id']);

    $key = trim($_POST['secure-key']);
    $secure_key = mysqli_real_escape_string($mysqli,$key);

    $sql1 = "SELECT * From initiate_trade WHERE Trade_ID=$trade_id";
    $retval1 = mysqli_query($mysqli , $sql1);
    $row1 = mysqli_fetch_assoc($retval1);

    //Variables from initiate_trade table
    $acc_wallet_id = $row1['Acceptor_Wallet_ID'];
    $acc_currency_id = $row1['Acceptor_Currency_ID'];
    $acc_amount = $row1['Acceptor_Amount'];
    $ini_wallet_id = $row1['Initiator_Wallet_ID'];
    $ini_currency_id = $row1['Initiator_Currency_ID'];
    $ini_amount = $row1['Initiator_Amount'];

    if ( $secure_key == $row1['Generated_Key'] )

    {

    $sql2 = "SELECT * From wallet WHERE Wallet_ID='$acc_wallet_id' AND Currency_ID='$acc_currency_id'";
    $retval2 = mysqli_query( $mysqli, $sql2 );
    $row2 = mysqli_fetch_assoc($retval2);

    $sql_ini = "SELECT * From wallet WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$ini_currency_id'";
    $retval_ini = mysqli_query( $mysqli, $sql_ini );
    $row_ini = mysqli_fetch_assoc($retval_ini);

    $rowcount=mysqli_num_rows($retval2);

        if ( $rowcount==0 )
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
            alert('Error in completing trade.Please opt-in for the currency first!');
            window.location = '../pending-trades.php';
        </script>
        </body>
        </html>

        <?php
        } 
        else
        {
            if ( $acc_amount <= $row2['Currency_Balance'] )

            {

            $sql3 = "SELECT * From wallet WHERE Wallet_ID='$acc_wallet_id' AND Currency_ID='$ini_currency_id'";
            $retval3 = mysqli_query( $mysqli, $sql3 );
            $row3 = mysqli_fetch_assoc($retval3);

            $sql_add = "SELECT * From wallet WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$acc_currency_id'";
            $retval_add = mysqli_query( $mysqli, $sql_add );
            $row_add = mysqli_fetch_assoc($retval_add);
        
            $rowcount1=mysqli_num_rows($retval3);
        
            if ( $rowcount1==0 )
            {
                $sql4 = "INSERT INTO wallet ". "(ID , Currency_ID , Currency_Balance , Wallet_ID) ". "VALUES('$id','$ini_currency_id','$ini_amount','$acc_wallet_id')";
                $retval4 = mysqli_query( $mysqli, $sql4 );
        
                $acc_final_amount = $row2['Currency_Balance'] - $acc_amount;
                $ini_final_amount = $row_ini['Currency_Balance'] - $ini_amount;
                $add_ini_amount = $row_add['Currency_Balance'] + $acc_amount;
        
                $sql5 = "UPDATE wallet SET Currency_Balance = '$acc_final_amount' WHERE ID='$id' AND Currency_ID='$acc_currency_id'";
                $retval5 = mysqli_query( $mysqli, $sql5 );

                $sql6 = "UPDATE wallet SET Currency_Balance = '$ini_final_amount' WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$ini_currency_id'";
                $retval6 = mysqli_query( $mysqli, $sql6 );

                $sql7 = "UPDATE wallet SET Currency_Balance = '$add_ini_amount' WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$acc_currency_id'";
                $retval7 = mysqli_query( $mysqli, $sql7 );
        
                $result = "Success";
        
                $sql8 = "INSERT INTO trade_records ". "(Trade_ID , Initiator_Wallet_ID, Acceptor_Wallet_ID , Trade_Result) ". "VALUES('$trade_id','$ini_wallet_id','$acc_wallet_id','$result')";
                $retval8 = mysqli_query( $mysqli, $sql8 );

                $trade_status = 1;

                $sql_update = "UPDATE initiate_trade SET Trade_Status = '$trade_status' WHERE Trade_ID='$trade_id'";
                $retval_update = mysqli_query( $mysqli, $sql_update );
        
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
                    alert('Trade Completed Successfully!');
                    window.location = '../pending-trades.php';
                </script>
                </body>
                </html>
        
                <?php
                } 
                else
                {

                $acc_final_amount = $row2['Currency_Balance'] - $acc_amount;
                $ini_final_amount = $row_ini['Currency_Balance'] - $ini_amount;
                $add_ini_amount = $row_add['Currency_Balance'] + $acc_amount;
                $add_acc_amount = $row3['Currency_Balance'] + $ini_amount;

                $sql9 = "UPDATE wallet SET Currency_Balance = '$add_acc_amount' WHERE ID='$id' AND Currency_ID='$ini_currency_id'";
                $retval9 = mysqli_query( $mysqli, $sql9 );
        
                $sql10 = "UPDATE wallet SET Currency_Balance = '$acc_final_amount' WHERE ID='$id' AND Currency_ID='$acc_currency_id'";
                $retval10 = mysqli_query( $mysqli, $sql10 );

                $sql11 = "UPDATE wallet SET Currency_Balance = '$ini_final_amount' WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$ini_currency_id'";
                $retval11 = mysqli_query( $mysqli, $sql11 );

                $sql12 = "UPDATE wallet SET Currency_Balance = '$add_ini_amount' WHERE Wallet_ID='$ini_wallet_id' AND Currency_ID='$acc_currency_id'";
                $retval12 = mysqli_query( $mysqli, $sql12 );
        
                $result = "Success";
        
                $sql13 = "INSERT INTO trade_records ". "(Trade_ID , Initiator_Wallet_ID, Acceptor_Wallet_ID , Trade_Result) ". "VALUES('$trade_id','$ini_wallet_id','$acc_wallet_id','$result')";
                $retval13 = mysqli_query( $mysqli, $sql13 );

                $trade_status = 1;

                $sql_update = "UPDATE initiate_trade SET Trade_Status = '$trade_status' WHERE Trade_ID='$trade_id'";
                $retval_update = mysqli_query( $mysqli, $sql_update );

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
                    alert('Trade Completed Successfully!');
                    window.location = '../pending-trades.php';
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
        
                <title>Splash | Trade</title>
            
        
                <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
                <meta name="viewport" content="width=device-width" />
                </head>
                <body>
                <script>
                    alert('Insufficient Currency Balance!');
                    window.location = '../pending-trades.php';
                </script>
                </body>
                </html>
                <?php } 
        } }
        else { ?>

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
            alert('Invalid Secure Key!');
            window.location = '../pending-trades.php';
        </script>
        </body>
        </html>
        <?php } }
        ?>

