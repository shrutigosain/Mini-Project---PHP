<?php
setcookie('name', null, -1, '/');
setcookie('username', null, -1, '/');
setcookie('location', null, -1, '/');


echo'<script>alert("cookie deleted Successfully")</script>';
?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <p>Cookies are deleted</p>

        <form action="signup_seller.php">
            <input type="submit" value="Signup Seller" />
        </form>
    </body>
</html>
