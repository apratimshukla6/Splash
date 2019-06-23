<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    session_start();
    include('config.php');
    $id = $_SESSION['id'];
    $currency_id = mysqli_real_escape_string($mysqli,$_POST['currency-id']);
    $currency_balance = 0;
    
    $sql = "SELECT * From users WHERE ID=$id";
    $retval = mysqli_query( $mysqli, $sql );
    $row = mysqli_fetch_assoc($retval);
    
    $wallet_id = $row['Wallet_ID'];
    
    $sql1 = "INSERT INTO wallet ". "( ID , Currency_ID , Currency_Balance , Wallet_ID) ". "VALUES('$id','$currency_id','$currency_balance','$wallet_id')";
    $retval1 = mysqli_query( $mysqli, $sql1 );
    
    if ($retval1)
    {
        
?>
        
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Currency Details</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Currency Successfully added to your Wallet!');
            window.location = '../currency.php';
        </script>
        </body>
        </html>
    <?php } 
    else {
    ?>
      
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Currency Details</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Failed to add the Currency to your Wallet.');
            window.location = '../currency.php';
        </script>
        </body>
        </html>

    <?php } } ?>
