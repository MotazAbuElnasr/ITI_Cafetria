<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add User</title>
    <?php
    include_once 'classes/db.php';
    $db= new DbManager();
    $nameError ="";
    $emailError ="";
    $passwordError ="";
    $imgError ="";
    $roomError = "";
     var_dump($_POST);
    if(isset($_POST['submit'])){
        if (empty($_POST["name"])) {
         } else {
            $name = checkValid($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailError = "Email is required";
        } else {
            $email = checkValid($_POST["email"]);
        }

        if (empty($_POST["password"])) {
            $passwordError = "Password is required";
        } else {
            $password = checkValid(md5($_POST['password']));
        }

        if (empty($_POST["img"])) {
            $imgError = "Image is required";
        } else {
            $img = checkValid($_POST['img']);
        }

        if (empty($_POST["room"])) {
            $roomError = "Room is required";
        } else {
            $room = checkValid($_POST['room']);
        }

        $db->insertUser($name,$email,$password,$img,$room);
        // header('location: login.php');
    }
    function checkValid($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Manual Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Checks</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <h1>Add User</h1>
    <form method="post" action = "adduser">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputName4">Name</label>
                <input type="text" class="form-control" id="inputName4" placeholder="Name" name="name">
            </div>
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="password">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword5">Confirm Password</label>
                <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password" name="confirm_passwrod">
            </div>
            <div class="col-md-6">
                <label>Room Number</label><br/>
                <select id = "selection" name="room">
                    <?php
                    $stmt= $db->getRooms();
                    while($room = $stmt->fetch(PDO::FETCH_ASSOC))
                    {
                        extract($room)
                        ?>
                        <option class="dropdown-item" value="<?php echo $room_num?>"> <?php echo $room_num?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="pic">Profile Picture</label>
                <input type="file" class="form-control-file" id="pic" name="img">
            </div>
        </div><br/>
        <div class="form-group col-md-6">
            <input type="submit" class="btn btn-primary col-md-2" name="submit" value="Save"/>
            <input type="reset" class="btn btn-primary col-md-2" value="Reset"/>
        </div>
    </form>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
