<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
   if(!isset($_SESSION['user_name'])){
      header('location:login_form.php');
   }


}?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

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
      <h3>hi, <span>admin</span></h3>
      <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>Admin page</p>
      <?php

// Select all users from the database
$sql = "SELECT * FROM user_form";
$result = mysqli_query($conn, $sql);

// Display user information in a table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
 echo "<tr>";
 echo "<td>" . $row['id'] . "</td>";
 echo "<td>" . $row['name'] . "</td>";
 echo "<td>" . $row['email'] . "</td>";
 echo "<td>" . $row['user_type'] . "</td>";
 echo "<td><a href='delete_user.php?id=" . $row['id'] . "'>Delete</a></td>";
 echo "<td><a href='edit_user.php?id=" . $row['id'] . "'>Edit</a></td>";
 echo "</tr>";
}

echo "</table>";
?>
      <a href="login_form.php" class="btn">login</a>
      <a href="register_form.php" class="btn">register</a>
      <a href="logout.php" class="btn">logout</a>
   </div>

</div>
</body>
</html>