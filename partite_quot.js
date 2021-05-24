
/*Per le partite giornaliere*/ 
/*const endpoint_partite='https://api.football-data.org/v2/matches';
const api_token='6ae316bce05647a4a82858989aed6ff0';

fetch(endpoint_partite,
    {
        headers:
        {
            'X-Auth-Token': api_token
        }
    }
).then(onResponse).then(onJson);
*/
fetch('partite_giorn.php').then(onResponse).then(onJson);

function onResponse(response){
    return response.json();
    
}


function onJson(json){
    const risultati=json;
    
    const partite=risultati.matches;
    console.log(partite);
    for(partita of partite){
        const fuori_casa=partita.awayTeam.name;
        const casa= partita.homeTeam.name;
        const competizione=partita.competition.name;
        const nazione=partita.competition.area.name;
        const bandiera=partita.competition.area.ensignUrl;
        const bandiera_nazione=document.createElement('img');
        bandiera_nazione.classList.add('bandiera');
        if(bandiera!=null){
            bandiera_nazione.src=bandiera;
        }else{
            bandiera_nazione.src='mondo.png';
        }    
        const sezione=document.querySelector('.sezione');
        const div_1= document.createElement('div');
        const nazione_comp=document.createElement('em');
        nazione_comp.classList.add('nazio');
        nazione_comp.innerText=nazione;
        div_1.classList.add('blocco_esterno');
        const h1_competizione=document.createElement('h1');
        h1_competizione.innerText=competizione;
        const div_2=document.createElement('div');
        div_2.classList.add('blocco_interno');
        const squadra_casa=document.createElement('em');
        squadra_casa.innerText=casa;
        const squadra_fuori=document.createElement('em');
        squadra_fuori.innerText=fuori_casa;
        squadra_casa.classList.add('squadre');
        squadra_fuori.classList.add('squadre');
        div_2.appendChild(squadra_casa);
        div_2.appendChild(squadra_fuori);
        div_1.appendChild(h1_competizione);
        div_1.appendChild(div_2);
        div_1.appendChild(nazione_comp);
        div_1.appendChild(bandiera_nazione);
        sezione.appendChild(div_1);
    }
} 
