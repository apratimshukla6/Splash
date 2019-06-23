<?php
include("config.php");
$id=$_SESSION['id'];
$sql= "SELECT * FROM users WHERE ID=$id";
            
$retval = mysqli_query( $mysqli, $sql );
            
if(! $retval ) 
{
    die('Could not generate an API key: ' . mysqli_error($mysqli));
}
$row = mysqli_fetch_array($retval);
$n = 8; 
$token = bin2hex(random_bytes($n)); 
$extra = random_int(1000, 9999);
$apitoken = "splash-" . $token . "#" . $row["Wallet_ID"] . "#" . $extra;
?>