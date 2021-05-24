<html>
<head>
    <meta name="viewport"
content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='info.css'>
    <meta charset = "utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <script src= "info.js" defer></script>
    <title>CalcisticaMente</title>
</head> 
<body>
    <header>
        <div class= "abc "></div>
        <h1>
            <strong>CalcisticaMente</strong></br>
            <em>Tutto il bello del calcio </em>
        </h1>
        <nav>
           <a href= 'home.php'>Torna alla Home</a>    
        </nav>   
    </header>   
       
    <section>
        <form>
            <div class='blocco-esterno'>
                Inserisci il nome:
                <div class='blocco-interno'>
                    <input type='text'id='cercare'>
                    <select name='tipo' id='tipo'>
                        <option value='giocatore'>Giocatore</option>
                        <option value='squadra'>Squadra</option>
                    </select>
                    <input type='submit' value='Cerca'>
                </div>
            </div>
        </form>

        <div class='contenitore'>
        </div>

    </section>
    
    <div id='modale' class='hidden' ></div>
</body>
</html>