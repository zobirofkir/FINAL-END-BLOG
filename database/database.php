<?php
    include "../connection/connection.php";
    
        $create_user = $database->prepare("CREATE TABLE User(
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            fullname VARCHAR(120) NOT NULL,
            email VARCHAR(120) NOT NULL,
            password VARCHAR(120) NOT NULL,
            date DATE NOT NULL
        );");
        $create_user->execute();

        $post_comment = $database->prepare("CREATE TABLE comment (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, 
            comment VARCHAR(120) NOT NULL,
            name VARCHAR(120) NOT NULL,
            email VARCHAR(120) NOT NULL, 
            website VARCHAR(120) NOT NULL
        );");
        $post_comment->execute();
            
        $contact_user = $database->prepare("CREATE TABLE contact(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, message VARCHAR(120) NOT NULL, name VARCHAR(120) NOT NULL, email VARCHAR(120) NOT NULL, subject VARCHAR(120) NOT NULL);");
        $contact_user->execute();

        $imageTable = "CREATE TABLE profile (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,name VARCHAR(120),email VARCHAR(120),password VARCHAR(120),image BLOB)";

    try {
        $database->exec($imageTable);
        echo "Table created successfully.";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

    try {
        $blog_post = $database->prepare("CREATE TABLE blog_posts (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            image BLOB,
            date_pub INT NOT NULL,
            month_pub INT NOT NULL,
            title VARCHAR(120) NOT NULL,
            paragraph TEXT NOT NULL
        )");
        $blog_post->execute();
        echo "Table 'blog_posts' created successfully.";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

    try {
        $blog_post_cloud = $database->prepare("CREATE TABLE blog_posts_cloud (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            image BLOB,
            date_pub INT NOT NULL,
            month_pub INT NOT NULL,
            title VARCHAR(120) NOT NULL,
            paragraph TEXT NOT NULL
        )");
        $blog_post_cloud->execute();
        echo "Table 'blog_posts' created successfully.";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

    try {
        $blog_post_cloud = $database->prepare("CREATE TABLE blog_posts_sécurité (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            image BLOB,
            date_pub INT NOT NULL,
            month_pub INT NOT NULL,
            title VARCHAR(120) NOT NULL,
            paragraph TEXT NOT NULL
        )");
        $blog_post_cloud->execute();
        echo "Table 'blog_posts' created successfully.";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }

    try {
        $blog_post_cloud = $database->prepare("CREATE TABLE blog_posts_web (
            id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
            image BLOB,
            date_pub INT NOT NULL,
            month_pub INT NOT NULL,
            title VARCHAR(120) NOT NULL,
            paragraph TEXT NOT NULL
        )");
        $blog_post_cloud->execute();
        echo "Table 'blog_posts' created successfully.";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }
?>

