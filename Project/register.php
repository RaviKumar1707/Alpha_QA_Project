<!DOCTYPE html>
<head>
<title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
   <!-- <script type="text/javascript" src="js.js"></script>-->

<body>

    <div class="main">

       <?php
       if (isset($_POST["submit"])) {
        $uname = $_POST["uname"];
        $email = $_POST["email"];
        $pswd1 = $_POST["pswd1"];
        $pswd2 = $_POST["pswd2"];

        $passwordHash = password_hash($pswd1, PASSWORD_DEFAULT);

        $errors = array();

        if(empty($uname) OR empty($email) OR empty($pswd1) OR empty($pswd2)) {
            array_push($errors, "All fields are required");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }

       /*if(strlen($pswd1)<8) {
            array_push($errors, "Password must be atleast 8 characters long"); 
        }*/

        if($pswd1 !== $pswd2) {
            array_push($errors, "Password does not match");
        }

        require_once "database.php";
        $sql = "SELECT * FROM alpharegister WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);

       if ($rowCount>0) {
            array_push($errors, "");
        }

        if (count($errors)>0) {
            foreach ($errors as $error) {
                echo"<div class='alert lert-danger'>$error</div>";
            }
        }
        else{
            
            $sql = "INSERT INTO alpharegister (uname, email, pswd1) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$uname, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>Register Successfully.</div>";
            }else{
                die("Something went wrong");
            }

        }
       }

?>

        <h1>Register</h1>

        <form name="myform" action="register.php"  method="post">

            <p>Username</p>
            <input type="text" name="uname" placeholder="Enter Username">

            <p>Email ID</p>
            <input type="Email" name="email" placeholder="Enter email id">

            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
            <p>Password</p>
            <input type="password" name="pswd1" placeholder="Enter Password">

            <p>Confirm Password</p>
            <input type="password" name="pswd2" placeholder="Re-Enter Password">

             <div id="errorBox"></div>

            <input type="submit" name="submit" value="Register">

            <br><br>
           <p>Already have an account?<a href="userlogin.php">Login</a></p>
        </form>
        
    </div>

</body>
</head>
</html>