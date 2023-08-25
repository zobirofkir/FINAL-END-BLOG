<?php
    session_start();
    
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
     
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Allow-Headers: Content-Type");
    
    include "../connection/connection.php";
    
    $get_comment = $database->prepare("SELECT comment FROM comment");
    $get_comment->execute();
    $comment = $get_comment->fetchAll(PDO::FETCH_ASSOC);
    
    // Return the comment in JSON format
    echo json_encode($comment);    
?>