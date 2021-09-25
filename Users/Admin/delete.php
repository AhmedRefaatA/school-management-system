<?php 
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    fireWall("super");
    
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
        if(!empty($id)){
            $sql = select("profile", "users", "where id= $id");
            $op  = mysqli_query($connect, $sql);
            $data = mysqli_fetch_assoc($op);
            $profile = $data['profile'];

            $sql = delete("users", "where id = $id");
            $op  = mysqli_query($connect, $sql);
            if($op){
                $path = '../../Media/profiles/'. $profile;
                if(file_exists($path)){
                    unlink($path);
                }
                redirect("index.php");
               // messageAlert("User deleted success ...", "success");

            } else{
                redirect("index.php");
                //messageAlert("User not deleted please try again ...");
            }
            
        }
    }

?>
