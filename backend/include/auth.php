<?php
if (!isset($_SESSION['isLogin'])) {
    $_SESSION['status'] = 'You dont have access to this page';
    $_SESSION['title'] = 'Sorry !';
    $_SESSION['icon'] = 'error';
    // echo "<script>window.location.href = 'login.php';</script>";
    header('location:login.php');
    exit;
}
