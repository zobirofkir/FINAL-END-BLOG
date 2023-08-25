<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../connection/connection.php"; // Make sure you include the database connection here
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../vendor/autoload.php"; // Include the PHPMailer library

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contact"])) {
    $message = filter_var($_POST["message"]);
    $name = filter_var($_POST["name"]);
    $email = filter_var($_POST["email"]);
    $subject = filter_var($_POST["subject"]);
    
    try {
        $contact_insert = $database->prepare("INSERT INTO contact (message, name, email, subject) VALUES (:message, :name, :email, :subject);");
        $contact_insert->bindParam(":message", $message);
        $contact_insert->bindParam(":name", $name);
        $contact_insert->bindParam(":email", $email);
        $contact_insert->bindParam(":subject", $subject);
        
        if ($contact_insert->execute()) {
            // Sending email using PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set your SMTP host
            $mail->SMTPAuth = true;
            $mail->Username = 'zobirofkir30@gmail.com'; // Set your email username
            $mail->Password = 'kqnjhsfjnfxxlxjs'; // Set your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($email, $name); // Set the sender's email and name
            $mail->addAddress('zobirofkir30@gmail.com', $name); // Recipient email and name

            $mail->Subject = $subject;
            $mail->Body = "Message from: $name\nEmail: $email\n\n$message\n\n$subject";

            $mail->send();
            echo "We call you soon";
        } else {
            echo "error";
        }
    } catch (PDOException $e) {
        echo "error"; // Handle any exceptions (e.g., database errors)
    } catch (Exception $e) {
        echo "error"; // Handle PHPMailer exceptions
    }
}
?>
