<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{ 
        $conn=mysqli_connect("localhost","root","","calcisticamente");

        $username_1=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        $post_id=mysqli_real_escape_string($conn,$_GET['postid']);

        $rimuovi="DELETE FROM likes WHERE user='".$username_1."' AND id='".$post_id."'";
        //Ho creato un trigger che mi decrementa i like e appunto tramite esso prenderò il numero di like
        $conn_2=mysqli_connect("localhost","root","","calcisticamente");
        $prendi="SELECT num_like FROM post WHERE id='".$post_id."'";
        //esecuzione della query
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

?>