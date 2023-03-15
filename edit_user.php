<?php

// Include the database connection file
include('config.php');

// Get the ID of the user to be edited
$id = $_GET['id'];

// Retrieve the user's information from the database
$sql = "SELECT * FROM user_form WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the submit button has been clicked
if (isset($_POST['submit'])) {

   // Retrieve the updated information from the form
   $name = $_POST['name'];
   $email = $_POST['email'];
   $user_type = $_POST['user_type'];

   // Update the user's information in the database
   $sql = "UPDATE user_form SET name='$name', email='$email', user_type='$user_type' WHERE id='$id'";
   $result = mysqli_query($conn, $sql);

   // Redirect the user to the admin page
   header("Location: admin_page.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit User</title>
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

h1 {
  margin: 2rem 0;
  text-align: center;
}

form {
  width: 50%;
  margin: 0 auto;
  background-color: #fff;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

label {
  display: block;
  margin-bottom: 0.5rem;
}

input,
select {
  display: block;
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-sizing: border-box;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #388e3c;
}

</style>
</head>
<body>
   <h1>Edit User</h1>
   <form method="post">
   <label for="name">Name:</label>
  <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>" required>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>" required>


  <label for="user_type">Role:</label>
  <select id="user_type" name="user_type" required>
     <option value="user" <?php if ($row['user_type'] == 'user') echo 'selected' ?>>User</option>
     <option value="admin" <?php if ($row['user_type'] == 'admin') echo 'selected' ?>>Admin</option>
  </select>

  <button type="submit" name="submit">Save Changes</button>
  </form>
</body>
</html>