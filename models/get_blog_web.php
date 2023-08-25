<?php
session_start();
include "../connection/connection.php"; // Include your database connection file here

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
 
$GetBlogPosts = $database->prepare("SELECT * FROM blog_posts_web");
$GetBlogPosts->execute();
$blogPosts = $GetBlogPosts->fetchAll(PDO::FETCH_ASSOC);

foreach ($blogPosts as $post) {
    echo '<article class="blog_item">';
    echo '<div class="blog_item_img">';
    echo '<div style="text-align: center;"><h2>Hello, world</h2></div><br>';
    echo '<img class="card-img rounded-0" src="data:image/jpeg;base64,' . base64_encode($post['image']) . '" alt="">';
    echo '<a href="single-blog.html" class="blog_item_date">';
    echo '<h3>' . $post['date_pub'] . '</h3>';
    echo '<p>' . $post['month_pub'] . '</p>';
    echo '</a></div>';
    echo '<div class="blog_details">';
    echo '<a class="d-inline-block" href="single-blog.html">';
    echo '<h2>' . $post['title'] . '</h2>';
    echo '</a>';
    echo '<p>' . $post['paragraph'] . '</p>';
    echo '<ul class="blog-info-link">';
    echo '<li><a href="comment.html"><i class="fa fa-comments"></i> 03 Comments</a></li>';
    echo '</ul></div></article>';
}
?>
