<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if(isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $image = $_FILES["avatar"]["tmp_name"]; // Use "avatar" since it's the name of your file input
    
    // Read the image data
    $imageData = file_get_contents($image);
    
    $post_image = $database->prepare("INSERT INTO profile (name,email,password,image) VALUES (:name, :email, :password, :image)");
    $post_image->bindParam(':name', $name);
    $post_image->bindParam(':email', $email);
    $post_image->bindParam(':password', $password);
    $post_image->bindParam(':image', $imageData, PDO::PARAM_LOB);

    if ($post_image->execute()) {
        echo "Data posted successfully";
    } else {
        echo "Error posting data.";
    }
}

?>
    
