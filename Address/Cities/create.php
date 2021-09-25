<?php
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    fireWall("admin");




    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $city = ["name" => clean($_POST['name'])];
        $validCity = validPattern($level["name"], "string");
        

        if($validCity && !empty($city['name'])){
            $city = $city["name"];
            $sql = insert('cities', ['name'], [$city]);
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
            <h3>Add City</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Address/Cities/Add City</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New City</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>City Name *</label>
                            <input type="text" name="name" placeholder="City Name" class="form-control">
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