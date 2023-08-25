<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);
 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

include "../connection/connection.php";

$get_users = $database->prepare("SELECT email, fullname FROM User");
$get_users->execute();
$users = $get_users->fetchAll(PDO::FETCH_ASSOC);

// Return the users in JSON format
echo json_encode($users);
?>

