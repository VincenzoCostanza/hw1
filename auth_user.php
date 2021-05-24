<?php
    require_once 'configurazioneDB.php';
    session_start();

    function checkAuth() {
        if(isset($_SESSION['calcisticamente_utente'])) {
            return $_SESSION['calcisticamente_utente'];
        } else{ 
            return 0;
        }    
    }
?>