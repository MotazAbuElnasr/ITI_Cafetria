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
    $confirm_passwordError ="";
    $imgError ="";
    $roomError = "";
    $valid = true;
    // uploading images
    // $target_dir = "assets/images/";
    // $target_file = $target_dir . basename($_FILES["img"]);
    // $uploadOk = 1;
    // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST['submit'])){
        if (empty($_POST["name"])) {
            $valid = false;
        } else {
            $name = checkValid($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailError = "Email is required";
            $valid = false;
        } else {
            $email = checkValid($_POST["email"]); 
        }

        if (empty($_POST["password"])) {
            $passwordError = "Password is required";
            $valid = false;
        } else {
            $password = checkValid(md5($_POST['password']));
        }

        if (empty($_POST["confirm_password"])) {
            $confirm_passwordError = "confirm password is required";
            $valid = false;
        } else {
            $confirm_password = checkValid(md5($_POST['confirm_password']));
        }

        if ($_POST["password"] == $_POST["confirm_password"]) {
            echo 'password matches';
        }
        else {
            $valid = false;
            echo 'password does not match';
        }

        if (empty($_POST["img"])) {
            $imgError = "Image is required";
            $valid = false;
        } else {
            $x=rand(1000 , 10000000);
            $img_name = $_FILES['img']['name'];
            $img_type = $_FILES['img']['type'];
            $img_size = $_FILES['img']['size'];
            $img_tmp_name = $_FILES['img']['tmp_name'];
            $img_store = "./assets/images/".$img_name.strval($x);
            if(move_uploaded_file($img_tmp_name , $img_store)){
                echo "image uploaded successfully";
            }else{
                echo "error in uploading images";
            }    
        }
        
        // $check = getimagesize($_FILES["img"]);
        // if($check !== false) {
        //     echo "File is an image - " . $check["mime"] . ".";
        //     $uploadOk = 1;
        // } else {
        //     echo "File is not an image.";
        //     $uploadOk = 0;
        // }

        if (empty($_POST["room"])) {
            $roomError = "Room is required";
            $valid = false;
        } else {
            $room = checkValid($_POST['room']);
        }
        
        if($valid) 
        $db->insertUser($name,$email,$password,$img_store,$room);
    }
    function checkValid($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    // if ($_FILES["img"]["size"] > 500000) {
    //     echo "Sorry, your image is too large.";
    //     $uploadOk = 0;
    // }
    // Allow certain file formats
    // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    // && $imageFileType != "gif" ) {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }
    // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk == 0) {
    //     echo "Sorry, your image was not uploaded.";
    // if everything is ok, try to upload file
    // } else {
    //     if (move_uploaded_file($_FILES["img"], $target_file)) {
    //         echo "The file ". basename( $_FILES["img"]). " has been uploaded.";
    //     } else {
    //         echo "Sorry, there was an error uploading your image.";
    //     }
    // }
    ?>
</head>
<body>
 <?php 
   // add Admin Navbar 
   include 'tempelates/adminNavbar.php' ;
 ?>
<div class="container-fluid">
    <h1>Add User</h1>
    <form method="post" action = "admin-adduser" enctype="multipart/form-data">
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
                <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password" name="confirm_password">
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
                <label>Profile Picture</label>
                <input type="file" class="form-control-file" name="img">
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
<script>
    document.getElementsByTagName("body")[0].style.background = "white"
  </script> 
</body>
</html>
