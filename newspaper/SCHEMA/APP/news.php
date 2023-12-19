<?php
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <?php
        if(isset($_GET['id'])){
            // collect data
            $id = $_GET['id'];
            $news = News::retreiveNews($id);
            if($news){
                echo '<h3>'.$news['title'].'</h3>
                        <img src="upload/'.$news['main_image'].'" class="" alt="...">
                        <p>'.$news['content'].'</p>
                    ';
            }else {
                echo getMessage("no news found");
            }
        }else {
            // redirect to home page 
            header("Location: index.php");
            // for security
            exit();
        }
    ?>
    
</div>
<?php
require_once 'template/footer.tpl';
?>