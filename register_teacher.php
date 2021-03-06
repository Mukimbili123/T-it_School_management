<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>School management system</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-sm-block"><img src="img/1.jpg" width="115%" height="100%"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create a Teacher Application!</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="fname"
                                            placeholder="First Name" minlength="3" pattern="[A-Za-z]{0-9}" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="lname"
                                            placeholder="Last Name" minlength="3" pattern="[A-Za-z]{0-9}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="pemail"
                                        placeholder="Email Address" validate required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" max="<?php echo date('Y-m-d');?>" class="form-control form-control-user"
                                            name="dob" title="date of birth" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <select name="gender" class="form-control" required><option>----gender----</option><option>Female</option><option>Male</option></select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                <select name="course" class="form-control" required><option> courses  </option>
                                        <?php
                                        $sel=mysqli_query($conn,"SELECT * FROM course");
                                        while ($fetch = mysqli_fetch_array($sel)) {
                                            $a=1;
                                    ?>
                                    <option><?php echo $fetch['name']; ?></option>
                                    <?php  $a; } ?>
                                </select>
                                </div>
                                
                                <button class="btn btn-primary btn-user btn-block" name="register">Register Account</button>
                                  <?php 
                                  
                                  if (isset($_POST['register'])) {
                                      $fname=$_POST['fname'];
                                      $lname=$_POST['lname'];
                                      $full=$fname . ' ' .$lname;
                                      $email=$_POST['pemail'];
                                      $dob=$_POST['dob'];
                                      $gender=$_POST['gender'];
                                      $course=$_POST['course'];
                                      $checkER =mysqli_query($conn," SELECT teacher.email FROM teacher,users,students WHERE teacher.email='$email' or users.email='$email' or students.email='$email'");
                                      if(mysqli_num_rows($checkER) > 0){
                                        echo "this email exist plz try again";
                                    }else {
                                        $cou=mysqli_query($conn,"SELECT course_id FROM course WHERE name='$course'");
                                      $cour=mysqli_fetch_array($cou);
                                      $course_id=$cour['course_id'];
                                      $check=mysqli_query($conn,"SELECT * FROM teacherfinal,course WHERE course.course_id='$course_id' and course.teacher_id=teacherfinal.teacher_id");
                                      if (mysqli_num_rows($check) > 0) {
                                          echo "this course is not available";
                                      }else{
                                      $chk=mysqli_fetch_array($check);
                                       $insert=mysqli_query($conn,"INSERT INTO teacher(`name`, `email`, `DOB`, `gender`, `course_id` ) VALUES ('$full', '$email', '$dob', '$gender', '$course_id')");
                                      if ($insert) {
                                          echo "Your application have been submitted";
                                         
                                      }else{
                                        var_dump($insert);
                                      }                                
                                       }
                                    }
                                   }//end of isset
                                  ?>  
                               
                                <hr>
                                
                            </form>
                            <div class="text-center">
                                <a class="medium" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>