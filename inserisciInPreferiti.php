<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{
        $conn=mysqli_connect("localhost","root","","calcisticamente");

        $username=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        $titolo=mysqli_real_escape_string($conn,$_GET['nome']);
        $immagine=mysqli_real_escape_string($conn,$_GET['img']);

        $inserisci="INSERT INTO preferiti(user,titolo,immagine) values('".$username."','".$titolo."','".$immagine."')";

        $res=mysqli_query($conn,$inserisci) or die(mysqli_error($conn));

        mysqli_free_result($res);
        mysqli_close($conn);
    }
?>