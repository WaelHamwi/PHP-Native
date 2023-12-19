<?php
require_once '../lib/NewsImage.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Add images</h3>
    <?php
        if(isset($_POST['addImages'])){
            // collect data for news images
            $imagesNames = $_FILES['images']['name'];
            $imagesTmps = $_FILES['images']['tmp_name'];
            $id_news = $_POST['id'];
            for($index = 0; $index < count($imagesNames); $index++){
                $newsImage = new NewsImage($id_news, $imagesNames[$index], $imagesTmps[$index]);
                $newsImage->addImage();
            }
            // redirect to show all images for this news 
            header("Location: showimages.php?id=".$id_news);
        }
    ?>
    <form action="addimages.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formFileSm" class="form-label">news images</label>
            <input class="form-control form-control-sm" id="formFileSm" name="images[]" multiple="multiple" type="file">
        </div>
        <div class="mb-3">
            <input class="form-control form-control-sm" id="formFileSm" name="id" value="<?php echo $_GET['id']?>" type="hidden">
        </div>
        <div class="col-auto">
            <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="addImages" value="add images" />
        </div>
    </form>
</div>
<?php
require_once 'template/footer.tpl';
?>