<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

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
   </style>

</head>
<body>
   
<div class="container">

   <div class="content">
      <h3>hi, <span>user</span></h3>
      <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>this is an user page</p>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
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
   </div>

</div>

</body>
</html>
