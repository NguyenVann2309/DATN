<?php
session_start();
if(isset($_SESSION['User']) && !isset($_SESSION['Admin'])){
    unset($_SESSION['User']);
    header("Location: home_page.php");
}

else{
    unset($_SESSION['Admin']);
    header("Location: dangnhap.php");
}
// session_unset();
// header("Location: home_page.php");
exit();
?>