<?php
    require_once 'configurazioneDB.php';

    $conn=mysqli_connect("localhost","root","","calcisticamente");
    $competizioni_presenti=array();

    $res=mysqli_query($conn,"SELECT titolo,immagine,descrizione FROM competizioni");
    while($row=mysqli_fetch_assoc($res)){
        $competizioni_presenti[]=$row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    
    echo json_encode($competizioni_presenti);
?>    