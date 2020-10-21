<?php
    session_start();
    setcookie('username', null, -1, '/');

    session_unset();
    session_destroy();
?>

<script type="text/javascript">
    window.onload = function() {
        window.location.href = "http://localhost/WP2/Mini%20Project/home.php";
    }
</script>
