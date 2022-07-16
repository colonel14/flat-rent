<?php
    session_start();
    unset($_SESSION['client']);
    header("Location: " . $_SERVER['HTTP_REFERER']);