
for(const item of contenuti){
    const immagine= document.createElement('img');
    immagine.src='https://thumbs.dreamstime.com/t/battendo-l-icona-grafica-rossa-del-cuore-k-ultra-hd-grande-per-un-tema-di-amore-san-valentino-giorno-madri-ecc-scarichilo-147502761.jpg';
    immagine.classList.add('immagine_cuore');
    const div=document.createElement('div');
    div.classList.add('blocco');
    const div_1=document.createElement('div');
    div_1.classList.add('imm-h1');
    const h1=document.createElement('h1');
    h1.classList.add('titolo');
    const image=document.createElement('img');
    image.classList.add('altezza');
    image.classList.add('coppa');
    const p=document.createElement('p');
    p.innerText=item.descrizione;
    p.classList.add('nascondi');
    const cont =document.querySelector('#flex-cont');
    const dettaglio= document.createElement('span');
    dettaglio.classList.add('dett');
    dettaglio.innerText="Mostra più dettagli";
    h1.innerText=item.titolo;
    image.src=item.immagine;    
    div_1.appendChild(h1);
    div_1.appendChild(immagine);
    div.appendChild(div_1);
    div.appendChild(image);
    div.appendChild(p);
    div.appendChild(dettaglio);
    cont.appendChild(div);
    dettaglio.addEventListener("click",onDettaglio);
    immagine.addEventListener("click",onPreferiti);
}

function onDettaglio(event){
    const nascondi_mostra=event.currentTarget;
    nascondi_mostra.querySelector('span');
    nascondi_mostra.classList.add('dett');
    nascondi_mostra.innerText="Meno dettagli";
    const contenitore= nascondi_mostra.parentNode;
    const p= contenitore.querySelector('p');
    p.classList.remove('nascondi');
    
    const image=contenitore.querySelector('.coppa');
    if(nascondi_mostra.innerText=== "Meno dettagli"){
        image.classList.remove('altezza');
        image.classList.add('altezza_1');
        
    }


    nascondi_mostra.removeEventListener("click",onDettaglio);
    nascondi_mostra.addEventListener("click",onMeno);
    
}

function onMeno(event){
    const nascondi_meno=event.currentTarget;
    nascondi_meno.querySelector('span');
    nascondi_meno.classList.add('dett');
    nascondi_meno.innerText="Mostra più dettagli";
    const contenitore= nascondi_meno.parentNode;
    const p= contenitore.querySelector('p');
    p.classList.add('nascondi');

    const image=contenitore.querySelector('.coppa');
    if(nascondi_meno.innerText === "Mostra più dettagli"){
        image.classList.remove('altezza_1');
        image.classList.add('altezza');
    }

    nascondi_meno.removeEventListener("click",onMeno);
    nascondi_meno.addEventListener("click",onDettaglio);
}    

let contatore=0;

function onPreferiti(event){
    const cuore=event.currentTarget;
    const body_1=cuore.parentNode;
    const body_2=body_1.parentNode;
    console.log(body_2);
    const h1vecchio=body_2.querySelector('h1');
    const h1nuovo=document.createElement('h1');
    h1nuovo.textContent=h1vecchio.textContent;
    h1nuovo.classList.add('tit');
    const immaginevecchia=body_2.querySelector('.coppa');
    const immaginenuova=document.createElement('img');
    immaginenuova.src=immaginevecchia.src;
    immaginenuova.classList.add('immagine_prefe');


    const div=document.createElement('div');
    div.classList.add('blocco_prefe');
    const div_1=document.createElement('div');
    div_1.classList.add('imma-h1');
    const contenitore=document.querySelector('.migliori'); 
    const cuore_spezz= document.createElement('img');
    cuore_spezz.src='https://media.istockphoto.com/vectors/broken-heart-symbol-isolated-vector-vector-id646787412?k=6&m=646787412&s=612x612&w=0&h=jeJBQRX3XM8rMN1pyoDJ_EzAB7___mqksGEzgE5qDvs=';
    cuore_spezz.classList.add('immagine_cuore_spezzato');
    div_1.appendChild(h1nuovo);
    div_1.appendChild(cuore_spezz);
    div.appendChild(div_1);
    div.appendChild(immaginenuova);
    contenitore.appendChild(div);
    cuore.removeEventListener("click",onPreferiti);
    cuore_spezz.addEventListener("click",onNoPrefe);
    contatore++;  
    if(contatore != 0){
        const sezione_1=document.querySelector('section');
        const Preferiti=sezione_1.querySelector('h1');
        Preferiti.classList.add('hidden');
        Preferiti.classList.remove('nascondi'); 
    }
}   


function onNoPrefe(event){

    const cuore_spezz=event.currentTarget;
    const body_1=cuore_spezz.parentNode;
    const body_2=body_1.parentNode;
    const titolo=body_1.querySelector('h1');
    const titolo_1=document.createElement('h1');
    titolo_1.innerText=titolo.innerText;
    body_2.remove();
    contatore--;
    if(contatore === 0){
        const sezione_1=document.querySelector('section');
        const Preferiti=sezione_1.querySelector('h1');
        Preferiti.classList.remove('hidden');
        Preferiti.classList.add('nascondi'); 
    }
    const sezione=document.querySelector('.prefe');
    const blocchi=sezione.querySelectorAll('.blocco');
    for(let blocco of blocchi){
        let div=blocco.querySelector('.imm-h1');
        let titolo=div.querySelector('h1');
        if(titolo.innerText===titolo_1.innerText){
            const cuore=blocco.querySelector('img');
            cuore.addEventListener("click",onPreferiti);
        }
    }
}

const barra_ricerca=document.querySelector('input');
barra_ricerca.addEventListener('keyup',onCerca);

function onCerca(event){
    const barra=event.currentTarget.value;
    const sezione=document.querySelector('.prefe');
    const blocchi=sezione.querySelectorAll('.blocco');
    for(let blocco of blocchi){
        const titolo=blocco.querySelector('h1');
        if(titolo.innerText.toLowerCase().includes(barra)){
            blocco.classList.remove('nascondi');
        }else{
            blocco.classList.add('nascondi');
        }
    }
}
