<?php

// get ID of the product to be read
//$id = isset($_GET['p_id']) ? $_GET['p_id'] : die('ERROR: missing ID.');

// include database and object files
include_once 'classes/db.php';
include_once 'classes/product.php';
include_once 'classes/category.php';

// get database connection
// pass connection to objects
$product = new Product();
$category = new Category();
$db = new DbManager();

// set ID property of product to be read
$product->id = $id;

// read the details of product to be read
$product->readOne();
// set page headers
$page_title = 'Read One Product';
include_once 'layout_header.php';

// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Products";
    echo '</a>';
echo '</div>';
// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";

    echo '<tr>';
        echo '<td>Name</td>';
        echo "<td>{$product->name}</td>";
    echo '</tr>';

    echo '<tr>';
        echo '<td>Price</td>';
        echo "<td>&#36;{$product->price}</td>";
    echo '</tr>';

    echo '<tr>';
        echo '<td>Category</td>';
        echo '<td>';
            // display category name
            $cat->id = $product->cat_id;
            $category->readName();
            echo $category->name;
        echo '</td>';
    echo '</tr>';

echo '</table>';

// set footer
include_once 'layout_footer.php';
