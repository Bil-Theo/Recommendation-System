var reel = document.getElementsByClassName('reel')
var predi = document.getElementsByClassName('predi')
var grapheError = document.getElementById('grapheError').getContext('2d')

var myData = [];
var regression =  [];
j=0
for(i = 0; i<reel.length; i++){
    a=reel[i].innerHTML;
    g= predi[i].innerHTML;
    a = parseInt(a) + i
    g = parseInt(g) + i 
    temp = {x:a,y:g};
    myData.push(temp);
}
regression = [{x:0, y:0}, {x:20, y:20}]
var g=new Chart(grapheError, {
    data : {
        datasets: [{
            
            type:  'scatter',
            data: myData,
            backgroundColor: 'rgba(255,0,0)',
            borderColor: 'rgb(255, 0, 0)',
            label:  "Ecart_RMSLE"
        },
        {   
            
            type:  'line',
            data: regression,
            backgroundColor: 'rgb(0, 0, 255)',
            borderColor: 'rgb(0,0,255)',
            label:  'Droite_Regression',
            borderWidth: '1'
        },
    
        {   
            
            type:  'line',
            data: myData,
            backgroundColor: 'rgb(0, 255, 0)',
            borderColor: 'rgb(0,255, 0)',
            borderWidth: '1'
        }]
    }
});
