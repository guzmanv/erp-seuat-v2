function fnSelectCajero(value){
    let id_caja = value;
    let url = `${base_url}/CorteCaja/getCaja/${id_caja}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        if(resultado.estatus){
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
    }).catch(err => { throw err });
}
function fnTotalesMetodosPago(){
    let url = `${base_url}/CorteCaja/getTotalesMetodosPago`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) =>{
        console.log(resultado);
    }).catch(err => {throw err});
}