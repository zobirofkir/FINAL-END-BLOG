<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include "../connection/connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_comment"])) {
    $comment = $_POST["comment"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $website = $_POST["website"];
    
    // Validate and sanitize input data
    $comment = htmlspecialchars($comment);
    $name = htmlspecialchars($name);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL) ? $email : "";
    $website = filter_var($website, FILTER_VALIDATE_URL) ? $website : "";

    $send_comment = $database->prepare("INSERT INTO comment (comment, name, email, website) VALUES (:comment, :name, :email, :website)");
    $send_comment->bindParam(":comment", $comment);
    $send_comment->bindParam(":name", $name);
    $send_comment->bindParam(":email", $email);
    $send_comment->bindParam(":website", $website);

    if ($send_comment->execute()) {
        $response = array("status" => "success");
        echo json_encode($response); // Send success response
    } else {
        $response = array("status" => "error");
        echo json_encode($response); // Send error response
    }
}
?>
