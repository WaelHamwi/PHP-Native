<?php
if(file_exists("../config.php")){
    require_once '../config.php';
}else {
    require_once 'config.php';
}
class Admin
{
    public static function sessionInit()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    public static function isLoggedIn()
    {
        self::sessionInit();//استدعاء تابع من كلاس ضمن نفس الصفحة
        //الا وهو التابع السابق
        if(isset($_SESSION['username'], $_SESSION['isLoggedIn'])){
            return true;
        }
        return false;
    }
    //In this specific case, there is no need to use an `else` statement because the `return` 
    //statement is used within the `if` condition. If the condition evaluates to `true`, 
    //the function will immediately exit and return `true`. If the condition evaluates to `false`, 
    //the function will continue to the next line, which is a `return false` statement. 
    //Therefore, there is no need to explicitly use an `else` statement.
    //Using an `else` statement in this case would not change the behavior or functionality of the code. 
    //It would only introduce unnecessary code and potentially make it more confusing or harder to read.
    public static function login($username, $password)
    {
        // get connection 
        global $dbh;
        // enctype your password 
        $password = md5($password);
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT id FROM admin WHERE username='$username'AND password='$password'");
        // execute sql query 
        $sql->execute();
        if($sql->rowCount() > 0){//اذا الحساب موجود اعمل سيشن
            // start sesssion 
            self::sessionInit();
            // create session 
            $_SESSION['username'] = $username;
            $_SESSION['isLoggedIn'] = true;
            return true;
        }else {
            return false;
        }
    }
    public static function logout()
    {
        if(self::isLoggedIn()){
             // unset session by session 
            unset($_SESSION['username']);
            unset($_SESSION['isLoggedIn']);
            return true;
        }else {
            return false;
        }
    }
}
