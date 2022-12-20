let types = ["unknown","Action","Adventure","animation","Childrens","Comedy","Crime","Documentary","Drama","Fantasy","Film_Noir","Horror","Musical","Mystery","Romance","Sci_Fi","Thriller","War","Western"]
let nbr_rec = document.getElementById('nbr_rec')



for(i = 0; i<types.length; i++){
    let arg = '#' + types[i]
    let arg2 = arg
    arg = arg + ' span.fa-star'
    arg2 = arg2 + ' input.rien'
    let mesnotes = document.querySelectorAll(arg)
    let retour = document.querySelectorAll(arg2)
    init(mesnotes, retour)
}
console.log(nbr_rec.value)
for(i = 0; i<nbr_rec.value; i++){
    let arg = '#rec_' + i
    let arg2 = arg
    arg = arg + ' span.fa-star'
    arg2 = arg2 + ' input.rien'
    let mesnotes = document.querySelectorAll(arg)
    let retour = document.querySelectorAll(arg2)
    init(mesnotes, retour)
}

function init(mesnotes, retour){
    mesnotes.forEach( note =>{
        note.addEventListener('click', (e)=>{
            var res = note.getAttribute("class")
            if(res.indexOf('note_1')!=-1){  
            note.setAttribute('class', 'fas fa-star note_1 couleur');
            mesnotes[4].setAttribute('class', 'fas fa-star note_5')
            mesnotes[3].setAttribute('class', 'fas fa-star note_4')
            mesnotes[2].setAttribute('class', 'fas fa-star note_3')
            mesnotes[1].setAttribute('class', 'fas fa-star note_2')
            retour.setAttribute('value', '1')
            }
            if(res.indexOf('note_2')!=-1){  
                note.setAttribute('class', 'fas fa-star note_2 couleur');
                mesnotes[0].setAttribute('class', 'fas fa-star note_1 couleur')
                mesnotes[4].setAttribute('class', 'fas fa-star note_5')
                mesnotes[3].setAttribute('class', 'fas fa-star note_4')
                mesnotes[2].setAttribute('class', 'fas fa-star note_3')
                retour[0].setAttribute('value', '2')
            }
            if(res.indexOf('note_3')!=-1){  
                note.setAttribute('class', 'fas fa-star note_3 couleur');
                mesnotes[1].setAttribute('class', 'fas fa-star note_2 couleur')
                mesnotes[0].setAttribute('class', 'fas fa-star note_1 couleur')
                mesnotes[3].setAttribute('class', 'fas fa-star note_4')
                mesnotes[4].setAttribute('class', 'fas fa-star note_5')
                retour[0].setAttribute('value', '3')
            }
            if(res.indexOf('note_4')!=-1){  
                note.setAttribute('class', 'fas fa-star note_4 couleur');
                mesnotes[2].setAttribute('class', 'fas fa-star note_3 couleur')
                mesnotes[1].setAttribute('class', 'fas fa-star note_2 couleur')
                mesnotes[0].setAttribute('class', 'fas fa-star note_1 couleur')
                mesnotes[4].setAttribute('class', 'fas fa-star note_5')
                retour[0].setAttribute('value', '4')
            }
            if(res.indexOf('note_5')!=-1){  
                note.setAttribute('class', 'fas fa-star note_5 couleur');
                mesnotes[3].setAttribute('class', 'fas fa-star note_4 couleur')
                mesnotes[2].setAttribute('class', 'fas fa-star note_3 couleur')
                mesnotes[1].setAttribute('class', 'fas fa-star note_2 couleur')
                mesnotes[0].setAttribute('class', 'fas fa-star note_1 couleur')
                retour[0].setAttribute('value', '5')
            }
        })
    })
}