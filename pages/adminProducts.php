<?php
// Check if user is admin or not
if ($_SESSION['userName']!="admin")
header('Location: /');

require_once 'classes/db.php';
// $from_record_num = $page > 0 ? ($page - 1) * $records_per_page : 0;
// include database and object files
include_once 'classes/product.php';
include_once 'classes/category.php';

// instantiate database and objects
$db = new DbManager();
$product = new Product();
$category = new Category();

if(isset($_POST['updateProduct'])){
    $product->id = $_POST['pid'];
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    $image = !empty($_FILES['image']['name'])
        ? sha1_file($_FILES['image']['tmp_name']).'-'.basename($_FILES['image']['name']) : '';
    $product->image = $image;
    // create the product
    if ($product->update()) {
        echo "<div class='alert alert-success'>Product Updated.</div>";
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $product->uploadPhoto();
    }

    // if unable to create the product, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to update product.</div>";
    }
}
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// set number of records per page
$records_per_page = 5;
// calculate for the query LIMIT clause
$from_record_num = $page > 0 ? ($records_per_page * $page) - $records_per_page : 0;


// query products
$stmt = $db->readProducts($from_record_num, $records_per_page);
$num = $stmt->rowCount(); // set page header
$page_title = 'Read Products';
include 'tempelates/adminNavbar.php';
echo "<div class='right-button-margin'>";
    echo "<a href='admin-addproduct' class='mb-4 btn btn-default pull-right'>Create Product</a>";
echo '</div>';
// display the products if there are any
if ($num > 0) {
    echo "<table class='table table-hover table-bordered'>";
    echo '<tr>';
    echo '<th>Product</th>';
    echo '<th>Price</th>';
    echo '<th>Category</th>';
    echo '<th>image</th>';
    echo '<th>Actions</th>';
    echo '</tr>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $category->id = $cat_id;
        $cat=$category->readName($category->id);
        echo '<tr>';
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo '<td>';
        
        echo $cat;
        echo '</td>';
        echo "<td><img style='width:50px;height:50px' src='{$img}' /></td>";
        echo '<td>';
        // read, edit and delete buttons
        echo (($status=='available')?
        "<button id='$p_id' onclick='changeStatus(event)' class='btn btn-success left-margin'>Available</button>":
        "<button id='$p_id' onclick='changeStatus(event)' class=' btn btn-warning left-margin'>Unavailable</button>");

        echo  "
         <button 
         data-uname = '$name'
          data-price = '$price'
          data-category = '$cat'
          data-pid = '$p_id'
          data-img = '$img'
          onclick='edit(event)'
           type='button'
           class='btn btn-info' data-toggle='modal' data-target='#exampleModalCenter' name='submit'>
            Edit
          </button>
            <a delete-id='{$p_id}' class='btn btn-danger delete-object'>
                <span class='glyphicon glyphicon-remove'></span> Delete
            </a>";
        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';

    
    // the page where this paging is used
    // count all products in the database to calculate total pages
    $total_rows = $db->countAll();
    // paging buttons here
    include_once 'pages/paging.php';
// paging buttons will be here
}
// tell the user there are no products
else {
    echo "<div class='alert alert-info'>No products found.</div>";
}
// set page footer
?>


 
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
        <form action="admin-products" method="post" enctype="multipart/form-data">
        <table class='table table-hover table-bordered'>
            <tr>
                                <td>Name</td>
                                <td><input type='text' id="Pname" name='name' class='form-control' /></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><input type='text' id="Pprice" name='price' class='form-control' /></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <?php
                                    $stmt = $category->read();
                                    ?>
                                    <select class='form-control' name='category_id'>";
                                        <!-- <option>Select category...</option>; -->
                                        <?php

                                        while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                            extract($row_category);
                                            echo "<option value='{$cat_id}'>{$name}</option>";
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                    <td>Photo</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type='hidden' id="pid" name='pid'/>
                                    <button type='submit' name="updateProduct" class='btn btn-primary'>Update</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
<script>

function edit(event){
    // data-uname = '$name'
    //       data-price = '$price'
    //       data-category = '$cat'
    //       data-pid = '$p_id'
    //       data-img = '$img'
    const pid = event.target.dataset.pid;
    const pname = event.target.dataset.uname;
    const pprice = event.target.dataset.price;
    document.getElementById("Pname").value = pname;
    document.getElementById("Pprice").value = pprice;
    document.getElementById("pid").value = pid;
}
function changeStatus(event){
    let status = event.target.innerHTML;
    const id = event.target.id;
    if(status=='Available')
      status="Unavailable";
    else status="Available";
    status=status.toLowerCase();
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if(this.responseText=='unavailable'){
                event.target.innerHTML='Unavailable';
                event.target.classList.remove('btn-success');
                event.target.classList.add('btn-warning');
            }
            else if(this.responseText=='available'){
                event.target.innerHTML='Available';
                event.target.classList.remove('btn-warning');
                event.target.classList.add('btn-success');
            }
        }
    };
    console.log(status);
    xmlhttp.open("GET", `/function?id=${id}&status=${status}`, true);
    xmlhttp.send();
}
</script>
