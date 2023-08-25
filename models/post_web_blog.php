<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["post_blog_web"])) {
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
            $PostDataweb = $database->prepare("INSERT INTO blog_posts_web(image, filename, date_pub, month_pub, title, paragraph) VALUES (:image, :filename, :date_pub, :month_pub, :title, :paragraph)");
            $PostDataweb->bindParam(":image", $image);
            $PostDataweb->bindParam(":filename", $filename);
            $PostDataweb->bindParam(":date_pub", $date_pub);
            $PostDataweb->bindParam(":month_pub", $month_pub);
            $PostDataweb->bindParam(":title", $title);
            $PostDataweb->bindParam(":paragraph", $paragraph);
            
            if ($PostDataweb->execute()) {
                $successweb = "This blog has been created successfully.";
            } else {
                $errorweb = "Error creating this blog!";
            }
        } else {
            $errorweb = "Invalid file. Please upload a valid image file (JPEG, PNG, GIF) up to 5 MB in size.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}
include "../view/web.html";
?>
