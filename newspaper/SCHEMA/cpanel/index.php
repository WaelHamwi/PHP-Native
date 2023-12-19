<?php
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
                <td>51</td>
            </tr>
            <tr>
                <td>no of categories</th>
                <td>33</td>
            </tr>
            <tr>
                <td>no of news</th>
                <td>44</td>
            </tr>
        </tbody>
    </table>
</div>
<?php
require_once 'template/footer.tpl';
?>