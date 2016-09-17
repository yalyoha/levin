<?php
include 'auth.php';

if ($data['username'] == 'admin') {
    session_start();
    $_SESSION['access'] = md5(uniqid());
    header("Location: /?access=$_SESSION[access]");
}
