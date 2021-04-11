<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location:login.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
if(isset($_GET['status'])){
    if($_GET['status']==1){
        echo "<h1 style='color: green'><strong>Update success</strong></h1>";
    }
}
echo $_SESSION['name'];
?>
<h1>Update your password</h1>
<form action="controls.php" method="post">
    <input name="id" type="text" hidden value="<?php echo $_SESSION['id'] ?>">
    <input name="name" type="text" hidden value="<?php echo $_SESSION['name'] ?>">
    <input name="email" type="text" hidden value="<?php echo $_SESSION['email'] ?>">
    <br>
    <hr>
    <label>New Password:</label>
    <input name="password" placeholder="Enter your new password" type="text">
    <br>
    <hr>
    <input name="update" value="Update" type="submit">
    <br>
    <hr>

</form>
<br>
<a href="logout.php">Logout</a>
</body>
</html>
