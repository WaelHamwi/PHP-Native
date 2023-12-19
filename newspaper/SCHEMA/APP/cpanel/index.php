<?php
require_once '../lib/Statstics.php';
require_once 'template/header.tpl';
require_once 'template/navbar.tpl';
?>
<div id="content" class="row">
    <h3>Statstics</h3>
    <table class="table table-striped table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">type</th>
                <th scope="col">value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>no of editor</th>
                <td><?php echo Statstics::retreiveNoOfItems("editor") ?></td>
            </tr>
            <tr>
                <td>no of categories</th>
                <td><?php echo Statstics::retreiveNoOfItems("category") ?></td>
            </tr>
            <tr>
                <td>no of news</th>
                <td><?php echo Statstics::retreiveNoOfItems("news") ?></td>
            </tr>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>