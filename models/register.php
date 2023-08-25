<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require "../connection/connection.php";

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
if (isset($_POST["submit"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $date = $_POST["date"];

    // Check if the user already exists in the database
    $existing_user = $database->prepare("SELECT COUNT(*) FROM User WHERE email = :email");
    $existing_user->bindParam(":email", $email);
    $existing_user->execute();
    $check_existing_user = $existing_user->fetchColumn();

    if ($check_existing_user > 0) {
        echo "This user already exists in the database!";
    } elseif ($confirm_password !== $password) {
        echo "Invalid password";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new user with hashed password into the database
        $post_user = $database->prepare("INSERT INTO User(fullname, email, password, date) VALUES (:fullname, :email, :password, :date)");
        $post_user->bindParam(":fullname", $fullname);
        $post_user->bindParam(":email", $email);
        $post_user->bindParam(":password", $hashed_password); // Use the hashed password
        $post_user->bindParam(":date", $date);

        if ($post_user->execute()) {
            $_SESSION["fullname"] = $fullname;

            // Set a cookie
            $cookie_name = "user_cookie";
            $cookie_value = $fullname;
            $cookie_expiry = strtotime('Fri, 31 Dec 9999 23:59:59 GMT'); // Cookie expires in the distant future
            setcookie($cookie_name, $cookie_value, $cookie_expiry, "/"); // "/" means the cookie is available across the entire domain
            $_SESSION['fullname'] = $fullname;
            $_SESSION['email'] = $email;
            $_SESSION['date'] = $date;
            // Send an email notification
            $mail = new PHPMailer(true); // Passing true enables exceptions
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
                $mail->SMTPAuth = true;
                $mail->Username = 'zobirofkir30@gmail.com'; // Replace with your SMTP username
                $mail->Password = 'qgkzntcdgizxkwbr'; // Replace with your SMTP password
                $mail->SMTPSecure = 'tls'; // Use 'tls' or 'ssl' depending on your SMTP server
                $mail->Port = 587; // Replace with the appropriate port for your SMTP server

                $mail->setFrom('zobirofkir19@gmail.com', 'Zobir'); // Replace with your email and name
                $mail->addAddress($email, $fullname); // Recipient email and name
                $mail->Subject = 'Hello ' . $fullname . ', welcome to my blog';
                $mail->Body = "Thank you $fullname, for registering on our blog, and your email $email has been validated successfully.";
                
                $mail->send();
                echo "This user has been registered and an email has been sent.";
            } catch (Exception $e) {
                echo "You are registered, but you didn't use a valid email address!";            }
        } else {
            echo "Error while registering the user.";
        }
    }        
}
?>
