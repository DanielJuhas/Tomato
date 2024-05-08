<?php
session_start();
require('../lib/db.php');

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //ckecks if everithing is filled
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["username"])) {

        // checks if the email is correct
        if (strpos($_POST["email"], "@")) {

          $username = filter_var($_POST["username"]);
          $email = filter_var($_POST["email"]);
          $heslo = filter_var($_POST["password"]);
          
          // makes hash password
          $hash = password_hash($heslo, PASSWORD_DEFAULT);

          // saves data to db
          $connection = dbserver_conn();
          $sql = "INSERT INTO pouzivatelia (username,email,hash) VALUES ('$username','$email','$hash')";
          sql_exec($connection,$sql);

          header("Location: /login");
          
          $connection->close();
        } else {
          $message = "Neplatná emailová adresa!";
        }
    } else {
      $message = "Prosím vyplnte všetky polia!";
    }

}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Registration Page</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    banner{
    width: 100%;
    height: 100%;
    background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)), url(grass-clippings-in-text.jpg);
    background-size: cover;
    background-position: center;
}

    body {
      background-image: url(grass-clippings-in-text.jpg);
      background-size: cover;
      font-family: 'Open Sans', sans-serif;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  
    h1 {
      color: white;
      text-align: center;
      margin-top: 2em;
    }
  
    form {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
      width: 500px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }
  
    label {
      color: Black;
      font-size: 1.2em;
      margin-bottom: 10px;
    }
  
    input[type="text"], input[type="email"], input[type="password"] {
      padding: 10px 20px;
      font-size: 1.2em;
      margin-bottom: 20px;
      border-radius: 5px;
      border: none;
      width: 100%;
      outline: none;
    }
  
    input[type="submit"] {
      background-color: #029855;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      margin-top: 20px;
      font-size: 1.2em;
      width: 100%;
      outline: none;
    }
  
    input[type="submit"]:hover {
      background-color: #029855;
    }
  </style>
  
</head>
<body>
  <h1>Registration</h1>
  <a href="../index.html">
    <img src="spickovi-travnik-website-favicon-white.png" class="logo">
  </a>

  <main>
    <form method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="Submit">
      <?= $message ?>
    </form>
  </main>
  <footer>
    
  </footer>
</body>
</html>
