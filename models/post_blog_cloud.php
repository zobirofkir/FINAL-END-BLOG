<?php
include "../connection/connection.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["send_blog_cloud"])) {
    try {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5 MB

        // File validation
        if (
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] === UPLOAD_ERR_OK &&
            in_array($_FILES["image"]["type"], $allowedMimeTypes) &&
            $_FILES["image"]["size"] <= $maxFileSize
        ) {
            $image = file_get_contents($_FILES["image"]["tmp_name"]);
            
            // Other form data
            $date_pub = $_POST["date_pub"];
            $month_pub = $_POST["month_pub"];
            $title = $_POST["title"];
            $paragraph = $_POST["paragraph"];

            // Generate a unique filename
            $filename = uniqid() . '-' . $_FILES["image"]["name"];
            
            // Prepare and execute the SQL query
            $post_blog_cloud = $database->prepare("INSERT INTO blog_posts_cloud(image,filename,date_pub,month_pub,title,paragraph) VALUES (:image, :filename, :date_pub, :month_pub, :title, :paragraph)");
            $post_blog_cloud->bindParam(":image", $image);
            $post_blog_cloud->bindParam(":filename", $filename);
            $post_blog_cloud->bindParam(":date_pub", $date_pub);
            $post_blog_cloud->bindParam(":month_pub", $month_pub);
            $post_blog_cloud->bindParam(":title", $title);
            $post_blog_cloud->bindParam(":paragraph", $paragraph);
            
            if ($post_blog_cloud->execute()) {
                $successCloud = "This blog has been created (Cloud).";
            } else {
                $errorCloud = "Error creating this blog!";
            }
        } else {
            $errorCloud = "Invalid file. Please upload a valid image file (JPEG, PNG, GIF) up to 5 MB in size.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}

include "../view/cloud.html";
?>
