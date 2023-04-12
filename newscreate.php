<?php

@include 'config.php';
// Check if the form is submitted
if(isset($_POST['submit'])){

  // Get the form input
  
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $body = mysqli_real_escape_string($conn, $_POST['body']);
  $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
  $Created_date = date('Y-m-d H:i:s');
  $type = mysqli_real_escape_string($conn, $_POST['type']);


  // Insert the news into the database
  $query = "INSERT INTO news_form (title, body, image_url, status, user_id, Created_date, type) VALUES ('$title', '$body', '$image_url', '0', 16, '$Created_date', '$type')";

  if(mysqli_query($conn, $query)){
      echo "News created successfully";
      header('Location: shownews.php');
      exit();
  } else{
      echo "Error creating news: " . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Include the TinyMCE library -->
    <script src="https://cdn.tiny.cloud/1/3iodql82bev57mfn37jcfqn7miqfbrfc0ge1hwhgg9y67l0t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
// Initialize the TinyMCE editor
tinymce.init({
  selector: '#body', // The ID of the textarea element
  plugins: 'advlist autolink lists link image charmap print preview anchor',
  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | image',
  height: 300, // The height of the editor in pixels
  required: true // Make the editor required
});
</script>


</head>
<body>

<div class="form-container">

<form action="" method="post">
  <h1>Create news</h1>
  <?php
  if (isset($error)) {
    foreach ($error as $error_msg) {
      echo '<span class="error-msg">' . htmlspecialchars($error_msg) . '</span>';
    }
  }
  ?>
 <label for="title">Title:</label>
<input type="text" id="title" name="title" required placeholder="News item title">
<br>
<label for="image_url">Image URL:</label>
<input type="text" id="image_url" name="image_url" placeholder="News item image URL">
<br>
<label for="type">Төрөл:</label>
<select id="type" name="type">
  <option value="Үзвэр үйлчилгээ">Үзвэр үйлчилгээ</option>
  <option value="Улс төр">Улс төр</option>
</select>
<br>
<label for="body">Body:</label>
<textarea id="body" name="body" placeholder="Enter news content"></textarea>  
<button type="submit" name="submit">Create news</button>

</form>
</div>
</body>
</html>
