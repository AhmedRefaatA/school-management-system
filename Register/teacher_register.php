

<?php 
    require "../helper/db_connect.php";
    require "../helper/helper.php";
    fireWall('register');



    $add_sql = "SELECT address.id as id, cities.name as city, regions.name as region FROM address
    INNER JOIN cities ON address.city_id = cities.id INNER JOIN regions on address.city_id = regions.id";
    $add_op = mysqli_query($connect, $add_sql);
    $sbj_sql = select("*","subjects");
    $sbj_op = mysqli_query($connect, $sbj_sql); 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
  
        $name = ["name" => filter_var(clean($_POST["name"]), FILTER_SANITIZE_STRING)];
        $email = ["email" => filter_var(clean($_POST["email"]), FILTER_VALIDATE_EMAIL)];
        $password = ["password" => clean($_POST["password"])];
        $address = ["address" => clean($_POST["address"])];
        $subject = ["subject" => clean($_POST["subject"])];
        $dateOfBirth = ["dob" => clean($_POST["dob"])];
        $gender = ["gender" => clean($_POST["gender"])];

        //file variables
        $prof_tmp_path = $_FILES['profile']['tmp_name'];
        $prof_name     = $_FILES['profile']['name'];
        $prof_size     = $_FILES['profile']['size'];
        $prof_type     = $_FILES['profile']['type'];
        $prof_check    = ['profile' => $_FILES['profile']['name']];

        $checkempty = checkempty([$name, $email, $password, $address, $subject,$dateOfBirth, $gender, $prof_check]);
        $validName = validPattern($name["name"], "string");
        $validPassword = validPattern($password['password'], "len", 8);
        $validDOB = validPattern($dateOfBirth['dob'], "date");
        $validGender = validPattern($gender['gender'], "gender");
        $validAddress = validPattern($address['address'], "int");
        $validSubject = validPattern($subject['subject'], "int");
        $validProf = validPattern($prof_type, "img");
       
      
        if($checkempty && $validName && $validPassword && $validDOB && $validGender && $validAddress && $validSubject && $validProf){
          $name = $name["name"];
          $email = $email["email"];
          $password = md5($password["password"]);
          $address = $address["address"];
          $subject = $subject["subject"];
          $dateOfBirth = $dateOfBirth["dob"];
          $gender = $gender["gender"];

          #Profile section ...
          $extArray = explode('/',$prof_type);
          $finalName =   rand().time().'.'.$extArray[1];
          $desPath = '../Media/profiles/'.$finalName;
          if(move_uploaded_file($prof_tmp_path,$desPath)){


            $sql = insert("users", ['name', 'email', 'password', 'address_id', 'dateOfBirth', 'gender', 'role_id', 'profile', 'verified'], [$name, $email, $password, (int)$address, $dateOfBirth, $gender, 2, $finalName, (int)0]);
            $op = mysqli_query($connect, $sql);
            if($op){
              $Lid = mysqli_insert_id($connect);
              $sql = insert("teacher_data", ["teacher_id", "subject_id"], [$Lid, $subject]);
              $op = mysqli_query($connect, $sql);
                header("Location: index.php");
            } else{
                messageAlert("Error in file upload");
            }


          };
  

    
    
         
        }
       
      
      
      
      }

?>

<style>
  label,p,span{
    color:#fff;
    font-weight: bold;
    
  }
</style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="card-body p-md-5"  style="background-image: url('<?php echo $host;?>assets/images/bg-register.jpg');background-size:cover">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

          <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4" >Sign up Teacher</p>

          <form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label>Teacher Name *</label>
                  <input type="text" name="name" placeholder="Teacher Name" class="form-control">  
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
              <div class="form-outline flex-fill mb-0">
                  <label>Teacher Email *</label>
                  <input type="email" name="email" placeholder="Teacher Email" class="form-control">
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label>Password*</label>
                  <input type="password" name="password" placeholder="Password" class="form-control">
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label>Date of Birth *</label>
                  <input type="date" name="dob" placeholder="Date of Birth" class="form-control">
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label style="padding-right: 130px;">Gender*</label>
                  <input type="radio" name="gender" value="male"><span>Male</span>
                  <input type="radio" name="gender" value="female"><span>Female</span>
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label style="padding-right: 60px;">Teacher Address *</label>
                  <select name="address">
                      <?php while ($add_data = mysqli_fetch_assoc($add_op)) {?>
                          <option value = <?php echo $add_data['id'];?>><?php echo $add_data['city'] .' - ' . $add_data['region'];?></option>
                      <?php }?>

                  </select>
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label style="padding-right: 20px;">Teacher Specialization*</label>
                  <select name="subject">
                      <?php while ($sbj_data = mysqli_fetch_assoc($sbj_op)) {?>
                          <option value = <?php echo $sbj_data['id'];?>><?php echo $sbj_data['title']?></option>
                      <?php }?>

                  </select>
              </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4">
              <div class="form-outline flex-fill mb-0">
                  <label>Teacher Profile</label>
                  <input type="file" name="profile" style="color:#fff;">
              </div>
            </div>

            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
              <button type="submit" class="btn btn-warning btn-lg" style="color:#034c7c">Register</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
