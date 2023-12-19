<?php
require_once '../lib/admin.php';
if(!Admin::isLoggedIn()){
    // redirect to login page 
    header("Location: login.php");
    // for security 
    exit();
}