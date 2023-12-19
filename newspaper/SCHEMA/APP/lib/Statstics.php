<?php
if(file_exists("../config.php")){
    require_once '../config.php';
}else {
    require_once 'config.php';
}
class Statstics
{
    public static function retreiveNoOfItems($tableName)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT id FROM $tableName");
        // execute sql query 
        $sql->execute();
        return $sql->rowCount();
    }
}
