<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
    session_start();
    include('config.php');
    $id = $_SESSION['id'];
    $currency_id = mysqli_real_escape_string($mysqli,$_POST['currency-id']);
    $currency_amount = mysqli_real_escape_string($mysqli,$_POST['currency-amount']);
    $unit_cost = mysqli_real_escape_string($mysqli,$_POST['unit-cost']);
    $currency_symbol = mysqli_real_escape_string($mysqli,$_POST['currency-symbol']);
    $currency_desc = mysqli_real_escape_string($mysqli,$_POST['currency-desc']);
    
    $total_valuation = $currency_amount * $unit_cost;
    
    $sql1 = "SELECT * From balance WHERE ID=$id";         
    $retval1 = mysqli_query( $mysqli, $sql1 );
    $row1 = mysqli_fetch_assoc($retval1);
    
    $account_balance = $row1['Account_Balance'];
    
    if ($total_valuation > $account_balance)
    {
        $difference = $total_valuation - $account_balance;
?>
        
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Edit Currency</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Insufficient Account Balance. More INR <?php echo $difference; ?> required.');
            window.location = '../currency.php';
        </script>
        </body>
        </html>
    <?php } 
    else {
        $sql2 = "UPDATE currency SET Currency_Desc = '$currency_desc' WHERE Currency_ID = $currency_id";
        $retval2 = mysqli_query( $mysqli, $sql2 );
        
        $sql3 = "UPDATE currency_extra SET Unit_Cost = '$unit_cost' , Currency_Symbol = '$currency_symbol' , Currency_Valuation = '$total_valuation' WHERE Currency_ID = $currency_id";
        $retval3 = mysqli_query( $mysqli, $sql3 );
        
        $difference = $account_balance - $total_valuation;
        
        $sql4 = "UPDATE balance SET Account_Balance = $difference WHERE ID = $id";
        $retval4 = mysqli_query( $mysqli, $sql4 );
    ?>
      
        <!doctype html>
        <html lang="en">
        <head>
	    <meta charset="utf-8" />
	    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	    <title>Splash | Edit Currency</title>
    

	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        </head>
        <body>
        <script>
            alert('Currency Valuation of INR <?php echo $total_valuation; ?> successfully set and changes recorded.');
            window.location = '../currency.php';
        </script>
        </body>
        </html>

    <?php } } ?>
