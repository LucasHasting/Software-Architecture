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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        Enter the brand name of the product to delete.
        <form action="do_delete.php" method="post" 
              onSubmit="if(confirm('Are you sure?')) return true; return false;">
            Name: <input type="text" name="brand" />
            <input type="submit" />
        </form>
    </body>
</html>
