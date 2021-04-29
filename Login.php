<?php
require "Scripts/S_Login.php";
$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/ClientLogin.css">
    <meta charset="utf-8">
    <title> Login </title>
</head>
<body>

<center>
    <div class="user">
        <form method="post">
            <h1>Client connexion</h1><br>
            <input class="input" type="email" name="username" placeholder="username" required>
            <br>
            <input class="input" type="password" name="password" placeholder="password" required>
            <br>
            <input type="submit" name="submit" value="login">
        </form>
    </div>
</center>
</body>
<?php if (isset($_POST["submit"])) LoginClient($conn); ?>
</html>