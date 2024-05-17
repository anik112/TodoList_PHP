<?php

require './database/dbConnect.php';

if(isset($_POST['submit'])){


    $userName=$_POST['userName'];  // get username from user.
    $passCode=$_POST['userPassword'];   // get passcode from user.
    //  echo $passCode.'</br>';
    $databasePassword=null; // database user password.
    $userId=null; // declare user id.


    $error=null; // declare null error.

    // write quriey for get data from database.
    $getData = $connect->prepare("SELECT `id`,`user_name`,`v_password` FROM `user_info` WHERE user_name='$userName';");
    $getData->execute(); //query execute.
    $allData=$getData->fetchAll(PDO::FETCH_OBJ); // petch data in a array.
    // print_r($allData);


    // get single data fom array.
    foreach($allData as $data){
        $databasePassword = $data->v_password; // get password which come from database.
        $userId = $data->id;
        //echo $databasePassword;
        //echo $userId;
    }

    // check user password and database password are same
    if($databasePassword == $passCode){
        //session_start(); // Start the session.
        $_SESSION['userId']=$userId; // set sesson variable user Id.
        $_SESSION['name']=$userName; // set sessin variable user name.

        //echo $_SESSION['userId'];

        header("Location: /deshbord"); // set url in go to deshbord.
    }else{
        $error='sorry your password is incorrect. please try more.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');
    body {
        background: #c0c0c0;
        font-family: Raleway, sans-serif;
        color: #666;
    }
    
    .login {
        margin: 20px auto;
        padding: 40px 50px;
        max-width: 300px;
        border-radius: 5px;
        background: #fff;
        box-shadow: 1px 1px 1px #666;
    }
    
    .login input {
        width: 100%;
        display: block;
        box-sizing: border-box;
        margin: 10px 0;
        padding: 14px 12px;
        font-size: 16px;
        border-radius: 2px;
        font-family: Raleway, sans-serif;
    }
    
    .login input[type=text],
    .login input[type=password] {
        border: 1px solid #c0c0c0;
        transition: .2s;
    }
    
    .login input[type=text]:hover {
        border-color: #F44336;
        outline: none;
        transition: all .2s ease-in-out;
    }
    
    .login input[type=submit] {
        border: none;
        background: #EF5350;
        color: white;
        font-weight: bold;
        transition: 0.2s;
        margin: 20px 0px;
    }
    
    .login input[type=submit]:hover {
        background: #F44336;
    }
    
    .login h2 {
        margin: 20px 0 0;
        color: #EF5350;
        font-size: 28px;
    }
    
    .login p {
        margin-bottom: 40px;
    }
    
    .links {
        display: table;
        width: 100%;
        box-sizing: border-box;
        border-top: 1px solid #c0c0c0;
        margin-bottom: 10px;
    }
    
    .links a {
        display: table-cell;
        padding-top: 10px;
    }
    
    .links a:first-child {
        text-align: left;
    }
    
    .links a:last-child {
        text-align: right;
    }
    
    .login h2,
    .login p,
    .login a {
        text-align: center;
    }
    
    .login a {
        text-decoration: none;
        font-size: .8em;
    }
    
    .login a:visited {
        color: inherit;
    }
    
    .login a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <form class="login"  action="" method="post" enctype="multipart/form-data"> 
        <h2>Welcome, User!</h2>
        <p>Please log in</p>
        <input type="text" placeholder="User Name"  name="userName"/>
        <input type="password" placeholder="Password"  name="userPassword" />
        <input type="submit" name='submit' value="Log In" />
        <div class="links">
            <a href="#">Forgot password</a>
            <a href="user">Register</a>
        </div>
    </form>
</body>

</html>