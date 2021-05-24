<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{ 
        $conn=mysqli_connect("localhost","root","","calcisticamente");

        $post_id=mysqli_real_escape_string($conn,$_GET['post_id']);
        $prendi="SELECT user FROM likes WHERE id='".$post_id."'";
        $res=mysqli_query($conn,$prendi) or die(mysqli_error($conn));
        $risultati=array();
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                $risultati[]=$row;
            }
            mysqli_free_result($res);
            mysqli_close($conn);
            echo json_encode($risultati);
        }
    }
?>     