<?php
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Show all news</h3>
    <?php
        if(isset($_GET['id'])){
            // collect data 
            $id = $_GET['id'];
            $allNews = News::retreiveAllNewsByDescOrderById($id);
            if(is_array($allNews) && count($allNews)>0){
                foreach ($allNews as $news):
                    echo '<div class="col-md-4">
                            <div class="card">
                                <img src="upload/'.$news['main_image'].'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">'.$news['title'].'</h5>
                                   <p class="card-text">'. substr($news['content'], 0, 50).'</p>
                                    <a href="news.php?id='.$news['id'].'" class="btn btn-primary">read more</a>
                                </div>
                            </div>
                        </div>';
                endforeach;
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