<?php

$servername = 'localhost';
$username = 'root';

$dbname = 'riya';

$conn = new mysqli($servername,$username,'',$dbname);


if(!$conn){
    die("not connect");
}
//echo"connected";
