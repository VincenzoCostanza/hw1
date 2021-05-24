<?php 
    require_once 'configurazioneDB.php';
    session_start();
?>

<html>
    <head>
        <meta name="viewport"
            content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='mhw1.css'>
        <meta charset = "utf-8">
        <title>CalcisticaMente</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
        <script src= "home.js" defer></script>
    </head>
    <body>
        <header>
            <div class= "abc "></div>
            <h1>
                <strong>CalcisticaMente</strong></br>
                <em>Tutto il bello del calcio </em>
            </h1>
            <nav id="menu">
                <div >
                    <a href='preferiti.php' class='accesso_esci'>Preferiti</a>
                    <div>
                    <?php
                        if(isset($_SESSION['calcisticamente_utente'])){
                            echo "<a href='logout.php' class='accesso_esci'> Logout</a>";
                        }else{
                            echo "<a href='login.php' class='accesso_esci'> Accedi</a>";
                        }
                    ?>    
                    </div>
                </div>
            </nav>            
            <div id="barre">
                <div></div>
                <div></div>
                <div></div>
            </div>        
            <nav class='bottoni'>
                <div>    
                    <a href="partite_quot.php" class="premi">Clicca qui per le partite del giorno</a>
                    <a href="info.php" class="premi">Info giocatori e squadre</a>
                </div>        
            </nav>                 
        </header>
        <section>
            <section class= 'prefe'>
                <div id= "x">
                    <h1 class='compe'>Le maggiori competizioni europee:</h1>
                </div>
                <div id='flex-cont'></div> 
            </section>
            <section class='blocco_articoli'>        
            </section>
            <div id= "commenti" class="nasconditi">
                <div class='mod'>
                <div class="past_messages"></div>
                    <div class="comment_form">
                        <form name="scrivi_commenti">
                            <input type="text" name="commento" maxlength="254" placeholder="Scrivi un commento...">
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
            <div id='modale' class='nascosto'></div>   
        </section>                                 
        <footer>
        <strong>CalcisticaMente</strong></br></br>       
        <address>Sede centrale: Via Atenea,23 Agrigento</address>
       <p>Vincenzo Costanza O46002289</p>
    </footer>
</body>
</html>
