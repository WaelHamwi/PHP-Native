<?php
require_once '../lib/Editor.php';
require_once '../lib/Category.php';
require_once '../lib/News.php';
require_once '../helpers/output.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Show all editors</h3>
    <?php
        if(isset($_GET['action'], $_GET['id'])){
            // collect data 
            $action = $_GET['action']; // may be delete or edit
            $id = $_GET['id'];
            switch ($action){
                case 'delete':
                    if(Editor::deleteEditor($id)){
                        echo getSuccessMessage();
                    }else {
                        echo getFailMessage();
                    }
                    break;
                case 'edit':
                    $editor = Editor::retreiveEditor($id);
                    if($editor){
                        echo '<form action="editeditor.php" method="POST">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Editor name</label>
                                    <input type="text" name="name" value="'.$editor['name'].'" class="form-control" id="exampleFormControlInput1" placeholder="enter editor name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Editor salary</label>
                                    <input type="text" name="salary" value="'.$editor['salary'].'" class="form-control" id="exampleFormControlInput1" placeholder="enter editor salary">
                                    <input type="hidden" name="id" value="'.$editor['id'].'" class="form-control" id="exampleFormControlInput1" placeholder="enter editor salary">
                                </div>
                                <div class="col-auto">
                                    <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="updateEditor" value="update editor" />
                                </div>
                            </form>';
                    }else {
                        echo getMessage("no editor found");
                    }
                    break;
                default:
                    echo getMessage("invalid action");
            }
        }
        
        if(isset($_POST['updateEditor'])){
            // collect data 
            $name = $_POST['name'];
            $salary = $_POST['salary'];
            $id = $_POST['id'];
            // check data valid or not 
            if($name == null){
                echo getNullMessage("editor name");
            }else if($salary == null){
                echo getNullMessage("editor salary");
            }else if(!is_numeric($salary)){
                echo getNonNumericMessage("editor salary");
            }else {
                // operations and output 
                $editor = new Editor($name, $salary, $id);
                if($editor->updateEditor()){
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
                <th scope="col">name</th>
                <th scope="col">manager in</th>
                <th scope="col">no of news</th>
                <th scope="col">delete</th>
                <th scope="col">edit</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $allEditors = Editor::retreiveAllEditors();
                if(is_array($allEditors) && count($allEditors)>0){
                    foreach ($allEditors as $editor):
                        echo '<tr>
                                <th scope="row">'.$editor['id'].'</th>
                                <td>'.$editor['name'].'</td>
                                <td>'. implode(', ', Category::retreiveAllCategoriesByManagerId($editor['id'])).'</td>
                                <td>'.News::retreiveNoOfNewsByEditorId($editor['id']).'</td>
                                <td><a href="?action=delete&id='.$editor['id'].'" class="btn btn-sm btn-danger">delete</a></td>
                                <td><a href="?action=edit&id='.$editor['id'].'" class="btn btn-sm btn-success">edit</a></td>
                            </tr>';
                    endforeach;
                }else {
                    echo '<tr>
                            <td colspan="4">no editor found</td>
                        </tr>';
                }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>