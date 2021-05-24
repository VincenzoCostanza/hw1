<?php
    $endpoint_partite='https://api.football-data.org/v2/matches';
    $api_token='6ae316bce05647a4a82858989aed6ff0';
    $curl=curl_init();

    curl_setopt($curl, CURLOPT_URL, $endpoint_partite);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $headers=array("X-Auth-Token:".$api_token);    
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $result=curl_exec($curl);
    echo $result;
    
    curl_close($curl);
?>