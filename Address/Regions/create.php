<?php
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";



    $city_sql = select("*", "cities");
    $city_op = mysqli_query($connect, $city_sql);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $region = ["region" => clean($_POST['region'])];
        $city = ["city" => clean($_POST['city'])];
        $validRegion = validPattern($region["region"], "string");
        $validCity = validPattern($city["city"], "int");
        $check = checkempty([$region, $city]); 

        if($validRegion && $validCity && $check){
            $region = $region["region"];
            $city = $city["city"];
            $sql = insert('regions', ['name', 'city_id'], [$region, (int)$city]);
            $op = mysqli_query($connect, $sql);
            if($op){
                redirect('index.php');
            } else{
                echo messageAlert("Level data not inserted please try again");
            }
            
        }else{
            echo messageAlert('please insert valid title for level');
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
            <h3>Add Region</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>dashboard.php">Home</a>
                </li>
                <li>Address/Regions/Add Region</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Region</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Region Name *</label>
                            <input type="text" name="region" placeholder="Region Name" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>City Name *</label>
                            <select name="city" class="form-control">
                                <?php while ($data = mysqli_fetch_assoc($city_op)) {?>
                                    <option value="<?php echo $data['id']?>"><?php echo $data['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    
        <?php require "../../layouts/footer.php"; ?>

</div>

</body>