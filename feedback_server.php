<?php
session_start();

$name = "";
$email = "";
$feedback = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'PRICEHIVE');
if (isset($_POST['submit_feedback'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $feedback = mysqli_real_escape_string($db, $_POST['feedback']);

  if (empty($email)) { 
    array_push($errors, "Email is required"); 
  }
  if (empty($feedback)) { 
    array_push($errors, "Feedback is required"); 
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO feedback (email, feedback) 
              VALUES('$email', '$feedback')";
    mysqli_query($db, $query);
    $_SESSION['success'] = "Your feedback has been submitted successfully";
    header('location: index.php');
  }
}
?>
