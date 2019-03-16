<?php
include_once 'classes/db.php';
$db= new DbManager();
$passwordError ="";
$error="";
$done=false;
if(! isset($_SESSION['userName'])){
    header('Location: /');
}

if(isset($_POST['password'])) {
    $valid=true;
    if (empty($_POST["password"])) {
        $passwordError = "Password is required";
        $valid = false;
    } else {
        $password = (md5($_POST['password']));
    }
    if (empty($_POST["confirm_password"])) {
        $confirm_passwordError = "confirm password is required";
        $valid = false;
    } else {
        $confirm_password = md5($_POST['confirm_password']);
    }
    if ($_POST["password"] != $_POST["confirm_password"]) {
        $valid = false;
        $passwordError .= 'password does not match';
    }
    $error .= empty($confirm_passwordError)?'': $confirm_passwordError."<br/>";
    $error .= empty($passwordError)?'': $passwordError."<br/>";
    if($valid){
        $done=true;
        $db->changePassword($_SESSION['userEmail'],$password);
    }
}
if($_SESSION['userName'] == "admin"){
    include_once 'tempelates/adminNavbar.php';
}
else{
    include_once 'tempelates/user-navbar/user-navbar.php';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forget password</title>
    <link rel = "stylesheet" href = "./assets/style/bodyImg.css" >

</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Forget password</h5>
                    <form class="form-signin" method="post" action="changePassword">
                        <div class="form-label-group text-center">
                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Password</label>
                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPassword5">Confirm Password</label>
                                <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password" name="confirm_password">
                            </div>
                            <h6 style="color: forestgreen"><? if ($done) {
                                echo "password has been changed";
                                }  ?></h6>
                            <input type="submit" class="btn btn-primary" value="Submit" name="submit">

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>