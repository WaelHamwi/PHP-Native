<?php
if(file_exists("../config.php")){
    require_once '../config.php';
}else {
    require_once 'config.php';
}
class NewsImage
{
    // property
    private $id_news;
    private $imageName;
    private $imageTmp;
    // method
    public function __construct($id_news, $imageName, $imageTmp="")
    {
        $this->imageName = $imageName;
        $this->imageTmp = $imageTmp;
        $this->id_news = $id_news;
    }
    public function addImage()
    {
        if(is_uploaded_file($this->imageTmp)){
            // rename orignal name 
            $this->imageName = time() . $this->imageName;
            // move image to upload folder 
            if(move_uploaded_file($this->imageTmp, "../upload/".$this->imageName)){
                // get connection 
                global $dbh;
                // prepare query before execute 
                $sql = $dbh->prepare("INSERT INTO news_image(id_news, image_name) VALUES('$this->id_news','$this->imageName')");
                //الادخال يكون في جدول خاص بالصور المرتبط مع جدول الخبر اساساً 
                //يتم ادخال الصور بالارتباط مع اخر خبر
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
    
    public function deleteImage()
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM news_image WHERE id_news='$this->id_news' AND image_name = '$this->imageName'");//  للتأكد من حذف صورة واحدة حسب رقم الخبر واسم الصورة 
        //في لارافيل نستخدم ال Cascade
        // execute sql query
        if($sql->execute()){
            return true;
        }else {
            return false;
        }
    }
   
    public static function retreiveAllImages($id_news)
    {
        // get connection 
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news_image WHERE id_news = '$id_news'");
        // execute sql query 
        $sql->execute();
        // fetch as associative array 
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
}
