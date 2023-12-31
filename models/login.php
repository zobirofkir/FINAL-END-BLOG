<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


include "../connection/connection.php";
if (isset($_POST["login"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password =filter_var($_POST["password"], FILTER_SANITIZE_SPECIAL_CHARS);

    // Step 1: Hash the password before storing it
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $login = $database->prepare("SELECT * FROM User WHERE email = :email");
    $login->bindParam(":email", $email);
    $login->execute();
    $user = $login->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Step 2: Verify the hashed password
        if (password_verify($password, $user["password"])) {
            echo "ok";
        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}
?>
