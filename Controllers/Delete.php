<?php
require __DIR__ .'/../Database.php';
require __DIR__ . '/../Functions.php';


$db = (new Database())->connect();
$functions= new Functions($db);

if(isset($_GET['id'])){
    $id = $_GET['id'];

    //get post to delete image 
    $student = $functions->getById($id);
   
    if($student && $functions->delete($id)){
    echo "Record Successfully Deleted";
    header ("Location: Index.php");
    exit;
    }
    else {
        echo "Error deleting record.";
    }
}

?>