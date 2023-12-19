<?php
if(file_exists("../config.php")){
    require_once '../config.php';
}else {
    require_once 'config.php';
}
class News
{
    // property
    private $id;
    private $title;
    private $content;
    private $id_editor;
    private $id_category;
    private $imageName;
    private $imageTmp;
    // method
    public function __construct($title, $content, $id_editor, $id_category,$imageName, $imageTmp, $id="")
    {
        $this->title = $title;
        $this->content = $content;
        $this->id_editor = $id_editor;
        $this->id_category = $id_category;
        $this->imageName = $imageName;
        $this->imageTmp = $imageTmp;
        $this->id = $id;
    }
    public function addNews()
    {
        if(is_uploaded_file($this->imageTmp)){//means image is required
            // rename orignal name 
            $this->imageName = time() . $this->imageName;
            // move image to upload folder 
            if(move_uploaded_file($this->imageTmp, "../upload/".$this->imageName)){
                // get connection 
                global $dbh;
                // prepare query before execute 
                $sql = $dbh->prepare("INSERT INTO news(title, content, id_editor, id_category, main_image) VALUES('$this->title','$this->content', '$this->id_editor', '$this->id_category', '$this->imageName')");
                // execute sql query 
                if($sql->execute()){
                    return $dbh->lastInsertId();//ناخد اخر خبر مضاف لنتأكد من ربط الصور معه
                }else {
                    return false;
                }
            }else {
                return false;
            }
        }else {
            return false;
        }
    }
    public function updateNews()
    {
        if(is_uploaded_file($this->imageTmp)){//means image is required//
            // rename orignal name 
            $this->imageName = time() . $this->imageName;
            // move image to upload folder 
            if(move_uploaded_file($this->imageTmp, "../upload/".$this->imageName)){
                // get connection 
                global $dbh;
                // prepare query before execute 
                $sql = $dbh->prepare("UPDATE news SET title='$this->title', content = '$this->content', id_editor = '$this->id_editor', id_category = '$this->id_category', main_image ='$this->imageName' WHERE id='$this->id'");
                // execute sql query 
                if($sql->execute()){
                    return true;
                }else {
                    return false;
                }
            }else {
                return false;
            }
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
    
    public static function retreiveNoOfNewsByEditorId($id_editor)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT id FROM news WHERE id_editor='$id_editor'");
        // execute sql query 
        $sql->execute();
        return $sql->rowCount();
    }
    
    public static function retreiveNoOfNewsByCategoryId($id_category)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT id FROM news WHERE id_category='$id_category'");
        // execute sql query 
        $sql->execute();
        return $sql->rowCount();
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
    
    public static function retreiveAllNewsByDescOrder()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news order by id DESC");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
    public static function retreiveAllNewsByDescOrderById($id_category)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news where id_category='$id_category' order by id DESC");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
}
