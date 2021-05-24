<?php 
    require_once 'auth_user.php';

    if (checkAuth()){
        header("Location: login.php");
        exit;
    }
    $error_username="";
    $conn=mysqli_connect($configurazioneDB['host'],$configurazioneDB['user'],$configurazioneDB['password'],$configurazioneDB['name']);
    $error=array();

    if(isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){
        if($_POST['email']!== "" && $_POST['password']!== "" && $_POST['username']!== "" && $_POST['nome']!== "" && $_POST['cognome']!== ""){
            if(ctype_alpha($_POST['nome'])){
                $nome=mysqli_real_escape_string($conn,$_POST['nome']);
            }else{
                $error[]='il nome deve contenere lettere e non altro!';
            }

            if(ctype_alpha($_POST['cognome'])){
                $cognome=mysqli_real_escape_string($conn,$_POST['cognome']);
            }else{
                $error[]='il cognome deve contenere lettere e non altro!';
            }
        
            if($_POST['username']){
                $username_1=mysqli_real_escape_string($conn,$_POST['username']);
                $query="SELECT username FROM utenti WHERE username='$username_1'";
                $res=mysqli_query($conn,$query);
                if(mysqli_num_rows($res)>0){
                    $error_username="Mi dispiace, username gia in uso";
                }else{
                    $username=mysqli_real_escape_string($conn,$username_1);
                }
            }

            if(strlen($_POST['password'])<7){
                $error[]="La password deve almeno contenere 8 caratteri!";
            }else{
                $password_1=mysqli_real_escape_string($conn,$_POST['password']);
                $password=password_hash($password_1,PASSWORD_BCRYPT);
            }

            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error[]="email errata";     
            }else{
                $email=mysqli_real_escape_string($conn,$_POST['email']);
            }

            //CARICAMENTO DATABASE
            if(count($error)===0 && $error_username===""){
                $query="INSERT INTO utenti values('".$nome."','".$cognome."','".$email."','".$username."','".$password."')";
                $res=mysqli_query($conn,$query);
                if(!$res){
                    $error[]="Errore durante la registrazione.RIPROVA";
                } else {
                    mysqli_close($conn);
                    header("Location:login.php"); 
                    exit;
                }
            }

        }else{
            $error[]="compila tutti i campi!";
        }    
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='log.css'>
        <script src='registrazione.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
        <meta charset = "utf-8">
        <title>Calcisticamente - Registrati</title>
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
                <form name='Registrazione' method='post'>
                    <div id='nome'>
                        <label> Nome <input type='text' name='nome'<?php if(isset($_POST['nome'])){echo "value='".$_POST['nome']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div id='cognome'>
                        <label> Cognome <input type='text' name='cognome' <?php if(isset($_POST['cognome'])){echo "value='".$_POST['cognome']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div id='username'>
                        <label> Username <input type='text' name='username' <?php if(isset($_POST['username'])){echo "value='".$_POST['username']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div id='email'>
                        <label> E-mail <input type='text' name= 'email' <?php if(isset($_POST['email'])){echo "value='".$_POST['email']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <div id='password'>
                        <label> Password <input type='password' name='password' <?php if(isset($_POST['password'])){echo "value='".$_POST['password']."'";}?>></label>
                        <span class='span nascondi'></span>
                    </div>
                    <label>&nbsp;<input type='submit' value='Invia'></label>
                    <p class="errori">
                        <?php
                            if(!empty($error)){
                                foreach($error as $valore){
                                    echo "$valore<br>";
                                }
                            }
                        ?>
                    </p>
                    <p class='errore_username'>
                        <?php 
                            if(!empty($error_username)){
                                echo "$error_username<br>";
                            }
                        ?>
                    </p>    
                </form>
            </div>  
        </section>
    </body>

</html>