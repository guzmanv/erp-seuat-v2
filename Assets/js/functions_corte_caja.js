function fnSelectCajero(value){
    let id_caja = value;
    let url = `${base_url}/CorteCaja/getCaja/${id_caja}`;
    fetch(url)
    .then(res => res.json())
    .then((resultado) => {
        if(resultado){
            document.querySelector('#num_caja').value = resultado;
        }
    }).catch(err => { throw err });
}