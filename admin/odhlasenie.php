<?php
session_start();

unset($_SESSION['user']);
unset($_SESSION['role']);
header('Location: index.php');

?>