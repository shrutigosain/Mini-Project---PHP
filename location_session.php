<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php $_SESSION["location"] = $_POST["location"]; ?>
    </body>
    <script type="text/javascript">

        window.onload = function() {
            window.location.href = "http://localhost/WP2/Mini%20Project/home.php";
        }
    </script>
</html>
