<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php
            $username = "username";
            $username_value = $_GET['username'];

            setcookie($username, $username_value, time()+60*30, "/");
        ?>
    </body>

    <script type="text/javascript">

    window.onload = function() {
        window.location.href = "http://localhost/WP2/Mini%20Project/home.php";
    }
    </script>
</html>
