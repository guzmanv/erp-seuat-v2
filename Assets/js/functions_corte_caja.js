let idCaja = null;
let tabActual = 0;
let idCorteCaja = null;

function fnSelectCajero(value){
    let id_caja = value;
    let url = `${base_url}/CorteCaja/getCaja/${id_caja}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        if(resultado.estatus){
            if(resultado.estatus_caja == 1){
                idCaja = value;
                idCorteCaja = resultado.id_corte_caja;
                document.querySelector('#num_caja').value = resultado.nombre;
                document.querySelector('#dateCorteDesde').value = resultado.fechayhora_apertura_caja;
                document.querySelector('#dateCorteHasta').value = resultado.fechayhora_actual;
                fnTotalesMetodosPago();
            }else{
                Swal.fire({
                    title: 'Caja cerrada!',
                    text: "La caja seleccionada, actualmente se encuentra cerrada!",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                  })
            }
        }else{
            Swal.fire({
                title: 'Caja cerrada!',
                text: "La caja seleccionada, actualmente se encuentra cerrada!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              })
        }
    }).catch(err => { throw err });
}
function fnTotalesMetodosPago(){
    let url = `${base_url}/CorteCaja/getTotalesMetodosPago`;
    let total = 0;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        let numeracion = -1;
        document.querySelector('#totalesEfecMetoPago').innerHTML = "";
        document.querySelector('#nav-tab').innerHTML = "";
        resultado['totales'].forEach(element => {
            total += element.total;
            numeracion += 1;
            let row = "<tr><th scope='row'>"+element.metodo+"</th><td><input type='text' class='form-control' value='"+formatoMoneda(element.total.toFixed(2))+"' disabled></td><td><input type='text' class='form-control' placeholder='$0.00' value='0' onkeyup = 'fnChangeTotalSegunCaja()'></td></tr>";
            let content = "";
            document.querySelector('#totalesEfecMetoPago').innerHTML += row;
            document.querySelector('#nav-tab').innerHTML +='<a class="nav-link tab-nav" id="'+numeracion+'-tab" data-toggle="tab" href="" onclick="fnNavTab('+numeracion+')" >'+element.metodo+'</a>';
            let numRow = 0;
            resultado['detalles'].forEach(detalle => {
                if(detalle.id_metodo_pago == element.id){
                    numRow += 1
                    content += "<tr><td>"+numRow+"</td><td>"+detalle.folio+"</td><td>"+detalle.nombre_persona+"</td><td>"+detalle.fecha+"</td><td>"+formatoMoneda(detalle.total)+"</td><td><button type='button' class='btn btn-primary btn-sm' onclick='fnDetallesIgreso("+detalle.id_ingreso+")'>Detalles</button></td></tr>";
                }
            });
            document.querySelector('#content-nav').innerHTML += '<div class="tab" id="'+numeracion+'"><table id="" class="table table-bordared table-striped table-sm"><thead><tr><th>#</th><th>Folio</th><th>Alumno</th><th>Fecha</th><th>Total</th><th>Acciones</th></tr></thead><tbody id="tbody-'+element.id+'">'+content+'</tbody></table></div>';
            document.getElementsByClassName('tab')[tabActual].style.display = 'block';
            document.getElementById('0-tab').className += " active";
        });
        document.querySelector('#totalSSistema').textContent = formatoMoneda(total.toFixed(2));
    }).catch(err => {throw err});
}
function fnNavTab(numTab){
    tabActual = numTab;
    let x = document.getElementsByClassName('tab');
    for(let i = 0; i<x.length;i++){
        x[i].style.display = 'none';
    }
    x[numTab].style.display = 'block';
}

function fnDetallesIgreso(value){
    let url = `${base_url}/CorteCaja/getDetallesIngreso/${value}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        let numeracion = 0;
        document.querySelector("#tbodyDetallesVenta").innerHTML = "";
        resultado.forEach(element => {
            numeracion += 1;
            let row ="<tr><td>"+numeracion+"</td><td>"+element.fecha+"</td><td>"+element.codigo+"</td><td>"+element.nombre+"</td><td>"+formatoMoneda(element.abono)+"</td><td>"+element.folio+"</td><td>"+element.nombre_usuario+"</td></tr>";
            document.querySelector('#tbodyDetallesVenta').innerHTML += row;
        });
    }).catch(err => {throw err});
}

function fnChangeTotalSegunCaja(){
    let x = document.querySelector('#totalesEfecMetoPago');
    let total = 0;
    x.childNodes.forEach(element => {
        let cantidad = element.childNodes[2].childNodes[0].value;
        if(isNaN(cantidad)){
            Swal.fire({
                title: 'Error!',
                text: "No se aceptan cadenas de texto!",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
              }).then((result) =>{
                element.childNodes[2].childNodes[0].value = 0;
            });
        }else{
            total += parseInt(cantidad);
        }
    });
    document.querySelector('#totalSCaja').textContent = formatoMoneda(total.toFixed(2));
    
}

function gnGuardarCorte(){
    if(idCaja == null || idCorteCaja == null){
        swal.fire("Atención","Selecciona una caja/cajero","warning");
        return false;
    }
    let url = `${base_url}/CorteCaja/setCorteCaja/${idCaja}/${idCorteCaja}`;
    Swal.fire({
        title: 'Corte de caja',
        text: "Desea realizar el corte de caja?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.isConfirmed) {
            fetch(url)
            .then(res => res.json())
            .then((resultado) =>{
                console.log(resultado);
                /* if(resultado){
                    Swal.fire(
                        'Exito!',
                        'Corte realizado correctamnte, y la <b>caja</b> se cerrará automaticamente.',
                        'success'
                    ).then((result) =>{
                        window.location.href = `${base_url}/Ingresos`;
                    })
                } */
            }).catch(err => {throw err});
        }
      })
}
function imprimirCorte(){
    console.log("imprimiendo");
}

//Function para dar formato un numero a Moneda
function formatoMoneda(numero){
    let str = numero.toString().split(".");
    str[0] = str[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return "$"+str.join(".");
}