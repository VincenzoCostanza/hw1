<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{ 
        $conn=mysqli_connect("localhost","root","","calcisticamente");

        $username=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        $competizione_id=mysqli_real_escape_string($conn,$_GET['id_comp']);

        $rimuovi="DELETE FROM preferiti WHERE user='".$username."' AND id='".$competizione_id."'";

        $conn_2=mysqli_connect("localhost","root","","calcisticamente");
        $prendi="SELECT titolo,immagine FROM preferiti WHERE id='".$competizione_id."'";

        $res=mysqli_query($conn,$rimuovi) or die(mysqli_error($conn));
        $entry=array();
        if($res){
            $res=mysqli_query($conn_2,$prendi);
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                    $entry[]=$row;
                }
            }
            mysqli_free_result($res);
            mysqli_close($conn);
            mysqli_close($conn_2);
            echo json_encode($entry);
        }
    }    