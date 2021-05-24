<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{
        $conn=mysqli_connect("localhost","root","","calcisticamente");
        
        $username=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        $post_id=mysqli_real_escape_string($conn,$_GET['post_id']);
        
        $prendi_commenti_precedenti="SELECT user,commento FROM commenti where id='".$post_id."'";

        $res=mysqli_query($conn,$prendi_commenti_precedenti) or die(mysqli_error($conn));
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