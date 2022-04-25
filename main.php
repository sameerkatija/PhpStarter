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
    <link rel='stylesheet' href='./assets/stylings/login.css' />
    <title>Login</title>
</head>
<body>
    <?php
     try {
                        $conn = new mysqli('localhost', 'root', '', 'webengdb');
                        // adding retrieve
                        $email = ($_COOKIE["userlogin"]) ? $_COOKIE["userlogin"] : '';
                        $results = $conn->query("select NAME from userinfo where EMAIL = '$email';");
                        // echo $results[0];
                        $name = '';
                        $row = mysqli_fetch_assoc($results);
                        // echo implode(" ", $row);
                            if($row){
                               $name = implode(" " , $row);
                            } 
                            $conn->close();
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            }
                    } catch(Exception $e){
                        $error_message = $e->getMessage();
                        echo "<p>Error Message: $error_message</p>";
                    }

                    if (isset($_POST["submit"])) {

                       setcookie("userlogin", "", time() - 3600);
                        echo '<script type="text/javascript">',
                        'const redirecttoMain = () => {window.location.href = "./" };',
                        'redirecttoMain();',
                                    '</script>';

                        die();
                    }
                     if (isset($_POST["name"])) {
                         if (isset($_POST["name"]) and $_POST["name"] !== "") {
                       try {
                            $conn = new mysqli('localhost', 'root', '', 'webengdb');
                            $results = $conn->query("select * from userinfo where EMAIL = '$email';");
                            $row = mysqli_fetch_assoc($results);
                            if($row){
                                $newName = $_POST["nameField"];
                               $conn->query("UPDATE userinfo SET NAME='$newName';");
                                echo '<script type="text/javascript">',
                                'const redirecttoMain = () => {window.location.href = "./main.php" };',
                                'redirecttoMain();',
                                '</script>';
                                $name = $newName;
                                die();
                            }
                            if ($conn->connect_error) {
                             die("Connection failed: " . $conn->connect_error);
                         }
                       } catch(Exception $e){
                        $error_message = $e->getMessage();
                        echo "<p>Error Message: $error_message</p>";
                    
                     }
                    }
                    }
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class='container'>
  <a class="navbar-brand" href="#">Main Screen</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Main (current)</a>
      </li>
      <!-- <li class="nav-item">
        <button class="nav-link bg-danger rounded" onclick="signout()">Signout</button>
      </li> -->
    </ul>
  </div>
  </div>
</nav>
<div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Welcome <span class='border-bottom'><?php echo $name; ?></span></h1>
        <br />
        <p class="col-md-8 fs-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis voluptas adipisci mollitia amet reprehenderit voluptatem quos deserunt, beatae officia maiores. Suscipit sint ad excepturi, dignissimos beatae assumenda ipsum tempora facilis!</p>
        <form method='post' action=''>
        <br />
        <br />
        <div class="input-group mb-3">
        <input class="form-control" type='input' value="<?php echo $name; ?>" name='nameField' placeholder='Name'/>
        <input class="btn btn-primary btn-lg" type="submit" name='name' value='Change Name'/>
        </div>
        <input class="btn btn-danger btn-lg" type="submit" name='submit' value='Sign out'/>
        
       
        </form>
      </div>
    </div>
</body>
</html>

