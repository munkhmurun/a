<?php

// Include the configuration file and start the session
@include 'config.php';
session_start();

// Redirect user to the login form if not logged in
if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
   if(!isset($_SESSION['user_name'])){
      header('location:login_form.php');
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <style>body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
  color: #333;
}

h1 {
  text-align: center;
  font-size: 36px;
  margin-top: 50px;
}

h2 {
  font-size: 28px;
  margin-top: 50px;
  margin-bottom: 20px;
  text-align: center;
}

p {
  font-size: 18px;
  line-height: 1.5;
}

.news-section {
  max-width: 800px;
  margin: 0 auto;
  padding: 50px;
  background-color: #fff;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
}

.news-item {
  display: flex;
  margin-bottom: 30px;
}

.news-item img {
  width: 200px;
  height: 150px;
  margin-right: 20px;
  object-fit: cover;
}

.news-item h3 {
  font-size: 24px;
  margin-top: 0;
}

.news-item p {
  margin: 0;
  font-size: 18px;
  line-height: 1.5;
}

.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.pagination a {
  display: inline-block;
  padding: 5px 10px;
  margin-right: 5px;
  border: 1px solid #ccc;
  border-radius: 3px;
  color: #333;
  text-decoration: none;
}

.pagination a:hover,
.pagination a.active {
  background-color: #333;
  color: #fff;
}

    </style>
</head>
<body>
<div class="news-section">
    <?php

    $items_per_page = 2; 
    $page = isset($_GET['page']) ? $_GET['page'] : 1; 
    $offset = ($page - 1) * $items_per_page; 

    
    $sql = "SELECT * FROM news_form WHERE status = 1 LIMIT $items_per_page OFFSET $offset";
    $result = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='news-item'>";
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<img src='" . $row['image_url'] . "' alt='news image'>";
        echo "<a href='news_id.php?news_id=" . $row['id'] . "'>Цааш унших</a>";
        echo "</div>";
    }

    
    $sql = "SELECT COUNT(*) AS count FROM news_form WHERE status = 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_pages = ceil($row['count'] / $items_per_page); 
    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='?page=$i'>$i</a>"; 
    }
    echo "</div>";

    ?>
</div>
</body>
</html>
