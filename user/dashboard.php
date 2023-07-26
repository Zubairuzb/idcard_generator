<?php
session_start();
require '../connection.php';

if(!isset($_SESSION['matric'])){
    header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 6px 6px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
  cursor: pointer;
}

.main {
  margin-left: 200px; /* Same as the width of the sidenav */
}

.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #51e2f5;
  color: white;
}

.modal-body {padding: 2px 16px;}

/* .modal-footer {
  padding: 2px 16px;
  background-color: #51e2f5;
  color: white;
} */

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #51e2f5;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

.user-records{
  color: #1d4350;
  font-weight: bold;
  font-size: 1.2em;
}

.record-item{
  color: green;
  font-weight: 500;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

<div class="sidenav">
  <a href="#">Dashboard</a>
  <a id="myBtn">Update</a>
  <a href="script/logout.php">Logout</a>
</div>
<?php
    $current_matric = $_SESSION['matric'];
    $sql = "SELECT * FROM `user` WHERE `matric_number` = '$current_matric'";

    $getUser = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($getUser)):
    $fullname = $row['fullname'];
    $gender = $row['gender'];
    $level = $row['level'];
    $passport = $row['passport'];
    $matric = $row['matric_number'];
    $request = $row['request'];
    $status = $row['status'];
?>

<div class="main">
  <h2>Welcome <span style="color: green;"><?php echo $fullname ?></span></h2>
  <?php
    // $checkpassport = "SELECT `passport` FROM `user` WHERE `matric_number` = '$current_matric'";
    // $verify = mysqli_query($conn, $checkpassport);

    if(empty($passport)):
        echo "<p> click on Update to upload your passport</p>";
    else: 
        echo "Your ID card records:";
    
        ?>

        <section class="user-records">
          <p>Matric: <span class="record-item"><?php echo strtoupper($matric) ?></span></p>
          <p>Gender: <span class="record-item"><?php echo $gender ?></span></p>
          <p>Level: <span class="record-item"><?php echo $level ?></span></p>
        </section>
        
      <?php 
        if($request == '0'){
          echo "Click to <a href='script/request.php?matric=$current_matric'> request</a> for ID Card";
        }elseif (($request == '1') && ($status == 'notapproved')){
          echo "Your ID card is being processing, please check back later";
        }elseif(($request == '1') && ($status == 'Approved')){
          echo "<p style='color: green'>Congratulations! your ID Card is ready: <a style='background: rgb(102, 102, 153);; color: #fff; text-decoration: none; border-radius: 30px; padding: 6px 12px' href='script/idcard.php?matric=$current_matric'>Print ID Card</a></p>";
        }
      ?>
  <?php
    endif;
  ?>

</div>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <div class="modal-header">
    <span class="close">&times;</span>
    <h2><?php echo $fullname; ?> Update your record</h2>
  </div>
  <form action="./script/update_handler.php" method="post" enctype="multipart/form-data" style="border:1px solid #ccc">
  <div class="container">
    <p style="color: red;">You can only update once</p>
    <hr>

    <label for="fullname"><b>Fullname</b></label>
    <input type="text" value="<?php echo $fullname ?>" placeholder="Enter fullname" name="fullname" required>

    <label for="matric"><b>Matric</b></label>
    <input type="text" value="<?php echo $current_matric ?>" placeholder="Enter matric" name="matric" required>


    <label for="passport"><b>Passport</b></label>
    <input type="file" name="passport" >

    <label for="gender"><b>Gender</b></label>
    <select name="gender"> 
      <option value="Male" <?php if($gender == 'Male') echo "selected" ?> name="gender">Male</option>
      <option value="Female" <?php if($gender == 'Female') echo "selected" ?> name="gender">Female</option>
    </select><br><br>
    <label for="level"><b>level</b></label>
    <input type="text" value="<?php echo $level ?>" placeholder="Level" name="level" required>

    <div class="clearfix">
      <button class="update" type="submit" name="submit" class="signupbtn">Update</button>
    </div>
  </div>
</form>
  <!-- <div class="modal-footer">
    <h3>Modal Footer</h3>
  </div> -->
</div>

</div>
<?php 
   endwhile;
   ?>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html> 
