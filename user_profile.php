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
      .container {
    min-height: 100vh;
    display: flex;
    align-items: stretch;
    justify-content: space-evenly;
    padding: 20px;
    padding-bottom: 60px;
    flex-wrap: wrap;
    flex-direction: row;
    align-content: flex-start;
}
   </style>
</head>
<body>
   
<div class="container">

   <div class="content">
      <p>Бүртгэлтэй хэрэглэгчид</p>
      <?php

// Select all users from the database
$sql = "SELECT * FROM user_form";
$result = mysqli_query($conn, $sql);

// Display user information in a table
echo "<table>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Delete</th><th>Edit</th></tr>";

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
           <form method="post" action="excel.php">
        <input type="submit" name="export" class="btn btn-outline-light ms-2" value="хэрэглэгчдийн мэдээлэл татах" />
        </form>
   </div>

</div>
</body>
</html>