let idCaja = null;
let tabActual = 0;
let idCorteCaja = null;
let total = 0;
let totalSCaja = 0;
let arrTotales = [];

function fnSelectCajero(value){
    if(value == ''){
        swal.fire("Atención","Selecciona una caja/cajero","warning");
        return false;
    }
    let id_caja = value;
    total = 0;
    totalSCaja = 0;
    arrTotales = [];
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
                fnTotalesMetodosPago(id_caja);
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
function fnTotalesMetodosPago(id_caja){
    let url = `${base_url}/CorteCaja/getTotalesMetodosPago/${id_caja}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        let numeracion = -1;
        document.querySelector('#totalesEfecMetoPago').innerHTML = "";
        document.querySelector('#nav-tab').innerHTML = "";
        resultado['totales'].forEach(element => {
            let arr = {'id_metodo_pago':element.id,'total':element.total};
            arrTotales.push(arr);
            total += element.total;
            numeracion += 1;
            let row = "<tr id='"+element.id+"'><th scope='row'>"+element.metodo+"</th><td><input type='text' class='form-control' value='"+formatoMoneda(element.total.toFixed(2))+"' disabled></td><td><input type='text' class='form-control' placeholder='$0.00' value='0' onkeyup = 'fnChangeTotalSegunCaja()'></td></tr>";
            let content = "";
            document.querySelector('#totalesEfecMetoPago').innerHTML += row;
            document.querySelector('#nav-tab').innerHTML +='<a class="nav-link tab-nav" id="'+numeracion+'-tab" data-toggle="tab" href="" onclick="fnNavTab('+numeracion+')" >'+element.metodo+'</a>';
            let numRow = 0;
            document.querySelector('#content-nav').innerHTML = "";
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
    let totalCaja = 0;
    x.childNodes.forEach(element => {
        let cantidad = element.childNodes[2].childNodes[0].value;
        let id_metodo = element.id;
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
            totalCaja += parseInt(cantidad);
            for(let i = 0; i<arrTotales.length;i++){
                if(arrTotales[i].id_metodo_pago == id_metodo){
                    let val = {'id_metodo_pago':arrTotales[i].id_metodo_pago,'total':arrTotales[i].total,'total_caja':parseFloat(cantidad)};
                    arrTotales[i] = val;
                }
            }
        }
    });
    totalSCaja = totalCaja;
    document.querySelector('#totalSCaja').textContent = formatoMoneda(totalCaja.toFixed(2));
    let diferencia = total-totalCaja;
    if(diferencia<0){
        document.querySelector('#sobrante').value = formatoMoneda(diferencia*(-1).toFixed(2));
        document.querySelector('#faltante').value = "$0.00";
    }else{
        document.querySelector('#sobrante').value = "$0.00"
        document.querySelector('#faltante').value = formatoMoneda(diferencia.toFixed(2));
    }

    
}

function gnGuardarCorte(){
    let arrCorte = [];
    let observacion = document.querySelector('#observaciones').value;
    arrCorte = {'totales':arrTotales,'observaciones':observacion,'id_corte_caja':idCorteCaja,'id_caja':idCaja};
    arrCorte = JSON.stringify(arrCorte);
    if(idCaja == null || idCorteCaja == null){
        swal.fire("Atención","Selecciona una caja/cajero","warning");
        return false;
    }
    if(totalSCaja <= 0){
        swal.fire("Atención","Error en las cantidades Segun caja, <b>corregir</b>","warning");
        return false;
    }
    let url = `${base_url}/CorteCaja/setCorteCaja/${idCaja}/${idCorteCaja}/${convToBase64(arrCorte)}`;
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
                Swal.fire({
                    title: 'Ingrese...',
                    html: '<p>Una vez confirmada, automaticante se cerrará la <b>caja actual</b></p><br><input type="text" id="cantidadEntregar" class="form-control" placeholder="Cantidad a entregar"><br><select class="custom-select"><option selected>Seleccionar cajero(a)</option><option value="1">Jose Santiz Ruiz</option><option value="2">Francisco Gomez perez</option><option value="3">Victor Manuel Guzman Muela</option></select>',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'si',
                    cancelButtonText:'Cancelar'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        let cantidadEntregada = document.querySelector("#cantidadEntregar").value;
                        if(cantidadEntregada == ''){
                            swal.fire("Atención","Ingrese una cantidad","warning");
                            return false;
                        }
                        console.log(cantidadEntregada);
                      /* Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      ) */
                    }
                  })
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

function convToBase64(string){
    let value = window.btoa(unescape(encodeURIComponent(string)));
    return value;
}  