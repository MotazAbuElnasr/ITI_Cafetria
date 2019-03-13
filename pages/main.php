<?php

require_once 'classes/db.php';
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// set number of records per page
$records_per_page = 5;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// include database and object files
include_once 'classes/product.php';
include_once 'classes/category.php';
require_once 'classes/db.php';

// instantiate database and objects

$db = new DbManager();
$product = new Product();
$category = new Category();

// query products
$stmt = $db->readProducts($from_record_num, $records_per_page);
$num = $stmt->rowCount(); // set page header
$page_title = 'Read Products';
include 'tempelates/userHeader.php';
include 'tempelates/user-navbar/user-navbar.php';
echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-default pull-right'>Create Product</a>";
echo '</div>';
// display the products if there are any
if ($num > 0) {
    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo '<tr>';
    echo '<th>Product</th>';
    echo '<th>Price</th>';
    echo '<th>Category</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo '<tr>';
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo '<td>';
        $category->id = $cat_id;
        $category->readName();
        echo $category->name;
        echo '</td>';

        echo '<td>';
        // read, edit and delete buttons
        echo "<a href='read_one.php?id={$p_id}' class='btn btn-primary left-margin'>
    <span class='glyphicon glyphicon-list'></span> Read
</a>
 
<a href='update_product.php?id={$p_id}' class='btn btn-info left-margin'>
    <span class='glyphicon glyphicon-edit'></span> Edit
</a>
 
<a delete-id='{$p_id}' class='btn btn-danger delete-object'>
    <span class='glyphicon glyphicon-remove'></span> Delete
</a>";
        echo '</td>';

        echo '</tr>';
    }

    echo '</table>';
    // the page where this paging is used
    $page_url = 'main.php?';

    // count all products in the database to calculate total pages
    $total_rows = $db->countAll();

    // paging buttons here
    include_once 'paging.php';

// paging buttons will be here
}

// tell the user there are no products
else {
    echo "<div class='alert alert-info'>No products found.</div>";
}

// set page footer
include 'tempelates/footer.php';
