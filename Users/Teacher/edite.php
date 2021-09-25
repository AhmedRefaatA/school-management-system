<?php 
 require "../../helper/db_connect.php";
 require "../../helper/helper.php";
 
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
     if(!empty($id)){
        $add_sql = "SELECT address.id as id, cities.name as city, regions.name as region FROM address
        INNER JOIN cities ON address.city_id = cities.id INNER JOIN regions on address.city_id = regions.id";
        $add_op = mysqli_query($connect, $add_sql);
        $sql = "SELECT users.*,address.id as add_id, cities.name as city, regions.name as region, subjects.title as subject, teacher_data.salary FROM users INNER JOIN address ON users.address_id = address.id INNER JOIN cities on address.city_id = cities.id INNER JOIN regions on address.city_id = regions.id INNER JOIN teacher_data ON teacher_data.teacher_id = users.id INNER JOIN subjects ON teacher_data.subject_id = subjects.id WHERE role_id = 2 AND users.id = $id";
        $op  = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($op);
        
        $sbj_sql = select("*","subjects");
        $sbj_op = mysqli_query($connect, $sbj_sql);
     }
 }


 if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = clean(validPattern(filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT), 'int'));
    $name = ["name" => filter_var(clean($_POST["name"]), FILTER_SANITIZE_STRING)];
    $email = ["email" => filter_var(clean($_POST["email"]), FILTER_VALIDATE_EMAIL)];
    $address = ["address" => clean($_POST["address"])];
    $subject = ["subject" => clean($_POST["subject"])];
    $salary = ["salary" => clean($_POST["salary"])];
    $dateOfBirth = ["dob" => clean($_POST["dob"])];
    $gender = ["gender" => clean($_POST["gender"])];
    $old_img = clean($_POST["old_img"]);

    //file variables
    $prof_tmp_path = $_FILES['profile']['tmp_name'];
    $prof_name     = $_FILES['profile']['name'];
    $prof_size     = $_FILES['profile']['size'];
    $prof_type     = $_FILES['profile']['type'];

    $checkempty = checkempty([$name, $email, $address, $dateOfBirth, $gender, $subject, $salary]);
    $validName = validPattern($name["name"], "string");
    $validDOB = validPattern($dateOfBirth['dob'], "date");
    $validGender = validPattern($gender['gender'], "gender");
    $validAddress = validPattern($address['address'], "int");
    $validSubject = validPattern($subject['subject'], "int");
    $validSalary = validPattern($salary['salary'], "int");
   
  
    if($checkempty && $validName && $validDOB && $validGender && $validAddress && $validSubject && $validSalary){
      $name = $name["name"];
      $email = $email["email"];
      $address = $address["address"];
      $subject = $subject["subject"];
      $salary = $salary["salary"];
      $dateOfBirth = $dateOfBirth["dob"];
      $gender = $gender["gender"];

      #Profile section ...
      if(!empty($prof_name) && validPattern($prof_type, "img")){
        $extArray = explode('/',$prof_type);
        $finalName =   rand().time().'.'.$extArray[1];
        $desPath = '../../Media/profiles/'.$finalName;
        
        if(move_uploaded_file($prof_tmp_path,$desPath)){
            unlink("../../Media/profiles/$old_img");
        }
      }else{
            $finalName = $old_img;
      }
        $sql = update("users", ['name', 'email', 'address_id', 'dateOfBirth', 'gender', 'profile'], [$name, $email, (int)$address, $dateOfBirth, $gender, $finalName], 'where id ='.$id);
        
        
        $op = mysqli_query($connect, $sql);
        if($op){
            $sql = update("teacher_data", ["subject_id", "salary"], [$subject, $salary], "where teacher_id = $id");
            $op = mysqli_query($connect, $sql);
            header("Location: index.php");
        } else{
            messageAlert("Error in file upload");
        }


      };




     
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
            <h3>Update Teacher</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Users/Teacher/Update Teacher</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Update Teacher</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="edite.php?id=<?php  echo $data['id'];?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Teacher Name *</label>
                            <input type="text" name="name" value="<?php echo $data['name'];?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Teacher Email *</label>
                            <input type="email" name="email" value="<?php echo $data['email'];?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Teacher Salary *</label>
                            <input type="number" name="salary" value="<?php echo $data['salary'];?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Gender*</label>
                            <?php if($data['gender'] == 'male'){
                                echo '<input type="radio" name="gender" value="male" checked>Male
                                    <input type="radio" name="gender" value="female">Female';
                            }elseif($data['gender'] == 'female'){
                                echo '<input type="radio" name="gender" value="male">Male
                                <input type="radio" name="gender" value="female" checked>Female';
                            };?>
                            
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Teacher Address *</label>
                            <select name="address">
                                <?php while ($add_data = mysqli_fetch_assoc($add_op)) {?>
                                    <option value = <?php echo $add_data['id'];?>><?php echo $add_data['city'] .' - ' . $add_data['region'];?></option>
                                <?php }?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Teacher Specialization *</label>
                            <select name="subject">
                                <?php while ($sbj_data = mysqli_fetch_assoc($sbj_op)) {?>
                                    <option value = <?php echo $sbj_data['id'];?>><?php echo $sbj_data['title']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Date of Birth *</label>
                            <input type="date" name="dob" value="<?php echo date('Y-m-d',strtotime($data['dateofbirth']));?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Admin Profile*</label>
                            <input type="file" name="profile" class="form-control">
                            <img src="../../Media/profiles/<?php echo $data['profile']?>" alt="">
                            <input type="hidden" name="old_img" value="<?php echo $data['profile']?>">
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