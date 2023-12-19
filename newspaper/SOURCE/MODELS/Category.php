<?php
class Category
{
    // property
    private $id;
    private $name;
    private $id_manager;
    // method
    public function __construct($name, $id_manager, $id="")
    {
        $this->name = $name;
        $this->id_manager = $id_manager;
        $this->id = $id;
    }
    public function addCategory()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("INSERT INTO category(name, id_manager) VALUES('$this->name','$this->id_manager')");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public function updateCategory()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("UPDATE category SET name='$this->name', id_manager = '$this->id_manager' WHERE id='$this->id'");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    
    public static function deleteCategory($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM category WHERE id='$id'");
        // execute sql query
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public static function retreiveCategory($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM category WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $category = $sql->fetch(PDO::FETCH_ASSOC);
        return $category;
    }
    public static function retreiveAllCategories()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM category");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allCategories = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allCategories;
    }
}
