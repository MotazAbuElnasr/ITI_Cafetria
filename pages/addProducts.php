<?php
// include admin navbar
include 'tempelates/adminNavbar.php';
// Check if user is admin or not
if ($_SESSION['userName']!="admin")
header('Location: /');

// include database and object files
include_once 'classes/db.php';
include_once 'classes/product.php';
include_once 'classes/category.php';

// get database connection
// pass connection to objects
$product = new Product();
$category = new Category();
$db = new DbManager();


if(isset($_POST['addCat'])){
    if(!empty($_POST['catName'])){
      $db->addCat($_POST['catName']);
    }
  }

// set page headers
$page_title = 'Create Product';
?>
<body>
<!-- container -->
<div class="container">
<?php
echo "<div class='right-button-margin'>";
echo "<button class='btn btn-primary'><a style='color: white' href='admin-products'>Read Products</a></button>";
echo '</div>';
?>
<?php
// if the form was submitted
if (isset($_POST["addProduct"])) {
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    $image = !empty($_FILES['image']['name'])
        ? sha1_file($_FILES['image']['tmp_name']).'-'.basename($_FILES['image']['name']) : '';
    $product->image = $image;
    // create the product
    if ($product->create()) {
        echo "<div class='alert alert-success'>Product was created.</div>";
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $product->uploadPhoto();
    }

    // if unable to create the product, tell the user
    else {
        echo "<div class='alert alert-danger'>Unable to create product.</div>";
    }
}
?>
    <!-- HTML form for creating a product -->
    <form action="admin-addproduct" method="post" enctype="multipart/form-data" data-ajax='false'>
        <table class='table table-hover table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control' /></td>
            </tr>

            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control' /></td>
            </tr>

            <tr>
                <td>Category</td>
                <td>
                <div class='row'>
                    <?php
                    $stmt = $category->read();
                    ?>
                    <select class='form-control col-sm-9' name='category_id'>";
                        <!-- <option>Select category...</option>; -->
                        <?php

                        while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            extract($row_category);
                            echo "<option value='{$cat_id}'>{$name}</option>";
                        } ?>
                    </select>
                    <button 
                        onclick='edit(event)'
                        type='button'
                        class='btn btn-info col-sm-2' data-toggle='modal' data-target='#exampleModalCenter' name='submit'>
                            Add Cat
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
    <td>Photo</td>
    <td><input type="file" name="image" /></td>
</tr>

            <tr>
                <td></td>
                <td>
                    <button type='submit' name="addProduct" class='btn btn-primary'>Create</button>
                    <button type="reset" class='btn btn-primary'>Reset</button>
                </td>
            </tr>

        </table>
    </form>


    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add Categtory</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="admin-addproduct" method="post">
        <table class='table table-hover table-bordered'>
            <tr>
                <td>Name</td>
                <td><input type='text' id="catName" name='catName' class='form-control' /></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type='submit' name="addCat" class='btn btn-primary'>Add Category</button>
                </td>
            </tr>
            </table>
        </form>
            </div>
        </div>
    </div>
</div>