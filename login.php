<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="controls.php" method="post">
    <label>email:</label>
    <input name="email" placeholder="Enter your email" type="text">
    <br>
    <hr>
    <label>password:</label>
    <input name="password" placeholder="Enter your password" type="text">
    <br>
    <hr>
    <input name="login" value="Login" type="submit">
    <br>
    <hr>

</form>
<a href="register.php">No account? Register here</a>
</body>
</html>
