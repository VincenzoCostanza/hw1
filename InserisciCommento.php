<?php
    require_once 'configurazioneDB.php';
    session_start();
    if(!isset($_SESSION['calcisticamente_utente'])) {
        exit;
    }else{ 
        $conn=mysqli_connect("localhost","root","","calcisticamente");
        
        $username=mysqli_real_escape_string($conn,$_SESSION['calcisticamente_utente']);
        $post_id=mysqli_real_escape_string($conn,$_GET['id_post']);
        $commento=mysqli_real_escape_string($conn,$_GET['commento']);

        if($commento==""){
            exit;
        }else{
            $inserisci_commento="insert into commenti(user,id,commento) values('".$username."','".$post_id."','".$commento."')";
            //HO CREATO UN TRIGGER CHE MI INCREMENTA I COMMENTI NEL POST!!
            $conn_2=mysqli_connect("localhost","root","","calcisticamente");
            $prendi="SELECT user,commento FROM commenti WHERE id='".$post_id."'";

            $res=mysqli_query($conn,$inserisci_commento) or die(mysqli_error($conn));
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
    } 
?>