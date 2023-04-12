<?php

@include 'config.php';

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $gender = $_POST['gender'];
   
   $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";
   
   $result = mysqli_query($conn, $select);
   
   if(mysqli_num_rows($result) > 0){
   
      $error[] = 'user already exist!';
   
   }else{
   
      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type, gender) VALUES('$name','$email','$pass','$user_type','$gender')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }
   
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
</head>
<style>
   /* Body styles */
body {
   margin: 0;
   padding: 0;
   font-family: Arial, sans-serif;
   background-color: #f2f2f2;
}

/* Form container styles */
.form-container {
   width: 400px;
   margin: 50px auto;
   padding: 20px;
   background-color: #fff;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

/* Form heading styles */
.form-container h3 {
   margin-top: 0;
   text-align: center;
}

/* Error message styles */
.error-msg {
   display: block;
   margin: 5px 0 10px;
   color: red;
   font-size: 14px;
}

/* Form input styles */
.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container select {
   display: block;
   width: 100%;
   margin-bottom: 15px;
   padding: 10px;
   border-radius: 5px;
   border: none;
}

/* Form select styles */
.form-container select {
   background-color: #f2f2f2;
}

/* Form button styles */
.form-btn {
   display: block;
   width: 100%;
   margin-top: 20px;
   padding: 10px;
   border-radius: 5px;
   border: none;
   background-color: #007bff;
   color: #fff;
   font-size: 16px;
   cursor: pointer;
   transition: background-color 0.3s ease-in-out;
}

/* Form button hover styles */
.form-btn:hover {
   background-color: #0069d9;
}

/* Form paragraph styles */
.form-container p {
   margin-top: 20px;
   text-align: center;
}

/* Form link styles */
.form-container a {
   color: #007bff;
   text-decoration: none;
}

/* Form link hover styles */
.form-container a:hover {
   text-decoration: underline;
}

</style>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Бүртгүүлэх</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Нэр">
      <input type="email" name="email" required placeholder="Email">
      <input type="password" name="password" required placeholder="Нууц үгээ оруулна уу.">
      <input type="password" name="cpassword" required placeholder="Нууц үгээ дахин бичнэ үү. ">
      <select name="gender">
   <option value="">Хүйсээ сонго</option>
   <option value="Эрэгтэй">Эрэгтэй</option>
   <option value="Эрэгтэй">Эмэгтэй</option>
   </select>

      <select name="user_type">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>аль хэдийн бүртгэлтэй юу? <a href="login_form.php">Нэвтрэх</a></p>
   </form>

</div>

</body>
</html>