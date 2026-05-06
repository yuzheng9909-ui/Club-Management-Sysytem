<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<link href="style.css" rel="stylesheet" type="text/css" />

<div id="bg">
    <div id="outer">

        <div id="header">
            <div id="logo">
                <h1>
                    <a href="login.php">Club System</a>
                </h1>
            </div>
        </div>

        <div id="main">
            <div id="content">
                <div id="box1" style="max-width:500px; margin:auto;">

                    <h2>Login</h2>

                    <form method="POST">
                        <p>Username</p>
                        <input type="text" name="username" required style="width:100%; padding:10px; margin-bottom:20px;">

                        <p>Password</p>
                        <input type="password" name="password" required style="width:100%; padding:10px; margin-bottom:20px;">

                        <button type="submit" class="featureButton">Login</button>
                    </form>

                    <p style="color:red;"><?php echo $error; ?></p>

                </div>
            </div>

            <br class="clear" />
        </div>
    </div>
</div>