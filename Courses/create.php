<?php
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    fireWall("teacher");


    $lead_sql = select("*", "users", "where role_id = 2");
    $lead_op = mysqli_query($connect, $lead_sql);
    $level_sql = select("*", "levels");
    $level_op = mysqli_query($connect, $level_sql);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $room = ["room" => clean($_POST["room"])];
        $description = ["desc" => clean($_POST["desc"])];
        $lead = ["lead" => clean($_POST["lead"])];
        $level = ["level" => clean($_POST["level"])];
        

        $schd_tmp_path = $_FILES['schdule']['tmp_name'];
        $schd_name     = $_FILES['schdule']['name'];
        $schd_size     = $_FILES['schdule']['size'];
        $schd_type     = $_FILES['schdule']['type'];
        $schd_check    = ['schdule' => $_FILES['schdule']['name']];
        $validSchd= validPattern($schd_type, "document");

        $check = checkempty([$room, $description, $lead, $level, $schd_check]);
        $validLevel = validPattern($level['level'], "int");
        $validLead = validPattern($lead['lead'], "int");
        $validRoom = validPattern($room['room'], "int");
        $validDesc = validPattern($description['desc'], "string");
        

        if($validLevel && $validLead && $validRoom && $validDesc && $check && $validSchd){
            
            $room = $room["room"];
            $description = $description["desc"];
            $lead = $lead["lead"];
            $level = $level["level"];

            #SCHDULE section ...
            $extArray = explode('/',$schd_type);
            $finalName =   rand().time().'.'.$extArray[1];
            $desPath = '../Media/schdules/'.$finalName;
            if(move_uploaded_file($schd_tmp_path,$desPath)){

            
            $sql = insert('classes', ['room', 'description', 'schdule', 'level_id', 'leader_id'], [$room, $description, $finalName, $level, $lead]);
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



    }
    require "../layouts/home_header.php";
    
?>



<body>
    
<?php 
    require "../layouts/nav.php";
?>
    <div class="dashboard-content-one">
        <!-- Breadcubs Area Start Here -->
        <div class="breadcrumbs-area">
            <h3>Add Course</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>/Courses/Add Course
                </li>
               
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Course</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Course Title*</label>
                            <input type="number" name="room" placeholder="Course Title" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Material *</label>
                            <textarea name="desc" placeholder="class description ..." class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Vedio*</label>
                            <input type="file" name="schdule" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Duration *</label>
                            <select name="lead" class="form-control">
                                <?php while ($lead_data = mysqli_fetch_assoc($lead_op)) {?>
                                    <option value="<?php echo $lead_data['id']?>"><?php echo $lead_data['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Level Class *</label>
                            <select name="level" class="form-control">
                                <?php while ($level_data = mysqli_fetch_assoc($level_op)) {?>
                                    <option value="<?php echo $level_data['id']?>"><?php echo $level_data['title']?></option>
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
    
        <?php require "../layouts/home_footer.php"; ?>

</div>

</body>