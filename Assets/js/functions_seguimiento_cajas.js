let urlGraphMultiLine = `${base_url}/SeguimientoCajas/selectVentasAll`;
let arrDias = [];
document.addEventListener('DOMContentLoaded', function(){
    fetch(urlGraphMultiLine)
    .then(res => res.json())
    .then((resultado) => {
        for(const [key, value] of Object.entries(resultado.dias)){
            arrDias.push(value);
        }
        fnGraficar(arrDias,resultado.datos);
    }).catch(err => {throw err});
})

function fnGraficar(arrDias,datos){
    console.log(datos);
    new Chart(document.getElementById("myChart"), {
      type: "line",
      data: {
        labels: arrDias,
        datasets: datos
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