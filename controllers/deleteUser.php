<? 
include_once 'classes/db.php';
$db= new DbManager();
if(isset($_POST['id'])){
    $id=$_POST["id"];
    $db->deleteUser($id);
    header('Location: /admin-users');
}

?>