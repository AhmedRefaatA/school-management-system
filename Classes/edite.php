<?php 
 require "../helper/db_connect.php";
 require "../helper/helper.php";
 fireWall("admin");
 
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
     $lead_sql = select("*", "users", "where role_id = 2");
     $lead_op = mysqli_query($connect, $lead_sql);
     $level_sql = select("*", "levels");
     $level_op = mysqli_query($connect, $level_sql);
     if(!empty($id)){
         $sql = "SELECT classes.*, users.name, levels.title FROM classes INNER JOIN levels ON classes.level_id = levels.id INNER JOIN users ON users.id = classes.leader_id WHERE classes.id = $id";
         $op  = mysqli_query($connect, $sql);
         $data = mysqli_fetch_assoc($op);
     }
 }


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = clean(validPattern(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
    $room = ["room" => clean($_POST["room"])];
    $description = ["desc" => clean($_POST["desc"])];
    $lead = ["lead" => clean($_POST["lead"])];
    $level = ["level" => clean($_POST["level"])];
    $old_schd = clean($_POST["old_schd"]);
        

        $schd_tmp_path = $_FILES['schdule']['tmp_name'];
        $schd_name     = $_FILES['schdule']['name'];
        $schd_size     = $_FILES['schdule']['size'];
        $schd_type     = $_FILES['schdule']['type'];
        $schd_check    = ['schdule' => $_FILES['schdule']['name']];
        $validSchd= validPattern($schd_type, "document");

        $check = checkempty([$room, $description, $lead, $level]);
        $validLevel = validPattern($level['level'], "int");
        $validLead = validPattern($lead['lead'], "int");
        $validRoom = validPattern($room['room'], "int");
        $validDesc = validPattern($description['desc'], "string");
        

        if($validLevel && $validLead && $validRoom && $validDesc && $check){
            $room = $room["room"];
            $description = $description["desc"];
            $lead = $lead["lead"];
            $level = $level["level"];

            #SCHDULE section ...
            $extArray = explode('/',$schd_type);
            $finalName =   rand().time().'.'.$extArray[1];
            $desPath = '../Media/schdules/'.$finalName;
            if(move_uploaded_file($schd_tmp_path,$desPath)){

                unlink("../Media/schdules/$old_schd");
            } else{
                $finalName = $old_schd;
            }
           
            $sql = update('classes', ['room', 'description', 'schdule', 'level_id', 'leader_id'], [$room, $description, $finalName, $level, $lead], "WHERE id = $id");
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
            <h3>Update Class</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Classes/Update Class</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Update Class</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']). '?id='. $data['id']; ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data['id']?>">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Class Room *</label>
                            <input type="number" name="room" value="<?php echo $data['room'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Description *</label>
                            <textarea name="desc" class="form-control"><?php echo $data['description']?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <a href="../Media/schdules/<?php echo $data['schdule']; ?>" class="btn btn-info">Check Schdule</a>
                            <input type="hidden" name="old_schd" value="<?php echo $data['schdule']?>">
                            <label>Class schdule*</label>
                            <input type="file" name="schdule" value="<?php echo $data['schdule']?>" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Class  Leader *</label>
                            <select name="lead" class="form-control">
                                <?php while ($lead_data = mysqli_fetch_assoc($lead_op)) {?>
                                    <option value="<?php echo $lead_data['id'];?>" <?php if($data["leader_id"] == $lead_data['id']){echo "selected";} ?>><?php echo $lead_data['name']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Level Class *</label>
                            <select name="level" class="form-control">
                                <?php while ($level_data = mysqli_fetch_assoc($level_op)) {?>
                                    <option value="<?php echo $level_data['id']?>" <?php if($data["level_id"] == $level_data['id']){echo "selected";}?>><?php echo $level_data['title']?></option>
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