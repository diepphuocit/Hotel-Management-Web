<?php
    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    function requiredLogin() {
        if (!isLoggedIn()) {
            header("Location: ../login.php");
            exit();
        }
    }

?>