<?php
$id = $_SESSION['id'];
    
$sqlnote1 = "SELECT * From users WHERE ID=$id";
$retvalnote1 = mysqli_query( $mysqli, $sqlnote1 );
$rownote1 = mysqli_fetch_assoc($retvalnote1);

$wallet_id = $rownote1['Wallet_ID'];
    
$sqlnote2 = "SELECT * From initiate_trade WHERE (Initiator_Wallet_ID='$wallet_id' AND Trade_Status=0) OR (Acceptor_Wallet_ID='$wallet_id' AND Trade_Status=0)";
$retvalnote2 = mysqli_query( $mysqli, $sqlnote2 );
$rowcountnote=mysqli_num_rows($retvalnote2);
?>