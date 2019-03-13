<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<link rel = "stylesheet" href = "./assets/style/bodyImg.css" >
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin" method = "POST">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
<<<<<<< HEAD
               
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
               
              </div>

            
=======
              </div>
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
              </div>
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="signIn">Sign in</button>
              <hr class="my-4">
              <a href ="pages/forgetPassword.php"> Forget Your Password ? </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<<<<<<< HEAD


<?php 
=======
<?php
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
require_once 'classes/db.php' ;
$db = new DbManager() ;

if (isset($_POST['signIn']))
{
<<<<<<< HEAD
    $email = $_POST['email'] ; 
    $password = $_POST['password'] ; 
    $userInfo = $db->login ($email , $password) ;
    $userName = $userInfo->fetchColumn() ; 
    if ($userName == ""){
        echo " Sorry but this is wrong email or password " ; 
    }
    else {
        if ($userName == "admin"){

            header('Location: /admin');
        }
        else 
        header('Location: /home');
        $_SESSION['userName'] = $userName ; 
    }
}
// 
// while ($product = $products->fetch()) {
?>
=======
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;
    $userInfo = $db->login ($email , $password) ;
    $userName = $userInfo->fetch() ;
    if ($userName['name'] == ""){
        echo " Sorry but this is wrong email or password " ;
    }
    else {
        if ($userName['name'] == "admin"){

            header('Location: /admin');
        }
        else
        header('Location: /home');
        $_SESSION['userName'] = $userName['name'] ;
        $_SESSION['userId'] = $userName['id'] ;
    }
}
//
// while ($product = $products->fetch()) {
?>

<!--top products / -->
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
