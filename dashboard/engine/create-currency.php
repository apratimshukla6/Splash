<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: /login/index.php");
    exit;
}
else
{
    //change this config file linking.
    include('config.php');
    //storing the api-token and along with other currency related data in the database.
    $api_token = $_POST['api-token'];
    $id = $_SESSION['id'];
    $currency_name = mysqli_real_escape_string($mysqli,$_POST['currency-name']);
    $currency_amount = mysqli_real_escape_string($mysqli,$_POST['currency-amount']);
    $currency_desc = mysqli_real_escape_string($mysqli,$_POST['currency-desc']);
    $currency_type = mysqli_real_escape_string($mysqli,$_POST['currency-type']);
    
    $sql = "SELECT * From users WHERE ID=$id";
    
    $retval = mysqli_query( $mysqli, $sql );
    
    $row = mysqli_fetch_assoc($retval);
    
    $wallet_id = $row['Wallet_ID'];
            
    $sql1 = "INSERT INTO currency ". "(API_Token , ID , Currency_Name , Currency_Amount , Currency_Desc, Type) ". "VALUES('$api_token','$id','$currency_name','$currency_amount','$currency_desc','$currency_type')";
               
    $retval1 = mysqli_query( $mysqli, $sql1 );

    if(!$retval1) 
    {
        die('Could not create the currency: ' . mysqli_error($mysqli));
    }
            
    else
    {
        $_SESSION['token'] = $api_token;
        
        $sql2 = "SELECT * From currency WHERE API_Token='$api_token'";
        
        $retval2 = mysqli_query( $mysqli, $sql2 );
        
        $row1 = mysqli_fetch_assoc($retval2);
        
        $currency_id = $row1['Currency_ID'];
        
        $sql3 = "INSERT INTO wallet ". "(ID , Currency_ID , Currency_Balance , Wallet_ID) ". "VALUES('$id','$currency_id','$currency_amount','$wallet_id')";
        
        $retval3 = mysqli_query( $mysqli, $sql3 );
        
        $unit_cost = 0.00;
        $currency_symbol = "NIL";
        $currency_valuation = 0.00;
            
        $query4 = "INSERT INTO currency_extra ". "(Currency_ID , Unit_Cost , Currency_Symbol , Currency_Valuation) ". "VALUES('$currency_id','$unit_cost','$currency_symbol','$currency_valuation')";
        $sql4 = mysqli_query($mysqli, $query4);
        
        //change this depending upon the place where you want to redirect.
        header("location: /dashboard/currency-success.php");
    }
    
}
?>