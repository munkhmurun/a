<?php

@include 'config.php';

session_start();

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
        <h1>DRAFT NEWS</h1>


        <?php

        // Select all news articles from the database
        $sql = "SELECT * FROM news_form WHERE status = 0";
        $result = mysqli_query($conn, $sql);

// Display news articles in a list
$i = 1; // initialize the counter
while ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . $i . ". " . $row['title'] . "</h2>";
    echo "<p>" . $row['body'] . "</p>";
    echo "<form method='post'>";
    if($row['status'] == 0){
        echo "<button type='submit' name='publish' value='" . $row['id'] . "'>Publish</button>";
    }
    echo "<button type='submit' name='delete' value='" . $row['id'] . "'>Delete</button>";
    echo "</form>";
    $i++; // increment the counter after each iteration
}

if(isset($_POST['publish'])){
    $id = $_POST['publish'];
    $sql = "UPDATE news_form SET status = 1 WHERE id = '$id'";
    mysqli_query($conn, $sql);
    header('location: Publishednews.php'); // add this line to redirect the user to the Publishednews.php page
}


if(isset($_POST['delete'])){
    $id = $_POST['delete'];
    $sql = "DELETE FROM news_form WHERE id = '$id'";
    mysqli_query($conn, $sql);
}

        ?>
    </div>
</body>
</html>
