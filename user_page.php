<?php

@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
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

<div class="container">
<form method="get" action="" class="search-form">
  <label for="search">Search Title:</label>
  <input type="text" id="search" name="search" placeholder="Мэдээгээ хайна уу?">
  <button type="submit">Search</button>
</form>
<div class="container">
   <nav class="navbar">
   <a href="newscreate.php" class="navbar-item">Create News</a>
   <a href="shownews.php" class="navbar-item">drafts</a>
      <a href="Publishednews.php" class="navbar-item">view news</a>
      <a href="logout.php" class="navbar-item">Logout</a>
   </nav> 
   <div class="content">
   <h1><span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>user information</p>
      <?php

      // Өгөгдлийн сангаас одоогийн хэрэглэгчийг хайна.
      $sql = "SELECT * FROM user_form WHERE name='" . $_SESSION['user_name'] . "'";
      $result = mysqli_query($conn, $sql);

      // Display the user's account information in a table
      echo "<table>";
      echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";

      while ($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<td>" . $row['id'] . "</td>";
         echo "<td>" . $row['name'] . "</td>";
         echo "<td>" . $row['email'] . "</td>";
         if (isset($row['role'])) {
           echo "<td>" . $row['role'] . "</td>";
         } else {
           echo "<td></td>";
         }
         echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Edit</a></td>";
         echo "<td><a href='edit_password.php?id=" . $row['id'] . "'>change password</a></td>";
         echo "</tr>";
        }

      echo "</table>";
      ?>
            <?php
// Get the search term from the GET request
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if (!empty($searchTerm)) {
  // Select all news articles that match the search term
  $sql = "SELECT * FROM news_form WHERE status = 1 AND title LIKE '%$searchTerm%'";
  $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result) == 0) {
    echo "Ийм гарчигтай мэдээ олдсонгүй.";
  } else {
    $i = 1; // initialize the counter
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<h2>" . $i . ". " . $row['title'] . "</h2>";
      echo "<a href='news_id.php?news_id=" . $row['id'] . "'>Read More</a>";

      echo "</form>";
      $i++; // increment the counter after each iteration
    }
  }
}
?>
   </div>

</div>

</body>
</html>
