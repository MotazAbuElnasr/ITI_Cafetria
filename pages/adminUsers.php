<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Display Users</title>
  <?php
  include_once 'classes/db.php';
  $db= new DbManager();
  ?>
</head>
<body>
  <?php 
    // add Admin Navbar 
    include 'tempelates/adminNavbar.php' ;
  ?>
  <table class="table">
    <thead class="thead-light">
      <tr>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Room</th>
      <th scope="col">Ext.</th>
      <th scope="col">Actions</th>
      </tr>
    </thead>
  <tbody>
    <?php
      $user= $db->getUsers();
      foreach($user as $row)
      {
        ?>
        <tr>
        <td> <?php echo $row['UName'];?> </td>
        <td> <img src="<?php echo $row['img'];?>" width="60px" height="60px"/> </td>
        <td> <?php echo $row['room'];?> </td>
        <td> <?php echo $row['ext'];?> </td>
        <td>
        <a href="#" class="btn btn-secondary">Edit</a>
        <a href="#" class="btn btn-danger">Delete</a>
        </td>
        </tr>
        <?php
      }
    ?>
  </tbody>
  </table>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
    document.getElementsByTagName("body")[0].style.background = "white"
  </script>    
</body>
</html>
