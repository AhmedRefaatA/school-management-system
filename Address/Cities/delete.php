<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
        if(!empty($id)){
            $sql = delete("cities", "where id = $id");
            $op  = mysqli_query($connect, $sql);
            redirect("index.php");
        }
    }

?>