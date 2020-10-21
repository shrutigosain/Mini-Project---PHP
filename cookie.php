<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php

            $name = "name";
            $name_value = $_GET['name'];
            $username = "username";
            $username_value = $_GET['username'];
            $location = "location";
            $location_value = $_GET['location'];

            setcookie($name, $name_value, time() + (86400 * 30), "/");
            setcookie($username, $username_value, time() + (86400 * 30), "/");
            setcookie($location, $location_value, time() + (86400 * 30), "/");

            if(!isset($_COOKIE[$name]) || !isset($_COOKIE[$username]) || !isset($_COOKIE[$location])) {
              echo "Cookie is not set!";
            } else {
              echo "Cookie '" . $name . "' is set!<br>";
              echo "Value is: " . $_COOKIE[$name];
              echo "<br/>Cookie '" . $username . "' is set!<br>";
              echo "Value is: " . $_COOKIE[$username];
              echo "<br/>Cookie '" . $location . "' is set!<br>";
              echo "Value is: " . $_COOKIE[$location];
            }

        ?>

        <?php if(isset($_COOKIE[$name]) || isset($_COOKIE[$username]) || isset($_COOKIE[$location])) { ?>
            <form action="logout.php">
                <br><br>
                <input type="submit" value="logout" name="Logout">
            </form>
        <?php } ?>

    </body>
</html>
