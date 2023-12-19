<?php
require_once '../lib/NewsImage.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
if(!isset($_GET['id'])){
    // redirect to all news page
    header("Location: editnews.php");
    // for security
    exit();
}
?>
<div id="content" class="row">
    <h3>Show all images</h3>
    <?php
        if(isset($_GET['action'], $_GET['id'], $_GET['image_name'])){
            // collect data 
            $action = $_GET['action']; // only delete image for this news
            $id = $_GET['id'];
            $image_name = $_GET['image_name'];
            switch($action){
                case 'deleteimage':
                    $newsImage = new NewsImage($id, $image_name);//orphan case??
                    if($newsImage->deleteImage()){
                        echo getSuccessMessage();
                    }else {
                        echo getFailMessage();
                    }
                    break;
                default:
                    echo getMessage("invalid action");
            }
        }
    ?>
    <div class="col" style="direction:rtl;">
        <a type="button" href="addimages.php?id=<?php echo $_GET['id']?>" class="btn btn-sm btn-dark  mb-2">add images</a>
    </div>
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">image</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // collect id 
                $id_news = $_GET['id'];
                // get all images for this news 
                $allImages = NewsImage::retreiveAllImages($id_news);
                if(is_array($allImages) && count($allImages)>0){
                    foreach ($allImages as $image):
                        echo '<tr>
                                <th scope="row">'.$id_news.'</th>
                                <td><img class="img-thumbnail" src="../upload/'.$image['image_name'].'" width="120" height="120"/></td>
                                <td><a href="?action=deleteimage&id='.$id_news.'&image_name='.$image['image_name'].'" class="btn btn-sm btn-danger">delete</a></td>
                            </tr>';
                    endforeach;
                }else {
                    echo '<tr>
                                <td colspan="3">no image found</td>
                            </tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>