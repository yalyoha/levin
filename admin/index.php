<?php
include 'auth.php';

if ($data['username'] == 'admin') header("Location: /?edit");
