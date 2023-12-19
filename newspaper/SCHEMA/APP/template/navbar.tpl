<div id="navbar" class="row">
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">home</a>
                    </li>
                    <?php
                        $allCategories = Category::retreiveAllCategories();
                        if(is_array($allCategories) && count($allCategories)>0){
                            foreach ($allCategories as $category):
                                echo '<li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="category.php?id='.$category['id'].'">'.$category['name'].'</a>
                                    </li>';
                            endforeach;
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>