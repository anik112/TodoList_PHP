<?php

require './database/dbConnect.php';

if (isset($_POST['submit'])) {


  $userName = $_POST['email'];  // get username from user.
  $passCode = $_POST['psw'];   // get passcode from user.
  $count = 0;


  // write quriey for get data from database.
  $getData = $connect->prepare("SELECT count(1) as value 
FROM `user_info` WHERE user_name='$userName';");
  $getData->execute(); //query execute.
  $allData = $getData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.
  // print_r($allData);

  // get single data fom array.
  foreach ($allData as $data) {
    $count = $data->value; // get password which come from database.
    //echo "data: " . $count;
  }

  if ((!empty($userName)) && (!empty($passCode)) && ($count == 0)) {
    try {
      $statement = $connect->prepare("INSERT INTO `user_info` (`user_name`, `v_password`) 
    VALUES ('$userName','$passCode');");
      $statement->execute()  or die("Data not insert. Please try again.");
      echo '<div class="success-msg"><i class="fa fa-check"></i>Data Save!</div>';
    } catch (Exception $e) {
      // if create problrm when connection, then show error massage
      echo '<div class="error-msg"><i class="fa fa-times-circle"></i>Data not insert. Please try again.</div>';
    }
  } else {
    echo '<div class="warning-msg"><i class="fa fa-warning"></i>sorry your given information is incorrect. please try new.</div>';
  }
}

?>


<!DOCTYPE html>
<html>
<style>
  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  /* Full-width input fields */
  input[type=text],
  input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
  }

  /* Add a background color when the inputs get focus */
  input[type=text]:focus,
  input[type=password]:focus {
    background-color: #ddd;
    outline: none;
  }

  /* Float cancel and signup buttons and add an equal width */
  .cancelbtn,
  .signupbtn {
    float: left;
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  /* Add padding to container elements */
  .container {
    padding: 16px;
  }

  .info-msg {
    color: #059;
    background-color: #BEF;
    height: 20px;
    text-align: center;
  }

  .success-msg {
    color: #270;
    background-color: #DFF2BF;
    height: 20px;
    text-align: center;
  }

  .warning-msg {
    color: #9F6000;
    background-color: #FEEFB3;
    height: 20px;
    text-align: center;
  }

  .error-msg {
    color: #D8000C;
    background-color: #FFBABA;
    height: 20px;
    text-align: center;
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto;
    /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%;
    /* Could be more or less, depending on screen size */
  }

  /* Style the horizontal ruler */
  hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
  }

  /* The Close Button (x) */
  .close {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
  }

  .close:hover,
  .close:focus {
    color: #f44336;
    cursor: pointer;
  }

  /* Clear floats */
  .clearfix::after {
    content: "";
    clear: both;
    display: table;
  }
</style>

<body>

  <div class="modal">
    <form class="modal-content" action="" method="post" enctype="multipart/form-data">
      <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <label for="email"><b>User Name</b></label>
        <input type="text" placeholder="Enter User Name" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <label for="psw-repeat"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

        <label>
          <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
          <input type="submit" value="Save" name='submit' class="signupbtn">
          <a href="http://localhost:8081"></a>
          <!--<button type="submit" class="signupbtn">Sign Up</button>--->
        </div>
      </div>
    </form>
  </div>

</body>

</html>