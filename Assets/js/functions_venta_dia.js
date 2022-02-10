let tableVentasDia;
//Funcion para Reloj de Tiempo Real
function HORA_TIEMPO_REAL() {
    const ID_ELEMENT = document.getElementById("fechaHoraRealTime");
    const CERO = n => n = n < 10 ? "0"+n: n;
    let hora, minutos, segundos, meridiano,fecha;
    const meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    const dias_semana = ['Domingo', 'Lunes', 'martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

    const RELOJ = () => {
        const DATE = new Date();
        hora = DATE.getHours();
        minutos = DATE.getMinutes();
        segundos = DATE.getSeconds();
        meridiano = hora < 12 ? "am" : "pm";
        fecha = dias_semana[DATE.getDay()] + ' '+DATE.getDate() + ' de '+ meses[DATE.getMonth()]+ ' del '+ DATE.getUTCFullYear();
       // hora = hora == 0 ? 12 : hora || hora > 12 ? hora -= 12 : hora;
        return (
            ID_ELEMENT.textContent = 
            `${fecha} , ${CERO(hora)}:${CERO(minutos)}:${CERO(segundos)} ${meridiano}`
        );
    }

    return setInterval(RELOJ, 1000);
}

document.addEventListener("DOMContentLoaded", function(){
    HORA_TIEMPO_REAL();
    ventaTotalDia();
    tableVentasDia = $('#tableVentasDia').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": `${base_url}/VentasDia/getVentasDia/`,
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"folio"},
			{"data":"nombre_completo"},
            {"data":"plantel"},
            {"data":"carrera"},
            {"data":"grado"},
            {"data":"fecha"},
            {"data":"total_formato"},
			{"data":"acciones"}
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '42vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 25
    });

$('#tableVentasDia').DataTable();
});

function ventaTotalDia(){
    let url = `${base_url}/VentasDia/getVentasDia`;
    fetch(url)
    .then(res => res.json())
    .then((respuesta) =>{
        let total = 0;
        if(respuesta){
            respuesta.forEach(element => {
                total += parseInt(element.total);
            });           
        }
        document.querySelector('#totalSaldo').textContent = formatoMoneda(total.toFixed(2));
    })
    .catch(err => {throw err});
}


function fnCortePArcialDia(){
    document.querySelector("#totalVentaCorteParcial").textContent = document.querySelector('#totalSaldo').textContent;
}

function detallesIngreso(value){
    let folio = document.getElementById(value).getAttribute('f');
    document.querySelector('#folioDetallesVenta').textContent = folio;
    let url = `${base_url}/VentasDia/getDetallesVenta/${value}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        document.querySelector('#observacionIngreso').textContent = resultado.observacion;
        if(resultado.detalles.length != 0){
            let count = 0;
            resultado.detalles.forEach(element => {
                console.log(element.prmociones_aplicadas);
                count += 1;
                let table = document.querySelector('#tableDetallesVentaModal');
                let row = `<tr><td>${count}</td><td>${element.nombre_servicio}</td><td>${formatoMoneda(element.precio_unitario)}</td><td><span class="badge badge-primary m-1">${element.promociones_aplicadas}</span><span class="badge badge-primary m-1">Promocion 2(12%)</span><span class="badge badge-primary m-1">Promocion 3(14%)</span></td></tr>`;
                table.innerHTML += row;
            });
        }
    }).catch(err => {throw err});
}

function fnImprimirReporteVentaDia(){
    Swal.fire({
        title: 'Imprmir?',
        text: "Desea imprimir el reporte de venta?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, imprimir!',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Exito!',
            'Impresión con éxito.',
            'success'
          )
        }
      })
}
//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}