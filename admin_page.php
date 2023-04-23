<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <style>
      table {
         border-collapse: collapse;
         width: 100%;
         margin: 0 auto;
         margin-top: 2rem;
      }

      th, td {
         text-align: left;
         padding: 0.5rem;
      }

      th {
         background-color: #4CAF50;
         color: white;
      }

      tr:nth-child(even) {
         background-color: #f2f2f2;
      }
      .container {
    display: flex;
    align-content: stretch;
    flex-wrap: nowrap;
    justify-content: flex-start;
    flex-direction: column;
    align-items: stretch;
}
.navbar {
  background-color: #f2f2f2;
  border: 1px solid #ddd;
  padding: 1rem;
  display: flex;
}

.navbar-item {
  margin: 0 0.5rem;
  padding: 0.5rem;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
  color: #333;
  transition: background-color 0.3s ease;
}

.navbar-item:hover {
  background-color: #ddd;
}
.search-form {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px 0;
}

label {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

input[type="text"] {
  padding: 10px;
  font-size: 16px;
  border: 2px solid #ccc;
  border-radius: 5px;
  flex: 1;
}

button[type="submit"] {
  padding: 10px 20px;
  background-color: #0066cc;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #0052a3;
}

   </style>
</head>
<body>
<form method="get" action="" class="search-form">
  <label for="search">Search Title:</label>
  <input type="text" id="search" name="search" placeholder="Мэдээгээ хайна уу?">
  <button type="submit">Search</button>
</form>

<div class="container">
   <nav class="navbar">
      <a href="user_profile.php" class="navbar-item">Users profile</a>
      <a href="newscreate.php" class="navbar-item">Create News</a>
      <a href="admin_profile.php" class="navbar-item">Profile</a>
      <a href="Publishednews.php" class="navbar-item">show news</a>
      <a href="shownews.php" class="navbar-item">drafts</a>
      <a href="gender.php" class="navbar-item">pie gender graph</a>
      <a href="news_chart.php" class="navbar-item">news chart</a>
      <a href="logout.php" class="navbar-item">Logout</a>
   </nav> 
  
   <div class="content">
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>Admin page</p>
      
      <?php

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($searchTerm)) {
 
  $sql = "SELECT * FROM news_form WHERE status = 1 AND title LIKE '%$searchTerm%'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 0) {
    echo "Ийм гарчигтай мэдээ олдсонгүй.";
  } else {
    $i = 1; 
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $i . ". " . $row['title'] . "</h2>";
      echo "<a href='news_id.php?news_id=" . $row['id'] . "'>Read More</a>";

      echo "</form>";
      $i++;
    }
  }
}
?> 
   </div>
</div>
</body>
</html>

