var cases = document.getElementsByClassName('nbr');
var occu = document.getElementsByClassName('label');
var choix_user = document.getElementById('choix_user').getContext('2d');

x = [];
y = [];
for(i = 0; i<cases.length; i++){
    x.push(occu[i].innerHTML)
    y.push(cases[i].innerHTML)
}
const ct = new Chart(choix_user, {
    type : "bar",
    data: {
        labels : x,
        datasets: [{
            data: y,
            label: "Histogramme des specialites des users"
        }]

    }
})