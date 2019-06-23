<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Calcutta');
 
// variables used for jwt
$key = "splash_key";
$iss = "http://thesplash.me";
$aud = "http://thesplash.me";
$iat = 1356999524;
$nbf = 1357000000;
?>