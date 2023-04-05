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

   </style>
</head>
<body>
   

      <?php

// Өгөгдлийн сангаас одоогийн хэрэглэгчийг хайна.
$sql = "SELECT * FROM user_form WHERE name='" . $_SESSION['admin_name'] . "'";
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