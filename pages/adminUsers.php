<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Display Users</title>
    <?php
  include_once 'classes/db.php';
  $db= new DbManager();
  $nameError ="";
  $imgError ="";
  $roomError = "";
  if(isset($_POST['name'])){
    $id=$_POST["id"];
    $name=$_POST["name"];
    $room=$_POST["room"];
    $img_store="";
    $valid=true;
    if (empty($_POST["name"])) {
        $valid = false;
    } else {
        $name = checkValid($_POST["name"]);
    }
    if(isset($_FILES['img'])) {
      $x=rand(1000 , 10000000);
      $img_name = $_FILES['img']['name'];
      $img_type = $_FILES['img']['type'];
      $img_size = $_FILES['img']['size'];
      $img_tmp_name = $_FILES['img']['tmp_name'];
      $img_store = "./assets/images/".$img_name.strval($x);
    }
    if($valid)
    $db->updateUser($name,$img_store,$room,$id);
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
    <?php 
    // add Admin Navbar 
    include 'tempelates/adminNavbar.php' ;
  ?>
    <button type="button" class="btn btn-primary"><a href="admin-adduser">Add User</a></button>
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
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        var_dump($page);
        // set number of records per page
        $records_per_page = 5;
        var_dump($records_per_page);
        // calculate for the query LIMIT clause
        $from_record_num = $page > 0 ? ($records_per_page * $page) - $records_per_page : 0;
        var_dump($from_record_num);
        $user= $db->getUsers($from_record_num, $records_per_page);
        // var_dump($user);
        $total_rows = $user->rowCount();
        foreach($user as $row)
        {
        ?>
        <tr>
        <td> <?php echo $row['UName'];?> </td>
        <td> <img src="<?php echo $row['img'];?>" width="60px" height="60px"/> </td>
        <td> <?php echo $row['room'];?> </td>
        <td> <?php echo $row['ext'];?> </td>
        <td>
        <!-- Button trigger modal -->
          <button data-uname = "<?php echo $row['UName'];?>" 
          data-room = "<?php echo $row['room'];?>"
          data-img = "<?php echo $row['img'];?>"
          data-uid = "<?php echo $row['UID'];?>"
          onclick="edit(event)"
           type="button" 
           class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter" name="submit">
            Edit
          </button>
          <!-- Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalCenterTitle">Edit User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="admin-users" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-12">
                          <input type="hidden" id="UID" class="form-control" name="id">
                      </div>

                        <div class="form-group col-md-12">
                            <label for="inputName4">Name</label>
                            <input type="text" id="Uname" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Profile Picture</label>
                            <img src="" id="Img" width="60px" height="60px" />
                            <input type="file" class="form-control-file" name="img">
                        </div>
                        <div class="col-md-12">
                            <label>Room Number</label><br />
                            <select id="selection" name="room">
                            <?php
                              $stmt= $db->getRooms();
                              while($room = $stmt->fetch(PDO::FETCH_ASSOC))
                              {
                                extract($room)
                                ?>
                                <option class="dropdown-item" value="<?php echo $room_num?>">
                                    <?php echo $room_num?> </option>
                                <?php
                              }
                            ?>
                            </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-secondary" value="Edit" />
                            <!-- <button type="button" class="btn btn-secondary">Edit</button> -->
                            <button type="button" class="btn btn-danger"
                                data-dismiss="modal">Cancel</button>
                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button data-uid="<?php echo $row['UID'];?>" onclick="deleteUser(event)" type="button"
                        class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <form method="POST" action="/deleteUser">
                                <input type="hidden" name="id" id="deletedUser" />
                                <div class="modal-body">
                                    are you sure you want to delete this user?
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-danger" value="Delete" />
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php
      }
    ?>
        </tbody>
    </table>
    <?php
    
    include_once 'pages/userPagination.php';
    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
    document.getElementsByTagName("body")[0].style.background = "white"
    const edit = (event) => {
        const id = event.target.dataset.uid;
        const name = event.target.dataset.uname;
        const room = event.target.dataset.room;
        const img = event.target.dataset.img;
        document.getElementById("UID").value = id;
        document.getElementById("Uname").value = name;
        document.getElementById("Img").src = img;
        // console.log(event.target.dataset)
    }
    const deleteUser = (event) => {
        const id = event.target.dataset.uid;
        console.log(id);
        document.getElementById("deletedUser").value = id;
    }
    </script>
</body>

</html>