<?php 
 require "../../helper/db_connect.php";
 require "../../helper/helper.php";
 
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
     if(!empty($id)){
         $sql = select("*", "cities", "where id = $id");
         $op  = mysqli_query($connect, $sql);
         $data = mysqli_fetch_assoc($op);
     }
 }


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $city = ["name" => clean($_POST['name'])];
    $id = clean(validPattern(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
    $validCity = validPattern($city["name"], "string");
    

    if($validCity && !empty($city['name'])){
        $city = $city["name"];
        $sql = update('cities', ['name'], [$city], "where id = $id");
        $op = mysqli_query($connect, $sql);
        if($op){
            redirect('index.php');
        } else{
            echo messageAlert("City data not inserted please try again");
        }
        
    }else{
        echo messageAlert('please insert valid name for city');
    }
    
}



    require "../../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../../layouts/header_menu.php";
    require "../../layouts/sidebar.php";
    fireWall("admin");
?>
    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Update City</h3>
                    <ul>
                        <li>
                            <a href="<?php echo $host?>index.php">Home</a>
                        </li>
                        <li>Update Cities</li>
                    </ul>
                </div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Update City</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>City Name *</label>
                                    <input type="text" name="name" value="<?php echo $data['name']?>" placeholder="Role Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            
                <?php require "../../layouts/footer.php"; ?>

        </div>
</body>