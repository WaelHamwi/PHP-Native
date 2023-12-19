<?php
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Add new News</h3>
    <div class="alert alert-success" role="alert">
        success
    </div>
    <div class="alert alert-danger" role="alert">
        fail
    </div>
    <form action="" method="POST">
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
                <option value="1">ali</option>
                <option value="2">kamal</option>
                <option value="3">mahmoud</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">belong to</label>
            <select class="form-select" name="id_category" aria-label="Default select example">
                <option value="1">sport</option>
                <option value="2">media</option>
                <option value="3">technology</option>
            </select>
        </div>
        <div class="col-auto">
            <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="addNews" value="add news" />
        </div>
    </form>
</div>
<?php
require_once 'template/footer.tpl';
?>