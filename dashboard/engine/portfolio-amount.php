<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: /login/index.php");
    exit;
}
else
{

                                        include('config.php');
                                        $id=$_SESSION['id'];
                                        
                                        $query1 = "SELECT * From wallet WHERE ID=$id";
                                        $sql1 = mysqli_query($mysqli, $query1);
        
                                        $query4 = "SELECT * From balance WHERE ID=$id";
                                        $sql4 = mysqli_query($mysqli, $query4);
                                        $row3 = mysqli_fetch_assoc($sql4);
                                        $sum = 0;
    
                                        while($row = mysqli_fetch_assoc($sql1)){ 
                                        $currency_id = $row['Currency_ID'];
                                                
                                        $query5 = "SELECT * From currency_extra WHERE Currency_ID=$currency_id";
                                        $sql5 = mysqli_query($mysqli, $query5);
                                        $row4 = mysqli_fetch_array($sql5);
                                            
                                        $inrvalue = $row4['Unit_Cost'] * $row['Currency_Balance'];
                                        $sum = $sum + $inrvalue;
                                       
                                
    }   
    
}
?>