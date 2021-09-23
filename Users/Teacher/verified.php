<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
        $verified = clean(validPattern(filter_var($_GET['verified'], FILTER_SANITIZE_NUMBER_INT), 'int'));
        if(!empty($id) && $verified == 0){
            $sql = update("users", ["verified"], [1],"where id= $id");
            $op  = mysqli_query($connect, $sql);
            redirect("index.php");
        }elseif(!empty($id) && $verified == 1){
            $sql = update("users", ["verified"], [0],"where id= $id");
            $op  = mysqli_query($connect, $sql);
                redirect("index.php");
            } else{
                redirect("index.php");
            }
        }
            
?>
