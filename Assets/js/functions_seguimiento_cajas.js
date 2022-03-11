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
console.log(xValues);
console.log(arrDias);
new Chart(document.getElementById("myChart"), {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
        label:'Tuxtla',
        data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
        borderColor: "#1cbb8c",
        fill: false
    },{
        label:'Tapachula',
        data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
        borderColor: "#3b7ddd",
        fill: false
    },{
        label:'Tapilula',
        data: [100,100,800,5000,3000,4000,2000,1000,200,500],
        borderColor: "#FCB92C",
        fill: false
    },{
        label:'Reforma',
        data: [300,700,2000,5000,6000,4000,2000,1000,200,4100],
        borderColor: "#DC3545",
        fill: false
    },{
        label:'Yajalon',
        data: [300,700,2000,5000,9000,4000,2000,1000,200,700],
        borderColor: "#17A2B8",
        fill: false
    },{
        label:'Oaxaca',
        data: [300,700,2000,5000,100,4000,2000,1000,9000,3500],
        borderColor: "#1CBB8C",
        fill: false
    },{
        label:'Campeche',
        data: [300,700,2000,5000,6000,4000,2000,1000,5000,1500],
        borderColor: "#e91e63",
        fill: false
    },{
        label:'Palenque',
        data: [300,700,2000,5000,6000,4000,2000,1000,200,5700],
        borderColor: "#cddc39",
        fill: false
    },{
        label:'Comitán',
        data: [300,700,2000,5000,6000,4000,2000,1000,200,8500],
        borderColor: "#009688",
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

/* 

let urlGraphMultiLine = `${base_url}/SeguimientoCajas/selectVentasAll`;
let arrDias = [];
let data = [];
document.addEventListener('DOMContentLoaded', function(){
    fetch(urlGraphMultiLine)
    .then(res => res.json())
    .then((resultado) => {
        console.log(resultado);
        fnMostrarGraficaLine(resultado.dias);

    }).catch(err => {throw err});
});

function fnMostrarGraficaLine(arr){
    new Chart(document.getElementById("myChart"), {
        type: "line",
        data: {
          labels: arr,
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
}
 */