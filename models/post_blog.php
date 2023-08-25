<?php
include "../connection/connection.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["send_blog"])) {
    try {
        // File validation
        if (
            isset($_FILES["image"]) &&
            $_FILES["image"]["error"] === UPLOAD_ERR_OK &&
            in_array($_FILES["image"]["type"], ['image/jpeg', 'image/png', 'image/gif']) &&
            $_FILES["image"]["size"] <= 5 * 1024 * 1024 // 5 MB
        ) {
            $image = file_get_contents($_FILES["image"]["tmp_name"]);

            // Other form data
            $date_pub = $_POST["date_pub"];
            $month_pub = $_POST["month_pub"];
            $title = $_POST["title"];
            $paragraph = $_POST["paragraph"];

            // Generate a unique and secure filename
            $filename = uniqid() . '-' . $_FILES["image"]["name"];

            // Prepare and execute the SQL query
            $PostBlog = $database->prepare("INSERT INTO blog_posts (image, filename, date_pub, month_pub, title, paragraph) VALUES (:image, :filename, :date_pub, :month_pub, :title, :paragraph)");
            $PostBlog->bindParam(":image", $image, PDO::PARAM_LOB);
            $PostBlog->bindParam(":filename", $filename);
            $PostBlog->bindParam(":date_pub", $date_pub);
            $PostBlog->bindParam(":month_pub", $month_pub, PDO::PARAM_INT);
            $PostBlog->bindParam(":title", $title);
            $PostBlog->bindParam(":paragraph", $paragraph);

            if ($PostBlog->execute()) {
                $successMessage = "This Blog has been created successfully.";
            } else {
                $errorMessage = "Error creating the blog.";
            }
        } else {
            $errorMessage = "Invalid file. Please upload a valid image file (JPEG, PNG, GIF) up to 5 MB in size.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}
include "../view/index.html";
?>
