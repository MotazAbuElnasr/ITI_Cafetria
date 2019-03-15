<?php

require_once 'classes/db.php';
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
// set number of records per page
$records_per_page = 5;
// calculate for the query LIMIT clause
$from_record_num = $page > 0 ? ($records_per_page * $page) - $records_per_page : 0;

// $from_record_num = $page > 0 ? ($page - 1) * $records_per_page : 0;
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
include 'tempelates/adminNavbar.php';
include 'tempelates/layout_header.php';
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
        echo '<tr>';
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo '<td>';
        $category->id = $cat_id;
        echo $category->readName($category->id);
        echo '</td>';
        echo "<td><img style='width:50px;height:50px' src='{$img}' /></td>";
        echo '<td>';
        // read, edit and delete buttons
        echo (($status=='available')?
        "<button id='$p_id' onclick='changeStatus(event)' class='btn btn-success left-margin'>Available</button>":
        "<button id='$p_id' onclick='changeStatus(event)' class=' btn btn-warning left-margin'>Unavailable</button>");
                            
        echo  "
            <a href='update-product?id={$p_id}' class='btn btn-info left-margin'>
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
include 'tempelates/layout_footer.php';
?>

<script>
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