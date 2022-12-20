let myEnters = document.getElementsByClassName("input")
let genre = document.getElementById("list")
let prof = document.getElementById("prof")
let mdp = document.getElementById("mdp")
let msm = document.getElementById("msm")
let vermdp = document.getElementById("vermdp")
let vmsm = document.getElementById("vmsm")
let button = document.getElementById("buttoninvalide")
let env = document.getElementById("env")
let retour = document.getElementById('retour')

/*Ici nous allons vérifier si les champs ne sont pas vide*/
mycode = "mycode"
identic =  false
myconfirme = "myconfirme"
deja = false

/*Verfivier mode passe*/
mdp.addEventListener("input", (e)=>{
    globalThis.identic =  false
    if(!globalThis.identic && globalThis.deja){
        vmsm.innerText = "Mot de passe different"
        vmsm.style.color = "red"
    }
    if(globalThis.deja){
        vmsm.innerText = ""
        env.style.display = "none"
        button.style.display = "inline-block"
    }
    if(e.target.value.length>=4){
        msm.innerText = "Mot de passe accepté"
        msm.style.color = "rgba(17, 187, 17, 0.973)"
        if(globalThis.deja && globalThis.myconfirme == e.target.value){
            globalThis.identic = true
            vmsm.innerText = "Confirmation reussite"
            vmsm.style.color = "rgba(17, 187, 17, 0.973)"
            env.style.display = "inline-block"
            button.style.display = "none"

        }
    }
    else{
        msm.innerText = "Mot de passe trop court"
        msm.style.color = "red"
    }
    globalThis.mycode = e.target.value
})
vermdp.addEventListener("input", (e)=>{
    let code = e.target.value;
    globalThis.myconfirme = code
    if(globalThis.mycode>0){
        globalThis.deja = true
        if(code ==globalThis.mycode){
            globalThis.identic = true
            vmsm.innerText = "Confirmation reussite"
            vmsm.style.color = "rgba(17, 187, 17, 0.973)"
            env.style.display = "inline-block"
            button.style.display = "none"
        }
        else{
            globalThis.deja = false
            vmsm.innerText = "Mot de passe different"
            vmsm.style.color = "red"
            env.style.display = "none"
            button.style.display = "inline-block"
        }
    }
    else{
        vmsm.innerText = "Tapez d'abord l'original"
        vmsm.style.color = "red"
        env.style.display = "none"
        button.style.display = "inline-block"
    }
})

/*Voir si mot_passe_init == mot_pass_confirm */
mdp.addEventListener("change", (e)=>{
    globalThis.mycode = e.target.value
})

vermdp.addEventListener("change", (e)=>{
    globalThis.myconfirme = e.target.value
})

/*style*/
retour.addEventListener('click', (e)=>{
    confirm("Le retour en arrière causera une annulation des données saisies dans le formulaire.\nÊtes vous sûr(e)s d'annuler?")
    //e.preventDefault()
})

/*Mise en forme dynamique*/
genre.addEventListener("mouseover", ()=>{
    genre.style.backgroundColor = "white"
    genre.style.borderColor = "red"
    genre.style.color = "rgb(253, 245, 245);"
    
})
genre.addEventListener("mouseout", function(){
    genre.style.backgroundColor = "#202020"
    genre.style.borderColor = "white"
    myEnters[i].style.color = "rgb(253, 245, 245)"
})

prof.addEventListener("mouseover", ()=>{
    prof.style.backgroundColor = "white"
    prof.style.borderColor = "red"
    prof.style.color = "rgb(253, 245, 245);"
    
})
prof.addEventListener("mouseout", function(){
    prof.style.backgroundColor = "#202020"
    prof.style.borderColor = "white"
    myEnters[i].style.color = "rgb(253, 245, 245)"
})


for(let i in myEnters){
    myEnters[i].addEventListener("mouseover", ()=>{
        myEnters[i].style.backgroundColor = "white"
        myEnters[i].style.borderColor = "red"
        myEnters[i].style.color = "black"
    })
    myEnters[i].addEventListener("mouseout", ()=>{
        myEnters[i].style.backgroundColor = "#202020"
        myEnters[i].style.borderColor = "white"
        myEnters[i].style.color = "rgb(253, 245, 245)"
    })
}