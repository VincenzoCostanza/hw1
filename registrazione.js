function eliminaphp_e_controlla(event){
    const errori_php=document.querySelector('.errori');
    errori_php.innerHTML="";
    const errori_js=document.querySelectorAll('.span');
    for(errore of errori_js){
        if(!errore.classList.contains('nascondi')){
            event.preventDefault();
        }
    }
}

function controlloNome(event){
    const nome=document.querySelector('#nome');
    const span=nome.querySelector('span');
    if(/[^a-z]/i.test(event.currentTarget.value)){
        span.classList.remove('nascondi');
        span.textContent='il nome deve contenere solo lettere';
    }else if(event.currentTarget.value===""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }
}

function controlloCognome(event){
    const cognome=document.querySelector('#cognome');
    const span=cognome.querySelector('span');
    if(/[^a-z]/i.test(event.currentTarget.value)){
        span.classList.remove('nascondi');
        span.textContent='il cognome deve contenere solo lettere';
    }else if(event.currentTarget.value==""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }
}

function controlloUsername(event){
    const username=document.querySelector('#username');
    const span=username.querySelector('span');
    if(event.currentTarget.value==""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }
}

function controlloPassword(event){
    const password=document.querySelector('#password');
    const span=password.querySelector('span');
    if(event.currentTarget.value.length<8 && event.currentTarget.value!==""){
        span.classList.remove('nascondi');
        span.textContent='la password deve essere di almeno 8 caratteri';
    }else if(event.currentTarget.value===""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }
}

function controlloEmail(event){
    const email=document.querySelector('#email');
    const span=email.querySelector('span');
    const simboli=/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    if( event.currentTarget.value!=="" && !simboli.test(event.currentTarget.value.toLowerCase()) ){// if !(email valida)
        span.classList.remove('nascondi');
        span.textContent='email non valida';
    }else if(event.currentTarget.value===""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }
}

const form=document.forms['Registrazione'];
form.nome.addEventListener('blur',controlloNome);
form.addEventListener('submit', eliminaphp_e_controlla);
form.cognome.addEventListener('blur',controlloCognome);
form.username.addEventListener('blur',controlloUsername);
form.email.addEventListener('blur',controlloEmail);
form.password.addEventListener('blur',controlloPassword);