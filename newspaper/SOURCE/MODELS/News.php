<?php
class News
{
    // property
    private $id;
    private $title;
    private $content;
    private $id_editor;
    private $id_category;
    // method
    public function __construct($title, $content, $id_editor, $id_category, $id="")
    {
        $this->title = $title;
        $this->content = $content;
        $this->id_editor = $id_editor;
        $this->id_category = $id_category;
        $this->id = $id;
    }
    public function addNews()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("INSERT INTO news(title, content, id_editor, id_category) VALUES('$this->title','$this->content', '$this->id_editor', '$this->id_category')");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public function updateNews()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("UPDATE news SET title='$this->title', content = '$this->content', id_editor = '$this->id_editor', id_category = '$this->id_category' WHERE id='$this->id'");
        // execute sql query 
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    
    public static function deleteNews($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM news WHERE id='$id'");
        // execute sql query
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
    public static function retreiveNews($id)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $news = $sql->fetch(PDO::FETCH_ASSOC);
        return $news;
    }
    public static function retreiveAllNews()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
}
