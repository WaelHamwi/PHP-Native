<?php
require_once '../lib/Editor.php';
require_once '../lib/Category.php';
require_once '../lib/News.php';
require_once '../lib/NewsImage.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Add new News</h3>
    <?php
        if(isset($_POST['addNews'])){
            // collect data 
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id_editor = $_POST['id_editor'];
            $id_category = $_POST['id_category'];
            // collect data for main image
            $mainImageName = $_FILES['main_image']['name'];
            $mainImageTmp = $_FILES['main_image']['tmp_name'];
            // collect data for news images
            $imagesNames = $_FILES['images']['name'];
            $imagesTmps = $_FILES['images']['tmp_name'];
            if($title == null){
                echo getNullMessage("news title");
            }else if($content == null){
                echo getNullMessage("news content");
            }else if($id_editor == null){
                echo getNullMessage("news editor id");
            }else if(!is_numeric($id_editor)){
                echo getNonNumericMessage("news editor id");
            }else if($id_category == null){
                echo getNullMessage("news category id");
            }else if(!is_numeric($id_category)){
                echo getNonNumericMessage("news category id");
            }else {
                // operations and output 
                $news = new News($title, $content, $id_editor, $id_category, $mainImageName, $mainImageTmp);
                //بداية نتأكد من أن الخبر انضاف في الجدول الأول اللي هو جدول الأخبار ومن ثم ندخل في جدول الصور
                // لأنه يوجد علاقة ربط بينهما وجدول الصور معتمد على الادخال في جدول الأخبار
                if($id_news = $news->addNews()){//الادخال هنا يتم في جدول الأخبار على العلم انو عنا return $dbh->lastInsertId(); لحتى نضمن انو هاد اخر خبر انضاف ونضيف الصور المرتبطة به*****
                    for($index = 0; $index < count($imagesNames); $index++){
                        $newsImage = new NewsImage($id_news, $imagesNames[$index], $imagesTmps[$index]);
                        $newsImage->addImage();//تابع لاضافة الصور من كلاس خاص لاننا بالبداية نتأكد من ادخال الخبر مع الصورة الرئيسية ومن ثم نضيف مجموعة من الصور في جدول الصور
                    }//يوجد علاقة ربط بينا جدول الصور وجدول الأخبار والادخال هنا يتم بجدولين تزامناً//
                    echo getSuccessMessage();
                }else {
                    echo getFailMessage();
                }
            }
        }
    ?>
    <form action="addnews.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">News title</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="enter news title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">News content</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">written by</label>
            <select class="form-select" name="id_editor" aria-label="Default select example">
                <?php
                    $allEditors = Editor::retreiveAllEditors();
                    if(is_array($allEditors) && count($allEditors)>0){
                        foreach ($allEditors as $editor):
                            echo '<option value="'.$editor['id'].'">'.$editor['name'].'</option>';
                        endforeach;
                    }else {
                        echo '<option value="">no editor found</option>';
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">belong to</label>
            <select class="form-select" name="id_category" aria-label="Default select example">
                <?php
                    $allCategories = Category::retreiveAllCategories();
                    if(is_array($allCategories) && count($allCategories)>0){
                        foreach ($allCategories as $category):
                            echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                        endforeach;
                    }else {
                        echo '<option value="">no category found</option>';
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">main image</label>
            <input class="form-control form-control-sm" id="formFileSm" name="main_image" type="file">
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">news images</label>
            <input class="form-control form-control-sm" id="formFileSm" name="images[]" multiple="multiple" type="file">
        </div>
        <div class="col-auto">
            <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="addNews" value="add news" />
        </div>
    </form>
</div>
<?php
require_once 'template/footer.tpl';
?>