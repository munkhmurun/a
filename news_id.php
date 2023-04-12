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
    <style>
        body {
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
        img{
            width: 800px;
            height: 500px;
        }
    </style>
</head>
<body>
<div class="news-section">
    <?php

    // Check if a specific news article is requested
    if (isset($_GET['news_id'])) {
        // Get the requested news article from the database
        $news_id = $_GET['news_id'];
        $sql = "SELECT * FROM news_form WHERE id = '$news_id' AND status = 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            // Display the requested news article
            echo "<div class='news-item'>";
            echo "<p>" . $row['body'] . "</p>";
            
            echo "</div>";
        } else {
            // Display an error message if the requested news article doesn't exist
            echo "<p>Error: News article not found</p>";
        }
    } 
    ?>
</div>

</body>
</html>
