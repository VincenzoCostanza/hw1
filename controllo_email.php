<?php
    /*verifico che non ci siano email uguali*/
    require_once 'configurazioneDB.php';
    
    $conn=mysqli_connect("localhost","root","","calcisticamente");

    $utenti_presenti=array();

    //leggo gli utenti
    $res=mysqli_query($conn,"SELECT email FROM utenti");
    while($row=mysqli_fetch_assoc($res)){
        $eventi[]=$row;
    }

    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($eventi);
?>