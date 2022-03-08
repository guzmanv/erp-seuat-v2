let urlGraphMultiLine = `${base_url}/SeguimientoCajas/selectVentasAll`;
let arrDias = [];
document.addEventListener('DOMContentLoaded', function(){
    fetch(urlGraphMultiLine)
    .then(res => res.json())
    .then((resultado) => {
        for(const [key, value] of Object.entries(resultado.fechas)){
            arrDias.push(key);
        }
    }).catch(err => {throw err});
})

var xValues = ['Lunes 08','Martes 09','Miercoles 10','Jueves','Viernes','Sabado','Domingo','Lunes','Martes','Miercoles'];
//console.log(xValues);
//console.log(arrDias);
new Chart(document.getElementById("myChart"), {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
        label:'Tuxtla',
        data: [860,1140,1060],
        borderColor: "#1cbb8c",
        fill: false
    },{
        label:'Tapachula',
        data: [1600,1700,1700],
        borderColor: "#3b7ddd",
        fill: false
    },{
        label:'Tapilula',
        data: [100,100,800],
        borderColor: "#FCB92C",
        fill: false
    }]
  },
  options: {
    legend: {display: true},
    title: {
        display: true,
        text: 'Graficación de ventas'
      }
  }

});