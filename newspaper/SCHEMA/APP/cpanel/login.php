<?php
require_once '../lib/Admin.php';
require_once '../helpers/output.php';
?>
<html>
    <head>
        <title>DASHBOARD</title>
        <link rel="styleSheet" type="text/css" href="template/css/bootstrap.min.css" />
        <link rel="styleSheet" type="text/css" href="template/css/base.css" />
    </head>
    <body>
        <div id="wrapper" class="container">
            <div id="header" class="row">
                <div class="logo col-md-7">
                    <h1>
                        <a href="#">Login area</a>
                    </h1>
                </div>
            </div>
            <div id="content" class="row">
                <?php
                    if(isset($_POST['login'])){
                        // collect data 
                        $username = $_POST['username']; 
                        $password = $_POST['password'];
                        // check data valid or not 
                        // check data valid or not 
                        if($username == null){
                            echo getNullMessage("username");
                        }else if($password == null){
                            echo getNullMessage("password");
                        }else{ 
                            if(Admin::login($username, $password)){
                                // redirect to home page 
                                header("Location: index.php");
                                exit();
                            }else {
                                echo getMessage("invalid login");
                            }
                        }
                        
                    }
                ?>
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">username</label>
                        <input type="text" name="username" class="form-control" id="exampleFormControlInput1" placeholder="enter news title">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">password</label>
                        <input type="password" name="password" class="form-control" id="exampleFormControlInput1" placeholder="enter news title">
                    </div>
                    <div class="col-auto">
                        <input  type="submit" class="btn btn-sm btn-danger mb-3 " name="login" value="login" />
                    </div>
                </form>
            </div>
        </div>
        <script src="template/js/bootstrap.min.js"></script>
        <script src="template/js/plugins.js"></script>
    </body>
</html>