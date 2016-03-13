<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Name of Calendar - Login</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body>

<header class="container">
<div class="row">
  <h1 class="col-xs-8 col-sm-6 col-md-8"><a href="#" target="_self">Name of Calendar</a></h1>
  <nav class="col-xs-4 col-sm-6 col-md-4 text-right">
    <p><a href="../about.php" target="_self">About</a></p>
  </nav>
  </div>
  </header>
  
  <section class="container">
  <div class="row">
  <figure class="col-sm-12">
  <!-- login form box -->
<form method="post" action="index.php" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
<br>
    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
<br>
    <input type="submit"  name="login" value="Log in" />

</form><br>
  <p><a href="../index.php" target="_self">back to the calendar...</a></p>
</figure>
</div>
</section>
  
  <footer class="container">
    <div class="row">
      <p class="col-xs-3">&copy; <?php echo date("Y") ?></p> 
      <ul class="col-xs-9">
        <a href="/login/" target="_self">Admin Login</a>
      </ul>
    </div>
  </footer>

</body>
</html>




<!--<a href="register.php">Register new account</a> -->
