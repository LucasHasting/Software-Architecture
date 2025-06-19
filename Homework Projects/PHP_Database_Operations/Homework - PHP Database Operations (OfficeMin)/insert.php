<?php session_start() ?>
<?php
    if (isset($_SESSION['user'])) {
        $username = $_SESSION['user'];
    } else {
        header("location:login.php");
	exit;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        Welcome, <?= $username ?>
        <p />
        <form action="do_insert.php" method="post">
            Brand: <input type="text" name="brand"><br/>
            Product: <input type="text" name="product"><br/>
            Price: <input type="number" name="price"><br />
            <br/>
            <input type="submit"/>
        </form>
    </body>
</html>
