<?php 
 require "../helper/db_connect.php";
 require "../helper/helper.php";
 fireWall("admin");


 $sub_sql = select("*", "subjects");
 $sub_op = mysqli_query($connect, $sub_sql);
 $level_sql = select("*", "levels");
 $level_op = mysqli_query($connect, $level_sql);

 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
     if(!empty($id)){
         $sql = select("*", "level_subjects", "WHERE id = $id");
         $op  = mysqli_query($connect, $sql);
         $data = mysqli_fetch_assoc($op);
     }
 }


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $material = ["material" => clean($_POST['material'])];
    $validMterial = validPattern($material["title"], "string");
    $id = clean(validPattern(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
    $sub_id = ['id' => clean(validPattern(filter_var($_POST['subjects'], FILTER_SANITIZE_NUMBER_INT), 'int'))];
    $level_id = ['id' => clean(validPattern(filter_var($_POST['levels'], FILTER_SANITIZE_NUMBER_INT), 'int'))];
    $check = checkempty([$material, $sub_id, $level_id]);
    if($validMterial && $check){
        $material = $material["material"];
        $sub_id = $sub_id['id'];
        $level_id = $level_id['id'];
        $sql = update('level_subjects', ['level_id','subject_id', 'material'], [$level_id, $sub_id, $material], "WHERE id = $id");
        $op = mysqli_query($connect, $sql);
        if($op){
            redirect('index.php');
        } else{
            echo messageAlert("subject data not inserted please try again");
        }
        
    }else{
        echo messageAlert('please insert valid title for subject');
    }
    
}



    require "../layouts/header.php"; 
?>



<body>
    
<?php 
    require "../layouts/header_menu.php";
    require "../layouts/sidebar.php";
?>
    <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Update Material</h3>
                    <ul>
                        <li>
                            <a href="<?php echo $host?>index.php">Home</a>
                        </li>
                        <li>Update Material</li>
                    </ul>
                </div>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Update Material</h3>
                            </div>
                        </div>
                        <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                            <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Material Name *</label>
                                    <input type="text" name="material" value="<?php echo $data['material']?>" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Subject Type *</label>
                                    <select class="select2" name="subjects">
                                        <?php while($sub_data = mysqli_fetch_assoc($sub_op)) { ?>
                                        <option value="<?php echo $sub_data['id'];?>"><?php echo $sub_data['title'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                    <label>Select Level *</label>
                                    <select class="select2" name="levels">
                                    <?php while($level_data = mysqli_fetch_assoc($level_op)) { ?>
                                        <option value="<?php echo $level_data['id'];?>"><?php echo $level_data['title'];?></option>
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
            
                <?php require "../layouts/footer.php"; ?>

        </div>
</body>