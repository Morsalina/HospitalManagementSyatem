<?php
session_start();

if(!isset($_SESSION['doctor_login'])){
  header("Location:index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Profile</title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="image/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="editProfileDoctor.css">
</head>
<body>

  <?php
  session_start();
    $session_user = $_SESSION['doctor_login'];
    $conn = mysqli_connect('localhost','root','','hospital_management_system');
    if(isset($_POST['update'])){
      $name = $_POST['name'];
      $phn = $_POST['phn_no'];
      $email =  $_POST['email'];
      $pass =  $_POST['pwd'];
      $specialist = $_POST['specialist'];
      $degree =  $_POST['degree'];
      $fees =  $_POST['fees'];

      $sql= "UPDATE doctor SET name='$name',phone='$phn',email='$email',Password='$pass',specialist='$specialist',degree='$degree', fees='$fees'  WHERE email='$session_user'";
      $result = mysqli_query($conn, $sql);
    //  $rowcount = mysqli_num_rows($result);
      if(true){
        header("Location:homepageDoctor.php");
      }
    }
  //  print_r($row);

  if(isset($_POST['cancel'])){
    header("Location:myAccountDoctor.php");
  }
   ?>

 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="hospital_demo1.html">
        <img src="image/brand.png" alt="Hospital logo" width="40px" height="30px">
      </a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="index">Home</a></li>
      <li><a href="aboutUs.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="service.php">Service</a></li>
      <li><a href="covidInfo.php">Covid-19 Info</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
       <li> <a href="logout.php"> <span class="glyphicon glyphicon-log-in"></span> Log out </a>  </li>
    </ul>
  </div>
</nav>

<div class="mainbody">
  <div class="container-fluid">
    <div class="row">
      <br><br>
      <div id="sidebar" class="col-md-3 bg-success">
        <ul class="list-unstyled">
          <li> <a id="option1" href="searchPatient.php">Search specific patient</a> </li>
          <li> <a id="option2" href="showPatientList.php">Patient's list</a> </li>
          <li> <a id="option2" href="covidPatientforDoc.php">Covid-19 Patient</a> </li>
          <li> <a id="option3" href="manageAppointmentDoctor.php">Manage Appointment</a> </li>
          <li> <a id="option5" href="videoConfaDoctor.php">Video Conference</a> </li>
          <li> <a id="option1" href="uploadPrescription.php">Upload prescription</a> </li>
          <li> <a id="option1" href="seeAllMeetings.php">See all meeting schedules</a> </li>
        </ul>
      </div>

      <div class="col-md-9">
        <h3 class="text-center">Edit Personal Info :</h3>
        <div class="sign">
          <form action="" method="POST">
            <div class="form-group">
              <label id="name1" for="name">Name:</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name"   name="username">
            </div>
            <div class="form-group">
              <label id="phn" for="phoneNumber">Phone Number:</label>
              <input type="number" class="form-control" name="phn_no" placeholder="Phone number"   name="userphn">
            </div>
             <div class="form-group">
                 <label id="em1" for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
               <label id="pass1" for="pwd">Password:</label>
                    <input type="password" class="form-control" name="pwd" placeholder="Enter password" name="pwd">
            </div>
            <div class="form-group">
              <label id="age1" for="specialist">Specialist:</label>
              <input type="text" class="form-control" name="specialist" placeholder="Specialist on">
            </div>
            <div class="form-group">
              <label id="age1" for="degree">Degree:</label>
              <input type="text" class="form-control" name="degree" placeholder="Enter degree">
            </div>
            <div class="form-group">
              <label id="age1" for="fees">Fees:</label>
              <input type="number" class="form-control" name="fees" placeholder="Enter your fees amount">
            </div>
            <button  id="msgBtn" name="update" type="submit" class="btn btn-success">Save Info</button>
            <button  id="msgBtn" name="cancel" type="submit" class="btn btn-success">Cancel</button>
        </form>

        </div>

      </div>

    </div>
  </div>
</div>

<div class="footer">
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <strong>Follow us on</strong> <br>
          <ul class="list-unstyled">
            <li> <a href="https://web.facebook.com/morsalina.kowmi/"> Facebook</a> </li>
            <li> <a href="#"> Twitter</a> </li>
            <li> <a href="#"> Instagram</a> </li>
          </ul>
        </div>
        <div class="col-md-5">
          <strong>contact us </strong> <br>
          +123457 <br>
      </div>
      <div class="col-md-4">
        <ul>
          <li> <a href="FAQ.php"> FAQ </a> </li>
          <li> <a href="#">Send Feedback</a> </li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>
