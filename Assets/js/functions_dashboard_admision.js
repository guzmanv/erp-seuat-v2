document.addEventListener('DOMContentLoaded', function(){
    let plantel = "all";
    fnTotalesCard(plantel);
    //plEstudioMateriabyPlantel(plantel);
    //document.querySelector('#sales-chart-plantel').style.display = "none";
    //document.querySelector('#sales-chart').style.display = "none";
    document.querySelector('.divnomplant').style.display = "none";
});
function plataformaSeleccionada(value){
    let nombrePlantel = document.querySelector('#listPlataformas').options[document.querySelector('#listPlataformas').selectedIndex].text;
    document.querySelector('.plntuno').innerHTML = nombrePlantel;
    var plantel = value;
    fnTotalesCard(plantel);
    //plEstudioMateriabyPlantel(plantel);

}
function fnTotalesCard(plantel){
    let url = base_url+"/DashboardAdmision/getTotalesCard/"+plantel;
    fetch(url).then(res => res.json()).then((resultado) => {
        if(resultado.tipo == "all"){
            document.querySelector('.divnomplant').style.display = "none";
            document.querySelector('.divplant').style.display = "block";
            //document.querySelector('#sales-chart').style.display = "flex";
            //document.querySelector('#sales-chart-plantel').style.display = "none";
            document.querySelector('.plnt').innerHTML=resultado.planteles;
            document.querySelector('.pros').innerHTML=resultado.prospectos;
            document.querySelector('.ins').innerHTML=resultado.inscritos;
            //document.querySelector('.rvoeexp').innerHTML=resultado.rvoes;
            //document.getElementById('btnRvoesExp').setAttribute('onClick', 'fnRvoeExp();' );
        }else{
            document.querySelector('.divnomplant').style.display = "block";
            //document.querySelector('#sales-chart').style.display = "none";
            //document.querySelector('#sales-chart-plantel').style.display = "flex";
            document.querySelector('.divplant').style.display = "none";
            document.querySelector('.pros').innerHTML=resultado.prospectos;
            document.querySelector('.ins').innerHTML=resultado.inscritos;
            //document.querySelector('.mat').innerHTML=resultado.materias;
            //document.querySelector('.rvoeexp').innerHTML=resultado.rvoes;
            //document.getElementById('btnRvoesExp').setAttribute('onClick', 'fnRvoeExp('+plantel+');' ); */
        }
        }).catch(err => { throw err });
}