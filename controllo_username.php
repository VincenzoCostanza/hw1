<?php
    /*verifico che non ci siano username uguali*/
    require_once 'configurazioneDB.php';
    
    $conn=mysqli_connect("localhost","root","","calcisticamente") or die(mysqli_error($conn));

    $username_presenti=array();

    //leggo gli utenti
    $res=mysqli_query($conn,"SELECT username FROM utenti");
    while($row=mysqli_fetch_assoc($res)){
        $username_presenti[]=$row;
        
    }

    mysqli_free_result($res);
    mysqli_close($conn);

    echo json_encode($username_presenti);
?>