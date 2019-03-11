<?php
    session_start();
    
    unset($_SESSION['ses_id']);
    unset($_SESSION['ses_pw']);
    unset($_SESSION['ses_name']);
    
    unset($_SESSION['ses_mgr_id']);
    unset($_SESSION['ses_mgr_pw']);
    unset($_SESSION['ses_mgr_name']);
    
    Header("Location:../index.php");
?>