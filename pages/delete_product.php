<?php

// check if value was posted
if ($_POST) {
    // include database and object file
    include_once 'classes/db.php';
    include_once 'classes/product.php';

    // get database connection
    $db = new DbManager();

    // set product id to be deleted
    $id = $_POST['object_id'];

    // delete the product
    if ($db->deleteProduct($id)) {
        echo 'Object was deleted.';
    }

    // if unable to delete the product
    else {
        echo 'Unable to delete object.';
    }
}
