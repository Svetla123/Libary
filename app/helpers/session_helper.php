<?php
    session_start();

    function isLoggedIn() {
        if (isset($_SESSION['zaposlenik_ID'])) {
            return true;
        } else {
            return false;
        }
    }
