<?php
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Add new category</h3>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Category name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="enter category name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">managed by</label>
            <select class="form-select" name="id_manager" aria-label="Default select example">
                <option value="1">ali</option>
                <option value="2">kamal</option>
                <option value="3">mahmoud</option>
            </select>
        </div>
        <div class="col-auto">
            <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="addCategory" value="add category" />
        </div>
    </form>
</div>
<?php
require_once 'template/footer.tpl';
?>