<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'pricehive');
$name="";
$email = "";
$errors = array();

if (isset($_POST['signup'])) {
    
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_confirm']);

    if($password_1 !== $password_2){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($db, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if (empty($email)) { 
        array_push($errors, "Email is required"); 
    }
    if (empty($password_1)) { 
        array_push($errors, "Password is required"); 
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { 
        array_push($errors, "Email already exists");
    }

    if (count($errors) == 0) {
        $password_1 = password_hash($password_1, PASSWORD_DEFAULT); // Encrypt password before saving in database
        $query = "INSERT INTO users (name,email, password) VALUES('$name','$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now registered and logged in";
        header('location: index.php');
    }
    else{
        $errors['db-error'] = "Failed while inserting data into database!";
    }
}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($db, $check_email);
    if (empty($email)) { 
        array_push($errors, "Email is required"); 

    }
    if (empty($password)) { 
        array_push($errors, "Password is required"); 
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE email='$email'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['success'] = "You are now logged in";
                header('location: index.html');
            } else {
                header("Location:index.php?errror=Incorect User name or password");
            }
        } else {
            header("Location:index.php?errror=Incorect User name or password");
        }

        
    }
}

if (isset($_POST['google_signup'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($name)) { 
        array_push($errors, "Name is required"); 
        header("Location:index.php?error=Name is required");
    }
    if (empty($email)) { 
        array_push($errors, "Email is required"); 
        header("Location:index.php?error=Email is required");
    }
    if (empty($password)) { 
        array_push($errors, "Password is required"); 
        header("Location:index.php?error=Password is required");
    }

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) { 
        array_push($errors, "Email already exists");
    }

    if (count($errors) == 0) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); // Encrypt password before saving in database
        $query = "INSERT INTO users (name, email, password) VALUES('$name', '$email', '$password_hashed')";
        mysqli_query($db, $query);
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now registered and logged in";
        header('location: index.php');
    }
}