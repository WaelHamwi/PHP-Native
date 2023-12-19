<?php
    require_once 'auth.php';
?>
<html>
    <head>
        <title>session 3</title>
        <link rel="styleSheet" type="text/css" href="template/css/bootstrap.min.css" />
        <link rel="styleSheet" type="text/css" href="template/css/base.css" />
    </head>
    <body>
        <div id="wrapper" class="container">
            <div id="header" class="row">
                <div class="logo col-md-7">
                    <h1>
                        <a href="index.php">DASHBOARD</a>
                    </h1>
                </div>
                <div class="logout col-md-5">
                    <h6>
                        welcome mr/mrs <?php echo $_SESSION['username']; ?> to logout
                        <a href="logout.php">click here</a>
                    </h6>
                </div>
            </div>