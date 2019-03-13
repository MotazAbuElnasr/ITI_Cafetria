<?php
    include 'tempelates/adminNavbar.php' ;
    require_once('classes/db.php');
    include 'controllers/functions.php';
    if ($_SESSION['userName']=="")
    header('Location: /');
    ?>

    <section class = "container user-home">
<<<<<<< HEAD
     
=======

>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
    <!-- Latest Product -->
    <h2> Add to User </h2>
    <hr />
    <!-- <div class = "row latest-product"> -->
<<<<<<< HEAD
     
    <div class="dropdown-menu">    
    <?php 
     $users=getUsers();
     foreach ($users as $key => $userName) {
      echo "<button class='dropdown-item' id='$key' onclick='userFilter(event)' type='button'>$userName</button>";
    }
    ?>
  <!-- </div> -->

    </div>
=======

    <select class='custom-select form-control' name='userId'>";
        <option>Select User...</option>;
        <?php $userList = $db->userList() ;
        while ($user = $userList->fetch()) {
      ?>
        <option value=<?php echo $user['id']?> > <?php echo $user['name']?></option>";
      <?php  } ?>

    </select>
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a

     <hr />

        <!-- Our Product  -->
        <div class = "row">

        <div class = "col-sm-5">
           <?php include  'tempelates/order-form/order-form.php'?>
        </div>

        <div class="col-sm-7">
        <div class="row">
<<<<<<< HEAD
            
              <?php include  'tempelates/product/allProduct.php' ?>
      
           
=======

              <?php include  'tempelates/product/allProduct.php' ?>


>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
            </div>
        </div>

    </section>
<<<<<<< HEAD





    <script>
        document.getElementById("end").valueAsDate = new Date();
        let start = new Date();
        start.setDate(start.getDate() - 3)
        document.getElementById("start").valueAsDate = start;
        function dateFilter(){
          const startD = document.getElementById("start").value;
          const endD = document.getElementById("end").value;
          console.log(startD);
          console.log(endD);
          const accordionElement = document.getElementById("accordion");
          let xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                while (accordionElement.firstChild) {
                  accordionElement.removeChild(accordionElement.firstChild);
                }
                accordionElement.innerHTML = this.responseText;
                console.log("Recieve MSG");
              }
          };
          xmlhttp.open("GET", `/function?start=${startD}&end=${endD}`, true);
          xmlhttp.send();
          console.log("SEND") 
        }
        function userFilter(event){
          const idOfUser = event.target.id;
          const accordionElement = document.getElementById("accordion");
          let xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                while (accordionElement.firstChild) {
                  accordionElement.removeChild(accordionElement.firstChild);
                }
                accordionElement.innerHTML = this.responseText;
                console.log("Recieve MSG");
              }
          };
          xmlhttp.open("GET", `/function?UID=${idOfUser}`, true);
          xmlhttp.send();
        }
            // let request = $.ajax({
          //   url: "checks.php",
          //   method: "GET",
          //   data: { startD , endD},
          //   dataType: "html"
          // });
          
          // request.done(function( msg ) {
          //   console.log(msg);
          //   // $( "#log" ).html( msg );
          // });
          
          // request.fail(function( jqXHR, textStatus ) {
          //   alert( "Request failed: " + textStatus );
          // });
    </script>
=======
>>>>>>> f0f61a5400dd944ce90d274aba69e3ed8c34ff9a
