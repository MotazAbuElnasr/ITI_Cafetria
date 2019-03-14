<?php
// include admin navbar
include 'tempelates/adminNavbar.php';

// include database and object files
include_once 'classes/db.php';
include_once 'classes/product.php';
include_once 'classes/category.php';

// get database connection
// pass connection to objects
$product = new Product();
$category = new Category();
$db = new DbManager();

// set page headers
$page_title = 'Create Product';
include 'tempelates/layout_header.php';
?>
<body>
<!-- container -->
<div class="container">
    <!-- <   ?php
    // show page header
    // echo "<div class='page-header'>
    //             <h1>{$page_title}</h1>
    //         </div>";
    ?> -->
<?php
echo "<div class='right-button-margin'>";
echo "<a href='admin-products' class='btn btn-default pull-right'>Read Products</a>";
echo '</div>';
?>
<?php
// if the form was submitted
if ($_POST) {
    // set product property values
    $product->name = $_POST['name'];
    $product->price = $_POST['price'];
    $product->category_id = $_POST['category_id'];
    $image = !empty($_FILES['image']['name'])
        ? sha1_file($_FILES['image']['tmp_name']).'-'.basename($_FILES['image']['name']) : '';
    $product->image = $image;
    // create the product
    var_dump($_POST);
    var_dump($_FILES);
    if ($product->create()) {
        echo "<div class='alert alert-success'>Product was created.</div>";
        // try to upload the submitted file
        // uploadPhoto() method will return an error message, if any.
        echo $product->uploadPhoto();
        echo 'HELLO WORLD';
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
                    <?php
                    $stmt = $category->read();
                    ?>
                    <select class='form-control' name='category_id'>";
                        <option>Select category...</option>;
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
                    <button type='submit' class='btn btn-primary'>Create</button>
                    <button type="reset" class='btn btn-primary'>Reset</button>
                </td>
            </tr>

        </table>
    </form>


