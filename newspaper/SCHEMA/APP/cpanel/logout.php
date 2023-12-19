<?php
require_once '../lib/admin.php';
if(Admin::logout()){
    // redirect to login page 
    header("Location: login.php");
    // for security 
    exit();
}else {
    // redirect to login page 
    header("Location: index.php");
    // wait with me 
    sleep(5);
    // for security 
    exit();
}
    