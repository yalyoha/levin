<?php

define('DROOT', $_SERVER["DOCUMENT_ROOT"]);
require DROOT . '/admin/auth.php';

if ($data['username'] == 'admin')
    header("Location: /?edit");
