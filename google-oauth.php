<?php
session_start();
require_once 'vendor/autoload.php'; 
$clientID = '167608118247-2akkpdjel12httrfvsd0gc42ts056c3b.apps.googleusercontent.com';
$clientSecret = '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';
$redirectURI = 'http://localhost/PRICEHIVE/google-oauth.php'; 

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectURI);
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    $oauth2 = new Google_Service_Oauth2($client);
    $userInfo = $oauth2->userinfo->get();
    $userEmail = $userInfo->getEmail();
    $userName = $userInfo->getName();
    $generatedPassword = generateRandomPassword();

    $db = mysqli_connect('localhost', 'root', '', 'pricehive');

    $user_check_query = "SELECT * FROM users WHERE email='$userEmail' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if (!$user) {
        $password_hashed = password_hash($generatedPassword, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password) VALUES('$userName', '$userEmail', '$password_hashed')";
        mysqli_query($db, $query);
    }

    header("Location: index.html");
    exit(); 
}

function generateRandomPassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if (!isset($_GET['code'])) {
    $authURL = $client->createAuthUrl();
    header("Location: $authURL");
    exit(); 
}
?>
