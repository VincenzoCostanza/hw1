<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{
        $conn=mysqli_connect("localhost","root","","calcisticamente");
        $username=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        
        $prendi="SELECT titolo,immagine FROM preferiti WHERE user='".$username."'";

        $res=mysqli_query($conn,$prendi) or die(mysqli_error($conn));
        $entry=array();
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $entry[]=$row;
            }
        }
        mysqli_free_result($res);
        mysqli_close($conn);
        echo json_encode($entry);
    }    
?>