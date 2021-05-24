<?php
    //controlla che l'utente sia loggato,se si va in home!!
    require_once 'auth_user.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }

    $error="";
    $errore_credenziali=array();

    if(isset($_POST['username']) && isset($_POST['password'])){
        if($_POST['username']!=="" && $_POST['password']!==""){  
            $conn=mysqli_connect($configurazioneDB['host'],$configurazioneDB['user'],$configurazioneDB['password'],$configurazioneDB['name']);
            $username=mysqli_real_escape_string($conn, $_POST['username']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);
            $query="SELECT username,password FROM utenti WHERE username='$username'";  
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if(mysqli_num_rows($res) > 0){
                //Ritornerà sempre una riga 
                $eccolo=mysqli_fetch_assoc($res);
                if(password_verify($_POST['password'],$eccolo['password'])){
                    $_SESSION['calcisticamente_utente']=$eccolo['username'];
                    mysqli_free_result($res);
                    mysqli_close($conn);
                    header("Location: home.php");
                    exit;
                }else{
                    $errore_credenziali[]="password non corretta";
                }
            }else{
                $errore_credenziali[]="credenziali non valide";
            }
            mysqli_close($conn);
        }else{
            $error="Compila tutti i campi";
        }
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='log.css'>
        <script src='login.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
        <meta charset = "utf-8">
        <title>Calcisticamente - Accedi</title>
    </head>
    <body>
            <h1 class='titolo'>
                <strong>CalcisticaMente</strong></br>
                <em>Tutto il bello del calcio </em>
            </h1>
            <nav>
            <a href= 'home.php'>Torna alla Home</a>    
            </nav>    
        <section>
            <div class='blocco-esterno'>
                <div class='scrivi'>
                    <h1>Scrivi le tue credenziali</h1>
                </div>
                <form name='login' method='post'>
                    <div id='username'>
                        <label>Username<input type='text' name='username' <?php if(isset($_POST['username'])){echo "value='".$_POST['username']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div id='password'>
                        <label>Password<input type='password' name ='password' <?php if(isset($_POST['password'])){echo "value='".$_POST['password']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div class='acesso_utente'>
                        <div class='clicca'>
                            <label>&nbsp;<input type='submit' value='Accedi' class='clicca'>
                            <p class="errori">
                                <?php
                                    if(!empty($error)){
                                    echo "$error<br>";
                                    }
                                ?>
                            </p>
                            <p class='errore_crede'>
                                <?php 
                                    if(!empty($errore_credenziali)){
                                        foreach($errore_credenziali as $valore){
                                            echo "$valore<br>";
                                        }    
                                    }
                                ?>
                            </p>
                            </div>    
                    </div>
                </form>
                <div class='NuovoProfilo'> Non hai un account?<a href='registrazione.php'>Registrati</a></div>            
                    
            </div>        
        </section>
    </body>

</html>