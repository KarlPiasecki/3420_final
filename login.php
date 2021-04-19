<?php include_once 'header.php'; ?>

<body style="background-image: url('login.jpg');">

<div class="login">

  <h2>Login</h2>

  <form action="includes/login.inc.php" method="post">
  <label for="name">Email/Username:</label>
  <input type="text" name="username" placeholder="Enter your email or username">

  <label for="password">Password:</label>
  <input type="password" name="password" placeholder="Enter your password">

  <input type="submit" value="LOGIN" name="login">
  </form>

  <?php

  if (isset($_GET["error"])) {
    if ($_GET["error"] == "failedlogin") {
      echo "<p>Incorrect login credentials</p>";
    }
    else if ($_GET["error"] == "loginmissinginput") {
      echo "<p>All fields are required</p>";
    }
  }
  ?>

  <h2>Register</h2>
  
  <form action="includes/register.inc.php" method="post">
  <label for="name">Create your username:</label>
  <input type="text" name="username" placeholder="Enter a username">

  <label for="email">Enter your email address:</label>
  <input type="email" name="email" placeholder="Enter your email">

  <label for="password">Create your password:</label>
  <input type="password" name="password" placeholder="Enter a password">
  <label for="password">Verify your password:</label>
  <input type="password" name="password2" placeholder="Repeat password">

  <input type="submit" value="REGISTER" name="register">
  </form>

  <?php

  if (isset($_GET["error"])) {
    if ($_GET["error"] == "missinginput") {
      echo "<p>All fields are required</p>";
    }
    else if ($_GET["error"] == "invalidEmail") {
      echo "<p>Email entered is invalid</p>";
    }
    else if ($_GET["error"] == "failedverify") {
      echo "<p>Passwords don't match</p>";
    }
    else if ($_GET["error"] == "usernameTaken") {
      echo "<p>That username is not available</p>";
    }
    else if ($_GET["error"] == "failedstmt") {
      echo "<p>An error has occured. Try again</p>";
    }
  }

  ?>

</div>

</body>
</html>