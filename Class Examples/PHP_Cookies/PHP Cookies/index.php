<html>
<body>
    <?php
        if (isset($_COOKIE["user"])){
            echo "Welcome Back " . $_COOKIE["user"] . "<br>";
        } else {
    ?>
    <form action="welcome.php" method="post">
    Name: <input type="text" name="name" />
    Password: <input type="password" name="pwd" />
    Remember Me: <input type="checkbox" name="remember" value="ON" />
    <input type="submit" />
    </form>
    <?php
        }
    ?>

</body>
</html>