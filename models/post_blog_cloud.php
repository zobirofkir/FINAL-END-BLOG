<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["send_blog_cloud"])){
    try{
        $image = file_get_contents($_FILES["image"] ["tmp_name"]);
        $date_pub = $_POST["date_pub"];
        $month_pub = $_POST["month_pub"];
        $title = $_POST["title"];
        $paragraph = $_POST["paragraph"]; 

        $post_blog_cloud = $database->prepare("INSERT INTO blog_posts_cloud(image,date_pub,month_pub,title,paragraph) VALUES (:image, :date_pub, :month_pub, :title, :paragraph)");
        $post_blog_cloud->bindParam(":image", $image);
        $post_blog_cloud->bindParam(":date_pub", $date_pub);
        $post_blog_cloud->bindParam(":month_pub", $month_pub);
        $post_blog_cloud->bindParam(":title", $title);
        $post_blog_cloud->bindParam(":paragraph", $paragraph);
        if ($post_blog_cloud->execute()){
            $successCloud = "this Blog has been created (Cloud) .";
        }else{
            $errorCloud = "Error creating this blog !!!";
        }

     
    }
    catch (PDOException $e){
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}

include "../view/cloud.html";
?>

