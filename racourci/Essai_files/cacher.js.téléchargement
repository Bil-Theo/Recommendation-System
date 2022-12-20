let recommandation = document.getElementById("Dropdown")
let cacher =  document.getElementById("navbar")
let cache =  document.getElementById("cache")
let item = document.querySelectorAll('.a')
let search = document.getElementById("search")
let btn = document.getElementById("btn")




/*alert("Le RMSLE est de "+val)*/

recommandation.addEventListener("mouseover", ()=>{
    cache.style.display = "block"
})

recommandation.addEventListener("mouseout", ()=>{
    cache.style.display = "none"
})

recommandation.addEventListener("click", ()=>{
    cacher.style.display = "inline-block"
})

for(let i in item){
    item[i].addEventListener("mouseover", ()=>{
        item[i].style.backgroundColor = "#dc3545"
        item[i].style.color = "white"
    })
    item[i].addEventListener("mouseout", ()=>{
        item[i].style.color = "black"
        item[i].style.backgroundColor = "white"
    })
}

btn.addEventListener("click", ()=>{
    search.style.display = "inline"
})

