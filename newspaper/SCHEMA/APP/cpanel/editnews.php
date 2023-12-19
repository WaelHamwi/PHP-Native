<?php
require_once '../lib/Editor.php';
require_once '../lib/Category.php';
require_once '../lib/News.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Show all news</h3>
    <?php
        if(isset($_GET['action'], $_GET['id'])){
            // collect data 
            $action = $_GET['action']; // may be delete or edit
            $id = $_GET['id'];
            switch($action){
                case 'delete':
                    if(News::deleteNews($id)){
                        echo getSuccessMessage();
                    }else {
                        echo getFailMessage();
                    }
                    break;
                case 'edit':
                    $news = News::retreiveNews($id);
                    if($news){
                       echo '<form action="editnews.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">News title</label>
                                    <input type="text" name="title" value="'.$news['title'].'" class="form-control" id="exampleFormControlInput1" placeholder="enter news title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">News content</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3">
                                    '.$news['content'].'
                                    </textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">written by</label>
                                    <select class="form-select" name="id_editor" aria-label="Default select example">';
                                            $allEditors = Editor::retreiveAllEditors();
                                            if(is_array($allEditors) && count($allEditors)>0){
                                                foreach ($allEditors as $editor):
                                                    if($editor['id'] == $news['id_editor']){
                                                        echo '<option selected="selected" value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                    }else {
                                                        echo '<option value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                    }
                                                endforeach;
                                            }else {
                                                echo '<option value="">no editor found</option>';
                                            }
                                   echo' </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">belong to</label>
                                    <select class="form-select" name="id_category" aria-label="Default select example">';
                                            $allCategories = Category::retreiveAllCategories();
                                            if(is_array($allCategories) && count($allCategories)>0){
                                                foreach ($allCategories as $category):
                                                    if($category['id'] == $news['id_category']){
                                                        echo '<option  selected="selected" value="'.$category['id'].'">'.$category['name'].'</option>';
                                                    }else {
                                                        echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                                    }
                                                endforeach;
                                            }else {
                                                echo '<option value="">no category found</option>';
                                            }
                                    echo'</select>
                                </div>
                                <div class="mb-3">
                                    <label for="formFileSm" class="form-label">news images</label>
                                    <img class="img-thumbnail" src="../upload/'.$news['main_image'].'" width="60" height="60"/>
                                    <input class="form-control form-control-sm" id="formFileSm" name="main_image" multiple="multiple" type="file">
                                </div>
                                <div class="col-auto">
                                <input type="hidden" name="id" value="'.$news['id'].'" class="form-control" id="exampleFormControlInput1" placeholder="enter news title">
                                    <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="updateNews" value="update news" />
                                </div>
                            </form>'; 
                    }else {
                        echo getMessage("no news found");
                    }
                    break;
                default:
                    echo getMessage("invalid action");
            }
        }
        
        if(isset($_POST['updateNews'])){
            // collect data 
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id_editor = $_POST['id_editor'];
            $id_category = $_POST['id_category'];
            $id = $_POST['id'];
            // collect data for main image
            $mainImageName = $_FILES['main_image']['name'];
            $mainImageTmp = $_FILES['main_image']['tmp_name'];
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
                $news = new News($title, $content, $id_editor, $id_category, $mainImageName, $mainImageTmp, $id);
                if($news->updateNews()){
                    echo getSuccessMessage();
                }else {
                    echo getFailMessage();
                }
            }
        }
        
    ?>
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">main image</th>
                <th scope="col">written by</th>
                <th scope="col">belong to</th>
                <th scope="col">delete</th>
                <th scope="col">edit</th>
                <th scope="col">show images</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $allNews = News::retreiveAllNews();
                if(is_array($allNews) && count($allNews)>0){
                    foreach ($allNews as $news):
                        echo '<tr>
                                <th scope="row">'.$news['id'].'</th>
                                <td>'.$news['title'].'</td>
                                <td><img class="img-thumbnail" src="../upload/'.$news['main_image'].'" width="60" height="60"/></td>
                                <td>'.Editor::retreiveEditorName($news['id_editor']).'</td>
                                <td>'.Category::retreiveCategoryName($news['id_category']).'</td>
                                <td><a href="?action=delete&id='.$news['id'].'" class="btn btn-sm btn-danger">delete</a></td>
                                <td><a href="?action=edit&id='.$news['id'].'" class="btn btn-sm btn-success">edit</a></td>
                                <td><a href="showimages.php?id='.$news['id'].'" class="btn btn-sm btn-info">show images</a></td>
                            </tr>';
                    endforeach;
                }else {
                    echo '<tr>
                            <td colspan="4">no news found</td>
                        </tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>