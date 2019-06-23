<?php

include('config.php');
$currency_names=[];
$query1 = "SELECT * From currency";
$sql1 = mysqli_query($mysqli, $query1);
while($row = mysqli_fetch_array($sql1)){
    $cname=$row['Currency_Name'];
    $cid=$row['Currency_ID'];
    $currency_names[$cid]=$cname;
}


// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";
// $id is the currency id,$name is the currency name in the associative array.
// lookup all hints from array if $q is different from "" 
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($currency_names as $id=>$name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = "<a style='color: DodgerBlue;' "."onmouseover=".'"this.style.color = '."'DarkBlue'".'" '."onmouseout=".'"this.style.color = '."'DodgerBlue'".'" '."href='currency-details.php?cid=".$id."'>".$name."</a>";
            } else {
                $hint .= ", "."<a style='color: DodgerBlue;' "."onmouseover=".'"this.style.color = '."'DarkBlue'".'" '."onmouseout=".'"this.style.color = '."'DodgerBlue'".'" '."href='currency-details.php?cid=".$id."'>".$name."</a>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values 
echo $hint === "" ? "No Suggestions." : $hint;
?>