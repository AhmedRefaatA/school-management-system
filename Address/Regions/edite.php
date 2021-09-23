<?php 
 require "../../helper/db_connect.php";
 require "../../helper/helper.php";
 
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
     if(!empty($id)){
        $city_sql = select("*", "cities");
        $city_op = mysqli_query($connect, $city_sql);
        $sql = select("*","regions", "where id = $id");
        $op  = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($op);
     }
 }


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $region = ["region" => clean($_POST['region'])];
    $city = ["city" => clean($_POST['city'])];
    $id = clean(validPattern(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
    $validRegion = validPattern($region["region"], "string");
    $validCity = validPattern($city["city"], "int");
    $check = checkempty([$region, $city]); 
   
    if($validRegion && $validCity && $check && !empty($id)){
        $region = $region["region"];
        $city = $city["city"];
        $sql = update('regions', ['name', 'city_id'], [$region, (int)$city], "WHERE id = $id");
        
        $op = mysqli_query($connect, $sql);
        if($op){
            redirect('index.php');
        } else{
            echo messageAlert("Region data not inserted please try again");
        }
        
    }else{
        echo messageAlert('please insert valid title for Region');
    }
    
}
    




    require "../../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../../layouts/header_menu.php";
    require "../../layouts/sidebar.php";
?>
    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Update Region</h3>
                    <ul>
                        <li>
                            <a href="<?php echo $host?>dashboard.php">Home</a>
                        </li>
                        <li>Update Regions</li>
                    </ul>
                </div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Update Region</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Region Name *</label>
                                    <input type="text" name="region" value="<?php echo $data['name'];?>" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>City Name *</label>
                                    <select name="city" class="form-control">
                                        <?php while ($city_data = mysqli_fetch_assoc($city_op)) {?>
                                            <option value="<?php echo $city_data['id']?>"<?php if($city_data['id'] == $data['city_id']){echo "selected";}?>><?php echo $city_data['name']?></option>
                                        <?php }?>
                                    </select>
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