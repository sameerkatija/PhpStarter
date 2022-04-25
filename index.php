<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./assets/stylings/main.css?v=<?php echo time(); ?>">
    <title>GCU | HomePage</title>
</head>
<body>
    <?php
    //   $dns = "mysql -u root -p:host=localhost;dbname=webengdb;";
      
      try {
        $conn = new mysqli('localhost', 'root', '', 'webengdb');
        if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
            }
      } catch(Exception $e){
          $error_message = $e->getMessage();
          echo "<p>Error Message: $error_message</p>";
      }
      $userID = '';
      if($_COOKIE['userlogin']){
          $userID = $_COOKIE['userlogin'];
      }
    ?>
    
    <div id="landing-header">
        <h1>Welcome to Gcu Lahore!</h1>
        
        </br>
        <!-- <form method='post' action='index.php'> -->
        <!-- <input type='submit' name='redirect-user' class="btn btn-lg btn-success" value='View More'> -->
        <!-- </form> -->
        <button class="btn btn-lg btn-success" onclick='checkLogin(<?php echo(json_encode($userID)); ?>)'>Signin or continue!</button>
    </div>

    <ul class="slideshow">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
   <script src="./assets/js/index.js">

   </script>
</body>
</html>