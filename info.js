const endpoint_team='https://www.thesportsdb.com/api/v1/json/1/searchteams.php';

const endpoint_giocatore='https://www.thesportsdb.com/api/v1/json/1/searchplayers.php';

const sezione=document.querySelector('form');
sezione.addEventListener('submit',cerca);

const numero_risultati=10;

function cerca(event){
    event.preventDefault();    
    const contenuto=document.querySelector('#cercare').value;
    if(!contenuto){
        console.log('non hai scritto nulla');
    }else{
        const testo=encodeURIComponent(contenuto);
        const tipo=document.querySelector('#tipo').value;

        if(tipo === 'squadra'){
            const team= endpoint_team + '?t=' + testo + '&per_page' + numero_risultati; 
            fetch(team).then(onResponse).then(onJsonTeam);
        }

        if(tipo === 'giocatore'){
            const giocatore=endpoint_giocatore + '?p=' +testo + '&per_page' + numero_risultati;
            fetch(giocatore).then(onResponse).then(onJsonGiocatore);
        }   
    }
    const contenitore=document.querySelector('.contenitore');
    contenitore.innerHTML='';
}
 

function onResponse(response){
    return response.json();
}

function onJsonTeam(json){
    console.log(json);
    const risultati=json.teams;
    for(risultato of risultati){
        const div_esterno=document.createElement('div');
        div_esterno.classList.add('esterno');
        const nome_squadra= risultato.strTeam;
        const cuore=document.createElement('img');
        cuore.classList.add("immagine_cuore");
        cuore.src='cuore.jpg';
        const nazione=risultato.strCountry;
        const titolo=document.createElement('h1');
        const descrizione_1=risultato.strDescriptionIT;
        const dettagli=document.createElement('p');
        dettagli.classList.add('nascosto');
        titolo.innerText=nome_squadra;
        const nome_nazione=document.createElement('em');
        nome_nazione.innerText=nazione;
        const stemma=risultato.strTeamBadge;
        const immagine=document.createElement('img');
        cuore.dataset.id=risultato.strTeam;
        cuore.dataset.value=risultato.strTeamBadge;
        const contenitore=document.querySelector('.contenitore');
        const div_1=document.createElement('div');
        div_1.classList.add('blocco_1');
        const div_2=document.createElement('div');
        div_2.classList.add('blocco_2');
        div_esterno.appendChild(cuore);
        div_1.appendChild(titolo);
        div_1.appendChild(nome_nazione);
        div_2.appendChild(div_1);
        if(stemma != null){
            immagine.src=stemma;
            div_2.appendChild(immagine);
        }else{
            immagine.src='foto-profilo-vuota.jpg';
            div_2.appendChild(immagine);
        }
        div_esterno.appendChild(div_2);
        if(descrizione_1!=null){
            dettagli.innerText=descrizione_1;
            div_2.appendChild(dettagli);
        }else{
            dettagli.innerText='Nessuna descrizione';
            div_2.appendChild(dettagli);
        }
        contenitore.appendChild(div_esterno);
        div_2.addEventListener('click',apriModale);
        cuore.addEventListener('click',aggiungiInPreferiti);
        
    } 
}

function aggiungiInPreferiti(event){
    const cuore=event.currentTarget;
    const nome=cuore.dataset.id;
    const img=cuore.dataset.value;
    fetch('inserisciInPreferiti.php?nome='+nome+'&img='+img);
}

function onJsonGiocatore(json){
    console.log(json);
    const giocatori=json.player;
    for(giocat of giocatori){
        const nome= giocat.strPlayer;
        const squadra=giocat.strTeam;
        const div_esterno=document.createElement('div');
        div_esterno.classList.add('esterno');
        const foto= giocat.strRender;
        const cuore=document.createElement('img');
        cuore.classList.add("immagine_cuore");
        cuore.src='cuore.jpg';
        cuore.dataset.id=giocat.strPlayer;
        cuore.dataset.value=giocat.strRender;
        const descrizione=giocat.strDescriptionIT;
        const dettagli_1=document.createElement('p');
        dettagli_1.classList.add('nascosto');
        const titolo_1=document.createElement('h1');
        titolo_1.innerText=nome;
        const nome_squadra=document.createElement('em');
        nome_squadra.innerText=squadra;
        const contenitore=document.querySelector('.contenitore');
        const div_1=document.createElement('div');
        div_1.classList.add('blocco_1');
        const div_2=document.createElement('div');
        div_2.classList.add('blocco_2');
        div_esterno.appendChild(cuore);
        div_1.appendChild(titolo_1);
        div_1.appendChild(nome_squadra);
        div_2.appendChild(div_1);
        div_esterno.appendChild(div_2);
        const fotos=document.createElement('img');
        if(foto != null){
            fotos.src=foto;
            div_2.appendChild(fotos);
        }else{
            fotos.src='foto-profilo-vuota.jpg';
            div_2.appendChild(fotos);
        }
        if(descrizione!=null){
            dettagli_1.innerText=descrizione;
            div_2.appendChild(dettagli_1);
            
        }else{
            dettagli_1.innerText='Nessuna descrizione';
            div_2.appendChild(dettagli_1);
            
        }
        contenitore.appendChild(div_esterno); 
        div_2.addEventListener('click',apriModale);
        cuore.addEventListener('click',aggiungiInPreferiti);
        
    }
}

function apriModale(event){
    const blocco=event.currentTarget;
    const descrizione=blocco.querySelector('p');
    descrizione.classList.remove('nascosto');
    const div_mod=document.createElement('div');
    div_mod.classList.add('div_modale');
    const paragrafo=document.createElement('p');
    paragrafo.innerText=descrizione.innerText;
    paragrafo.classList.add('p_modale');
    const modale=document.querySelector('#modale');
    div_mod.appendChild(paragrafo);
    modale.appendChild(div_mod);
    modale.classList.remove('hidden');
    document.body.classList.add('no-scroll');
    window.addEventListener('keydown',chiudiModale);
    descrizione.classList.add('nascosto');
}

function chiudiModale(event){
    console.log(event);
    if(event.keyCode === 27){
        const modale=document.querySelector('#modale');
        const div_modale=modale.querySelector('div');
        div_modale.remove();
        const paragrafo=div_modale.querySelector('p');
        paragrafo.remove();
        modale.classList.add('hidden');
        document.body.classList.remove('no-scroll');        
        const blocchi=document.querySelectorAll('.blocco_2');
        for(blocco of blocchi){
            const para=blocco.querySelector('p');
            para.classList.add('nascosto');
        }
    
    }
}