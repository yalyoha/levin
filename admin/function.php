<?php

require 'mysqlcong.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$admin = (isset($_GET['edit'])) ? true : false;

require 'functxt.php';
require 'funcimg.php'; 
