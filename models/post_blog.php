<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';
 
if (isset($_POST["send_blog"])) {
    try {
        $image = file_get_contents($_FILES["image"]["tmp_name"]); // Read image file contents
        $date = $_POST["date"];
        $date_pub = $_POST["date_pub"];
        $month_pub = $_POST["month_pub"];
        $title = $_POST["title"];
        $paragraph = $_POST["paragraph"];

        $PostBlog = $database->prepare("INSERT INTO blog_posts (image, date_pub, month_pub, title, paragraph) VALUES (:image, :date_pub, :month_pub, :title, :paragraph)");
        $PostBlog->bindParam(":image", $image, PDO::PARAM_LOB);
        $PostBlog->bindParam(":date_pub", $date_pub);
        $PostBlog->bindParam(":month_pub", $month_pub, PDO::PARAM_INT);
        $PostBlog->bindParam(":title", $title);
        $PostBlog->bindParam(":paragraph", $paragraph);

        if ($PostBlog->execute()) {
            $successMessage = "This Blog has been created successfully";
        } else {
            $errorMessage = "Error creating the blog";
        }
    } catch (PDOException $e) {
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}
include "../view/index.html";
?>
