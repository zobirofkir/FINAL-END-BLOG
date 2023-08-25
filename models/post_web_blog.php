<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["post_blog_web"])){
    try{
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
        $date_pub = $_POST["date_pub"];
        $month_pub = $_POST["month_pub"];
        $title = $_POST["title"];
        $paragraph = $_POST["paragraph"];

        $PostDataweb = $database->prepare("INSERT INTO blog_posts_web(image, date_pub, month_pub, title, paragraph) VALUES (:image, :date_pub, :month_pub, :title, :paragraph)");
        $PostDataweb->bindParam(":image", $image);
        $PostDataweb->bindParam(":date_pub", $date_pub);
        $PostDataweb->bindParam(":month_pub", $month_pub);
        $PostDataweb->bindParam(":title", $title);
        $PostDataweb->bindParam(":paragraph", $paragraph);    
        if ($PostDataweb->execute()){
            $successweb = "this Blog has been created (Cloud) .";
        }else{
            $errorweb = "Error creating this blog !!!";
        }
    }catch(PDOException $e){
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}
include "../view/web.html";
?>

