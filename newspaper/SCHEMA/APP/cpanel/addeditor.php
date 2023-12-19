<?php
require_once '../lib/Editor.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Add new editor</h3>
    <?php 
        if(isset($_POST['addEditor'])){
            // collect data 
            $name = $_POST['name'];
            $salary = $_POST['salary'];
            // check data valid or not 
            if($name == null){
                echo getNullMessage("editor name");
            }else if($salary == null){
                echo getNullMessage("editor salary");
            }else if(!is_numeric($salary)){
                echo getNonNumericMessage("editor salary");
            }else {
                // operations and output 
                $editor = new Editor($name, $salary);
                if($editor->addEditor()){
                    echo getSuccessMessage();
                }else {
                    echo getFailMessage();
                }
                
            }
        }
    ?>
    <form action="addeditor.php" method="POST">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Editor name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="enter editor name">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Editor salary</label>
            <input type="text" name="salary" class="form-control" id="exampleFormControlInput1" placeholder="enter editor salary">
        </div>
        <div class="col-auto">
            <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="addEditor" value="add editor" />
        </div>
    </form>
</div>
<?php
require_once 'template/footer.tpl';
?>