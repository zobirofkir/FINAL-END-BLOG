<?php
include "../connection/connection.php";

try {
    // Create 'User' table
    $create_user = $database->prepare("CREATE TABLE IF NOT EXISTS User(
        id INT PRIMARY KEY AUTO_INCREMENT,
        fullname VARCHAR(120) NOT NULL,
        email VARCHAR(120) NOT NULL,
        password VARCHAR(120) NOT NULL,
        date DATE NOT NULL
    )");
    $create_user->execute();
    echo "Table 'User' created successfully.<br>";

    // Create 'comment' table
    $post_comment = $database->prepare("CREATE TABLE IF NOT EXISTS comment (
        id INT PRIMARY KEY AUTO_INCREMENT, 
        comment VARCHAR(120) NOT NULL,
        name VARCHAR(120) NOT NULL,
        email VARCHAR(120) NOT NULL, 
        website VARCHAR(120) NOT NULL
    )");
    $post_comment->execute();
    echo "Table 'comment' created successfully.<br>";

    // Create 'contact' table
    $contact_user = $database->prepare("CREATE TABLE IF NOT EXISTS contact(
        id INT PRIMARY KEY AUTO_INCREMENT, 
        message VARCHAR(120) NOT NULL, 
        name VARCHAR(120) NOT NULL, 
        email VARCHAR(120) NOT NULL, 
        subject VARCHAR(120) NOT NULL
    )");
    $contact_user->execute();
    echo "Table 'contact' created successfully.<br>";

    // Create 'profile' table
    $imageTable = "CREATE TABLE IF NOT EXISTS profile (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(120),
        email VARCHAR(120),
        password VARCHAR(120),
        image LONGBLOB
    )";
    $database->exec($imageTable);
    echo "Table 'profile' created successfully.<br>";

    // Create 'blog_posts' table
    $blog_post = $database->prepare("CREATE TABLE IF NOT EXISTS blog_posts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        filename VARCHAR(120),
        image LONGBLOB,
        date_pub INT NOT NULL,
        month_pub INT NOT NULL,
        title VARCHAR(120) NOT NULL,
        paragraph TEXT NOT NULL
    )");
    $blog_post->execute();
    echo "Table 'blog_posts' created successfully.<br>";

    // Create 'blog_posts_cloud' table
    $blog_post_cloud = $database->prepare("CREATE TABLE IF NOT EXISTS blog_posts_cloud (
        id INT PRIMARY KEY AUTO_INCREMENT,
        filename VARCHAR(120),
        image LONGBLOB,
        date_pub INT NOT NULL,
        month_pub INT NOT NULL,
        title VARCHAR(120) NOT NULL,
        paragraph TEXT NOT NULL
    )");
    $blog_post_cloud->execute();
    echo "Table 'blog_posts_cloud' created successfully.<br>";

    // Create 'blog_posts_sécurité' table
    $blog_post_securite = $database->prepare("CREATE TABLE IF NOT EXISTS blog_posts_securite (
        id INT PRIMARY KEY AUTO_INCREMENT,
        filename VARCHAR(120),
        image LONGBLOB,
        date_pub INT NOT NULL,
        month_pub INT NOT NULL,
        title VARCHAR(120) NOT NULL,
        paragraph TEXT NOT NULL
    )");
    $blog_post_securite->execute();
    echo "Table 'blog_posts_securite' created successfully.<br>";

    // Create 'blog_posts_web' table
    $blog_post_web = $database->prepare("CREATE TABLE IF NOT EXISTS blog_posts_web (
        id INT PRIMARY KEY AUTO_INCREMENT,
        filename VARCHAR(120),
        image LONGBLOB,
        date_pub INT NOT NULL,
        month_pub INT NOT NULL,
        title VARCHAR(120) NOT NULL,
        paragraph TEXT NOT NULL
    )");
    $blog_post_web->execute();
    echo "Table 'blog_posts_web' created successfully.<br>";

} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
