function validazione(event){
    const errori_php=document.querySelector('.errori');
    errori_php.innerHTML="";
    const errori_js=document.querySelectorAll('.span');
    for(errore of errori_js){
        if(!errore.classList.contains('nascondi')){
            event.preventDefault();
        }
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
    if(event.currentTarget.value===""){
        span.classList.remove('nascondi');
        span.textContent='Compilare campo';
    }else{
        span.classList.add('nascondi');
    }    
}    
const form=document.forms['login'];
form.username.addEventListener('blur',controlloUsername);
form.password.addEventListener('blur',controlloPassword)
form.addEventListener('submit',validazione);