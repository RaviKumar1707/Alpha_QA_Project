<!DOCTYPE html>
<head>
<title>Login Form Design</title>
    <link rel="stylesheet" type="text/css" href="style.css">
<body>
    <div class="main">
    <?php
        if(isset($_POST["login"])) {
            $uname = $_POST["uname"];
            $pswd1 = $_POST["pswd1"];
            require_once "database.php";
            $sql = "SELECT * FROM alpharegister WHERE uname = '$uname'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($user) {
                if (password_verify($pswd1,$user["pswd1"])) {
                    echo "<div class = 'alert alert-danger'>Success</div>";
                    header("Location: table.html");
                    die();
                } else{
                    echo "<div class = 'alert alert-danger'>Password does not match</div>";
                }
            }
            else {
                echo "<div class = 'alert alert-danger'>Username invalid</div>";
            }

        }
        ?>
        <h1>Login</h1>

        <form name="myform" action= "userlogin.php" method="POST">
    
            <p class = "required">Username</p>
            <input type="text" name="uname" placeholder="Enter Username/Email">
            
            <p class="required">Password</p>
            <input type="password" name="pswd1" placeholder="Enter Password">
            
            <a href="forget.html">Forgot Password?</a>
  
            <br><br>

            <div id="errorBox"></div>
            <input type="submit" id ="loginBtn" name="login" value="Login" >

            <br><br>
            <p>New user?<a href="register.php">Register</a></p>

        </form>
        
    </div>
</body>
</head>
</html>