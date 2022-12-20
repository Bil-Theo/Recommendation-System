var choix_user = document.getElementById('choix_user').getContext('2d');
var cate = document.getElementsByClassName('categorie');
var valeur = document.getElementsByClassName('valeur');

var x = [];
var y = [];
console.log(cate);
for(i = 0; i<cate.length; i++){
    y.push(valeur[i].getAttribute('value'))
    x.push(cate[i].getAttribute('value'))
}
console.log(x);
console.log(y)
const ct = new Chart(choix_user, {
    type : "radar",
    data: {
        labels : x,
        datasets: [{
            data: y,
            label: "preferences",
            fill: true,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgb(54, 162, 235)',
            pointBackgroundColor: 'rgb(54, 162, 235)',
            pointBorderColor: '#fff',
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: 'rgb(54, 162, 235)'        
        }]

    }
})