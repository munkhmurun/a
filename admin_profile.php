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
</head>
<style>
   table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #555;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

a {
  color: blue;
}
div {
  width: 50%;
  margin: 0 auto;
  background-color: #f0f0f0;
  padding: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

a {
  text-decoration: none;
  color: #4CAF50;
}


</style>
<body>
   
   <div>
      <?php

$sql = "SELECT * FROM user_form WHERE name='" . $_SESSION['admin_name'] . "'";
$result = mysqli_query($conn, $sql);

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
</body>
</html>