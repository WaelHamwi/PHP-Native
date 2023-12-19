<?php
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Show all editors</h3>
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">delete</th>
                <th scope="col">edit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>ali</td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-danger">delete</a></td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-success">edit</a></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>eman</td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-danger">delete</a></td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-success">edit</a></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>bassem</td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-danger">delete</a></td>
                <td><a href="?action=delete&id=" class="btn btn-sm btn-success">edit</a></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>