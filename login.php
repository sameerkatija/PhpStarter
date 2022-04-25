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
    <link rel="stylesheet" href="./assets/stylings/login.css?v=<?php echo time(); ?>">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>
     <?php
      $name = "";
      $email = "";
      $password = "";
     
      $userID = '';
      $okay = true;
       if (isset($_POST["loginSubmit"])) {
           if (!isset($_POST["loginEmail"]) || $_POST["loginEmail"] === "") {
                    $okay = false;
                } else {
                    $email = $_POST["loginEmail"];
                }
                 if (!isset($_POST["loginPassword"]) || $_POST["loginPassword"] === "") {
                    $okay = false;
                } else {
                    $password = $_POST["loginPassword"];
                }
                if ($okay == false) {
                    echo "Some input fields are missing";
                } else {

                try {
                        $conn = new mysqli('localhost', 'root', '', 'webengdb');
                        // adding retrieve
                        $results = $conn->query("select * from userinfo where EMAIL = '$email';");
                        // echo $results[0];
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $row = mysqli_fetch_assoc($results);
                        // echo implode(" ", $row);
                            if($row){
                                if(password_verify($password, $row['PASSWORD'])){
                                    $expire = strtotime("+1 year");
                                    setcookie('userlogin' , $email , $expire);    
                                    echo '<script type="text/javascript">',
                                     'const redirecttoMain = () => {window.location.href = "./main.php" };',
                                    'redirecttoMain();',
                                    '</script>';
                                } else {
                                    echo "Incorrect password";
                                    echo '<script type="text/javascript">',
                                     'const redirecttoMain = () => {window.location.href = "./login.php" };',
                                    'redirecttoMain();',
                                    '</script>';
                                }
                            } else {
                                echo '<script type="text/javascript">',
                                     'const redirecttoMain = () => {window.location.href = "./login.php" };',
                                    'redirecttoMain();',
                                    '</script>';
                            }
                                
                            
                        $conn->close();
                        $name = "";
                        $email = "";
                        $password = "";
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                            }
                    } catch(Exception $e){
                        $error_message = $e->getMessage();
                        echo "<p>Error Message: $error_message</p>";
                    }
                 }
                    
       }

       if (isset($_POST["registerSubmit"])) {
           if (!isset($_POST["registerName"]) || $_POST["registerName"] === "") {
                    $okay = false;
                } else {
                    $name = $_POST["registerName"];
                }
                 if (!isset($_POST["registerEmail"]) || $_POST["registerEmail"] === "") {
                    $okay = false;
                } else {
                    $email = $_POST["registerEmail"];
                }
                 if (!isset($_POST["registerPassword"]) || $_POST["registerPassword"] === "") {
                    $okay = false;
                } else {
                    $password = $_POST["registerPassword"];
                }
                if ($okay == false) {
                    echo "Some input fields are missing";
                } else {

                try {
                        $conn = new mysqli('localhost', 'root', '', 'webengdb');
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                         $stmt = $conn->prepare("insert into userinfo (NAME, EMAIL, PASSWORD) values ('$name' , '$email' , '$hashed_password' )");
                         $flag = $stmt->execute();
                         $conn->close();
                         if ($flag == true)
                    {
                        $expire = strtotime("+1 year");
                        setcookie('userlogin' , $email , $expire);
                        echo '<script type="text/javascript">',
                        'const redirecttoMain = () => {window.location.href = "./main.php" };',
                        'redirecttoMain();',
                         '</script>';
                        $name = "";
                         $email = "";
                         $password = "";
                    }
                    else
                    {
                        echo "user not added because of ".$conn->error;
                    }
                        // adding retrieve
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
    <form class='form-body' action="" method="post">
    <div class="login-reg-panel">
		<div class="login-info-box">
			<h2>Have an account?</h2>
			<p>Login to see latest news.</p>
			<label id="label-register" for="log-reg-show">Login</label>
			<input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
		</div>
							
		<div class="register-info-box">
			<h2>Don't have an account?</h2>
			<p>Signup now to see latest news.</p>
			<label id="label-login" for="log-login-show">Register</label>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
				<h2>LOGIN</h2>
				<input name='loginEmail' type="email" placeholder="Email">
				<input name='loginPassword' type="password" placeholder="Password">
				<input name = 'loginSubmit' type="submit" value="Login">
				<a href="">Forgot password?</a>
			</div>
			<div class="register-show">
				<h2>REGISTER</h2>
                <input name='registerName' type="text" placeholder="Name">
				<input name='registerEmail' type="email" placeholder="Email">
				<input name='registerPassword' type="password" placeholder="Password">
				<input name='registerSubmit'  type="submit" value="Register">
			</div>
		</div>
	</div>
    </form>
<script src='./assets/js/login.js'></script>
</body>
</html>