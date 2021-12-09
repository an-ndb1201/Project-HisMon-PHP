<?php
require_once('../Admin/lib/function.php');

unset($_SESSION['user_name_lg']);
// $_SESSION['username'] = NULL;

redirect_to('dangnhap.php');
exit;
?>