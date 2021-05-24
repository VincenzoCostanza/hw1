<?php
    require_once 'configurazioneDB.php';
    
    $conn=mysqli_connect("localhost","root","","calcisticamente");
    $articoli_presenti=array();

    //leggo gli articoli
    $res=mysqli_query($conn,"SELECT num_like,num_commenti,id,titolo,descrizione,immagine FROM post");
    while($row=mysqli_fetch_assoc($res)){
        $articoli_presenti[]=$row;
    }
    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($articoli_presenti);
?>    