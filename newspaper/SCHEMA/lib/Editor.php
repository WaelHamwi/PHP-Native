<?php
require_once '../config.php';
class Editor
{
    // property
    private $id;
    private $name;
    private $salary;
    // method
    public function __construct($name, $salary, $id="")
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->id = $id;
    }
    public function addEditor()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("INSERT INTO editor(name, salary) VALUES('$this->name','$this->salary')");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public function updateEditor()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("UPDATE editor SET name='$this->name', salary = '$this->salary' WHERE id='$this->id'");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    
    public static function deleteEditor($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM editor WHERE id='$id'");
        // execute sql query
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public static function retreiveEditor($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM editor WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $editor = $sql->fetch(PDO::FETCH_ASSOC);
        return $editor;
    }
    public static function retreiveAllEditors()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM editor");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allEditors = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allEditors;
    }
}
