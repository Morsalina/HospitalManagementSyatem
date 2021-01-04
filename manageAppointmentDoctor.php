
<?php
session_start();
     $conn = mysqli_connect('localhost','root','','hospital_management_system');

     if(!isset($_SESSION['doctor_login'])){
       header("Location:index.php");
     } else{
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Manage your appointment </title>
  <meta charset="utf-8">
  <link rel="icon" type="image/png" href="image/logo.png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="manageAppointmentDoctor.css">
</head>
<body>
  <div class="container main-section">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
        <div class="input-group searchbox">
          <div class="input-group-btn">
            <center> <a href="showPatientList.php"> <button class="btn btn-default search-icon" type="submit" name="search_doctor">patient List</button> </a></center>
          </div>
        </div>
        <div class="left-chat">
          <ul>
            <?php include("get_patient_data.php"); ?>
          </ul>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12 right-sidebar">
        <div class="row">
          <!-- getting the user info who is logged in now-->
          <?php
        //   session_start();
            $user = $_SESSION['doctor_login'];
            $conn = mysqli_connect('localhost','root','','hospital_management_system');
             $get_user = "SELECT * FROM doctor WHERE email='$user'";
             $run_user = mysqli_query($conn, $get_user);
             $row = mysqli_fetch_array($run_user);
             $user_id = $row['id'];
             $user_name = $row['name'];
           ?>
          <!-- jei user ke click korbe tar info-->
          <?php

            if(isset($_GET['user_name'])){

              $conn = mysqli_connect('localhost','root','','hospital_management_system');
             $get_patientname = $_GET['user_name'];
                $get_patient= "SELECT * FROM register WHERE Name='$get_patientname'";
               $run_user = mysqli_query($conn, $get_patient);
               $row_user = mysqli_fetch_array($run_user);
              $patient_id = $row_user['id'];
              $patient_name = $row_user['Name'];
            }

             $total_messages = "SELECT * FROM user_chat WHERE (sender_username = '$user_name' AND receiver_username='$patient_name') OR (receiver_username = '$user_name' AND sender_username='$patient_name')";

             $run_msg = mysqli_query($conn, $total_messages);
             $total = mysqli_num_rows($run_msg);

           ?>
           <div class="col-md-12 right-header">
             <div class="right-header-detail">
               <form method="post">
                 <p> <?php echo $patient_name;// added this inverted comma ?> </p>
                 <span> <?php echo $total; ?> messages</span> &nbsp  &nbsp
               </form>
             </div>
           </div>
        </div>

            <div class="row">
              <div id="scrolling_to_bottom" class="col-md-9 right-header-contentchat">
                <?php
                    $update_msg= mysqli_query($conn,"UPDATE user_chat SET msg_status='read' WHERE sender_username='$patient_name' AND receiver_username='$user_name'");//i have not changed their name

                    $sel_msg="SELECT * FROM user_chat WHERE(sender_username='$user_name' AND receiver_username='$patient_name') OR (receiver_username='$user_name' AND sender_username='$patient_name') ORDER by 1 ASC";

                    $run_msgs = mysqli_query($conn, $sel_msg);

                    while($row = mysqli_fetch_array($run_msgs)){
                      $sender_username = $row['sender_username'];
                      $receiver_username = $row['receiver_username'];
                      $msg_content = $row['msg_contest'];
                      $msg_date = $row['mag_date'];


                 ?>
                 <ul>
                   <?php

                       if($user_name == $sender_username AND $patient_name == $receiver_username){ ?>

                           <li>
                              <div class="rightside-right-chat">

                                <p> <?php echo $msg_content; ?> </p>
                              </div>
                           </li>

                  <?php  }

                    elseif($user_name == $receiver_username AND $patient_name == $sender_username){ ?>

                        <li>
                           <div class="rightside-left-chat">
                             <span> <?php echo $patient_name; ?> <small> <?php echo $msg_date;?></small> </span>
                             <p> <?php echo $msg_content; ?> </p>
                           </div>
                        </li>

               <?php  }
                 ?>
                 </ul>
                 <?php
               }
                ?>
              </div>
            </div>
                <div class="row">
                  <div class="col-md-6 right-chat-textbox">
                    <form method="post">
                      <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message..">
                      <button class="btn" name="submit"> Send<i class="fa fa-telegram" aria-hidden="true"></i> </button>
                    </form>
                  </div>
                </div>
      </div>
      <div id="sidebar" class="col-md-3">
        <h4>Check this features:</h4>
        <ul class="list-unstyled">
          <li> <a id="option1" href="homepageDoctor.php">Homepage</a> </li>
          <li> <a id="option1" href="searchPatient.php">Search specific patient</a> </li>
          <li> <a id="option1" href="showPatientList.php">Patient's list</a> </li>
          <li> <a id="option1" href="covidPatientforDoc.php">Covid-19 Patient</a> </li>
          <li> <a id="option1" href="videoConfaDoctor.php">Video Conference</a> </li>
          <li> <a id="option1" href="uploadPrescription.php">Upload prescription</a> </li>
          <li> <a id="option1" href="seeAllMeetings.php">See all meeting schedules</a> </li>
      </div>
    </div>
  </div>
  <?php
     $conn = mysqli_connect('localhost','root','','hospital_management_system');
        if(isset($_POST['submit'])){
          $msg = htmlentities($_POST['msg_content']);
          if($msg==""){ ?>
               <div class="alert alert-danger">
                 <?php echo "Message was enable to send"; ?>
               </div>
        <?php  }
         else if(strlen($msg)>100){ ?>
           <div class="alert alert-danger">
             <?php echo "Meassage is too long, use only 100 characters"; ?>
           </div>
        <?php
      }

         else{
            $insert = "INSERT INTO user_chat VALUES('NULL','$user_name','$patient_name','$msg','unread', NOW())";
            $run_insert = mysqli_query($conn, $insert);

         }
        }

   ?>

   <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
      $('#scrolling_to_bottom').animate({
        scrollTop:$('#scrolling_to_bottom').get(0).scrollHeight},1000);
    </script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
      $(document).ready(function(){
        var height = $(window).height();
        $('.left-chat').css('height-92')+'px');
        $('.right-header-contentchat').css('height',(height-163)+'px');
      });
    </script> -->


    </div>
</body>
</html>
<?php } ?>
