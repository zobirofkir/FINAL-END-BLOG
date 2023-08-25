<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../connection/connection.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["contact"])) {
    $message = filter_var($_POST["message"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_var($_POST["name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');

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

            $sender_name = filter_var($name, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sender_email = filter_var($email, FILTER_SANITIZE_EMAIL);

            $mail->setFrom($sender_email, $sender_name);
            $mail->addAddress('zobirofkir30@gmail.com', 'Recipient Name');

            $mail->Subject = $subject;
            $mail->Body = "Message from: $name\nEmail: $email\n\n$message\n\nSubject: $subject";

            $mail->send();
            echo "Thank you! We will get in touch soon.";
        } else {
            echo "Database error: Unable to insert contact information.";
        }
    } catch (PDOException $e) {
        echo "error";
    } catch (Exception $e) {
        echo "error";
    }
}
?>
