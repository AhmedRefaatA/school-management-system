<?php

use function PHPSTORM_META\type;

error_reporting(E_ALL);
ini_set('display_errors', '1');

$host = 'http://localhost:8000/';
global $host;
function clean($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = strip_tags($var);

    return $var;
}


function checkempty($inputs){
    $success = 0;
    for ($i=0; $i < count($inputs); $i++) { 
        foreach ($inputs[$i] as $key => $value) {
            if(empty($value)){
                echo "please insert valid data $key field must be required <br>";
            } else{
                $success++;
            }
        }
    }
    if($success == count($inputs)){
        
        echo "Data saved success";
        return true;
    }
}

function validPattern($input, $flag, $len=0){
    switch ($flag) {
        case 'string':
            $pattern = '/^[a-zA-Z\s]*$/';
            return preg_match($pattern, $input);
            break;

        case 'level':
            $pattern = '/^[1-6][a-zA-Z\s]*$/';
            return preg_match($pattern, $input);
            break;
    

        case 'time':
            $pattern = "/[0-9]{9,11}/";
            $time = preg_match($pattern, $input);
            $time = filter_var($time, FILTER_VALIDATE_INT);
            
            return $time;
            break;
        
        case 'date':
            $pattern = "/^[1,2][0-9]{3}[-,\/][0-9][0-9][-,\/][0-9][0-9]/";
            $date = preg_match($pattern, $input);
            
            return $date;
            break;
        
        case 'int':
            $input = filter_var($input, FILTER_VALIDATE_INT);
            
            return $input;
            break;

        case 'bool':
            $input = filter_var($input, FILTER_VALIDATE_BOOL);
            
            return $input;
            break;

        case "len":
            if(strlen($input) < $len){
                return false;
            } else {
                return true;
            }
            break;

        case "gender":
            if($input == 'male' || $input == 'female'){
                return true;
            } else {
                return false;
            }
            break;

        case 'img': 
            $allowedExt = ['png','jpeg', 'jpg'];
    
            $extArray = explode('/',$input);
        
            if(in_array($extArray[1],$allowedExt)){
                return true;
            }else{
                return false;
            }
    
            break;

        case 'document': 
            $allowedExt = ['pdf','docx', 'odt', 'xlsx', 'ppt', 'pptx', 'txt'];
    
            $extArray = explode('/',$input);
        
            if(in_array($extArray[1],$allowedExt)){
                return true;
            }else{
                return false;
            }
    
            break;
    
            
    }
}
function insert($tableName, $colName, $values){

    if(count($colName) == count($values)){
        $columns = implode(',', $colName);
        $val = implode("','", $values);
        return "INSERT INTO $tableName ($columns) VALUES ('$val')";
    }

}

function select($colName, $tblName, $condition=''){
    if(gettype($colName) == 'array'){
        $colName = implode(',', $colName);
    }
    return "SELECT $colName FROM $tblName $condition";
    }

function delete($tblName, $condition){
    return "DELETE FROM $tblName $condition";
    }

function update($tableName, $colName, $values, $condition){

    if(count($colName) == count($values)){
        $str = '';
        for($i=0;$i < count($colName);$i++){
            if(count($colName) > 1){
                if($i == count($colName) -1){
                    $str .= "$colName[$i] = '$values[$i]'";
                }else{
                    $str .= "$colName[$i] = '$values[$i]', ";
                }
                
            }else{
                $str .= "$colName[$i] = '$values[$i]'"; 
            }
            
        }
        return "UPDATE $tableName SET $str $condition";
    }

}

function messageAlert($message, $type='danger'){
    return "<div class='alert alert-$type alert-dismissible fade show' 
            role='alert'
            style='position:absolute; top:0; width:100%; z-index:999'>
                $message
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>";
}

function redirect($path){
    return header("Location: $path");
}
function fireWall($role){
    $role_id = $_SESSION['user']['role_id'];
    $host = 'http://localhost:8000/';
    switch ($role) {
        case "admin":
            if(!in_array($role_id, [1,4])){
                redirect($host."errors/401.php");
            }
            break;
            case "teacher":
            if($role_id != 2){
                redirect($host."errors/401.php");
            }
            break;
            case "student":
            if($role_id != 3){
                redirect($host."errors/401.php");
            }
            break;
            case "super":
            if($role_id != 4){
                redirect($host."errors/401.php");
            }
            break;
            case "auth":
                if(!in_array($role_id, [1,2,3,4])){
                    redirect($host."errors/401.php");
                }
                break;
            case "register":
                if(isset($_SESSION['user'])){
                    redirect($host."errors/404.php");
                }
                break;
        default:
            # code...
            break;
    }
}

?>