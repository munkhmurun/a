<?php

session_start();


// Check if the form has been submitted
if(isset($_POST['submit'])){

  // Include the database connection
  include 'config.php';

  // Sanitize and validate the new password
  $new_password = md5($_POST['new_password']);
   $confirm_password = md5($_POST['confirm_password']);
  $errors = array();

  if(empty($new_password)){
    $errors[] = "Please enter a new password";
  }

  if(empty($confirm_password)){
    $errors[] = "Please confirm your new password";
  }

  if($new_password !== $confirm_password){
    $errors[] = "The new password and confirmation password do not match";
  }

  if(count($errors) === 0){

    // Hash the new password
    $hashed_password = md5($_POST['new_password']);

    // Update the user's password in the database
    $sql = "UPDATE user_form SET password='$hashed_password' WHERE name='" . $_SESSION['user_name'] . "'";
    $result = mysqli_query($conn, $sql);

    if($result){
      header('location:user_page.php');
    } else {
      $errors[] = "An error occurred while updating your password";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Password</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      label {
         display: block;
         margin-bottom: 0.5rem;
      }

      input[type="password"] {
         width: 100%;
         padding: 0.5rem;
         border-radius: 0.25rem;
         border: 1px solid #ccc;
         margin-bottom: 1rem;
      }

      .error {
         color: red;
         margin-bottom: 1rem;
      }
   </style>

</head>
<body>

<div class="container">

   <div class="content">
      <h1>Edit Password</h1>

      <?php
        if(isset($errors) && count($errors) > 0){
          foreach($errors as $error){
            echo "<p class='error'>$error</p>";
          }
        }
      ?>

      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
         <label for="new_password">New Password:</label>
         <input type="password" id="new_password" name="new_password" required>

         <label for="confirm_password">Confirm Password:</label>
         <input type="password" id="confirm_password" name="confirm_password" required>

         <button type="submit" name="submit">Save Changes</button>
      </form>

   </div>

</div>

</body>
</html>
