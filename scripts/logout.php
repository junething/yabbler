 <?php
session_start();
if(isset($_SESSION['signedIn']))
    unset($_SESSION['signedIn']); 
session_destroy();
?>
