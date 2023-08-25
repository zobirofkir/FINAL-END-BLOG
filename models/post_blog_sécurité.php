<?php
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$successMessage = $errorMessage = '';

if (isset($_POST["post_blog_sécurité"])){
    try{
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
        $date_pub = $_POST["date_pub"];
        $month_pub = $_POST["month_pub"];
        $title = $_POST["title"];
        $paragraph = $_POST["paragraph"];

        $PostDataSécurité = $database->prepare("INSERT INTO blog_posts_sécurité(image, date_pub, month_pub, title, paragraph) VALUES (:image, :date_pub, :month_pub, :title, :paragraph)");
        $PostDataSécurité->bindParam(":image", $image);
        $PostDataSécurité->bindParam(":date_pub", $date_pub);
        $PostDataSécurité->bindParam(":month_pub", $month_pub);
        $PostDataSécurité->bindParam(":title", $title);
        $PostDataSécurité->bindParam(":paragraph", $paragraph);    
        if ($PostDataSécurité->execute()){
            $successSécurité = "this Blog has been created (Cloud) .";
        }else{
            $errorsécurité = "Error creating this blog !!!";
        }
    }catch(PDOException $e){
        $errorMessage = "Database Error: " . $e->getMessage();
    }
}
include "../view/sécurité.html";
?>

