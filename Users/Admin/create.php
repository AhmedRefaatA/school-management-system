<?php
    require "../../helper/db_connect.php";
    require "../../helper/helper.php";
    fireWall("super");

fireWall("admin");

    $add_sql = "SELECT address.id as id, cities.name as city, regions.name as region FROM address
    INNER JOIN cities ON address.city_id = cities.id INNER JOIN regions on address.city_id = regions.id";
    $add_op = mysqli_query($connect, $add_sql);
    //$add_data = mysqli_fetch_assoc($add_op);
    //var_dump($add_data['region']);exit;
    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
        $name = ["name" => filter_var(clean($_POST["name"]), FILTER_SANITIZE_STRING)];
        $email = ["email" => filter_var(clean($_POST["email"]), FILTER_VALIDATE_EMAIL)];
        $password = ["password" => clean($_POST["password"])];
        $address = ["address" => clean($_POST["address"])];
        $dateOfBirth = ["dob" => clean($_POST["dob"])];
        $gender = ["gender" => clean($_POST["gender"])];

        //file variables
        $prof_tmp_path = $_FILES['profile']['tmp_name'];
        $prof_name     = $_FILES['profile']['name'];
        $prof_size     = $_FILES['profile']['size'];
        $prof_type     = $_FILES['profile']['type'];
        $prof_check    = ['profile' => $_FILES['profile']['name']];

        $checkempty = checkempty([$name, $email, $password, $address, $dateOfBirth, $gender, $prof_check]);
        $validName = validPattern($name["name"], "string");
        $validPassword = validPattern($password['password'], "len", 8);
        $validDOB = validPattern($dateOfBirth['dob'], "date");
        $validGender = validPattern($gender['gender'], "gender");
        $validAddress = validPattern($address['address'], "int");
        $validProf = validPattern($prof_type, "img");
       
      
        if($checkempty && $validName && $validPassword && $validDOB && $validGender && $validAddress && $validProf){
          $name = $name["name"];
          $email = $email["email"];
          $password = md5($password["password"]);
          $address = $address["address"];
          $dateOfBirth = $dateOfBirth["dob"];
          $gender = $gender["gender"];

          #Profile section ...
          $extArray = explode('/',$prof_type);
          $finalName =   rand().time().'.'.$extArray[1];
          $desPath = '../../Media/profiles/'.$finalName;
          if(move_uploaded_file($prof_tmp_path,$desPath)){


            $sql = insert("users", ['name', 'email', 'password', 'address_id', 'dateOfBirth', 'gender', 'role_id', 'profile', 'verified'], [$name, $email, $password, (int)$address, $dateOfBirth, $gender, 1, $finalName, (int)1]);
            $op = mysqli_query($connect, $sql);
            echo mysqli_error($connect);
            if($op){
                header("Location: index.php");
            } else{
                messageAlert("Error in file upload");
            }


          };
  

    
    
         
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
            <h3>Add Admin</h3>
            <ul>
                <li>
                    <a href="<?php echo $host?>index.php">Home</a>
                </li>
                <li>Users/Admin/Add Admin</li>
            </ul>
        </div>
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Add New Admin</h3>
                    </div>
                </div>
                <form class="new-added-form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Admin Name *</label>
                            <input type="text" name="name" placeholder="Admin Name" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Admin Email *</label>
                            <input type="email" name="email" placeholder="Student Email" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Password*</label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Gender*</label>
                            <input type="radio" name="gender" value="male">Male
                            <input type="radio" name="gender" value="female">Female
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Admin Address *</label>
                            <select name="address">
                                <?php while ($add_data = mysqli_fetch_assoc($add_op)) {?>
                                    <option value = <?php echo $add_data['id'];?>><?php echo $add_data['city'] .' - ' . $add_data['region'];?></option>
                                <?php }?>

                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Date of Birth *</label>
                            <input type="date" name="dob" placeholder="Date of Birth" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Admin Profile*</label>
                            <input type="file" name="profile" class="form-control">
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