var tabActual = 0;
mostrarTab(tabActual);

function mostrarTab(tabActual) {
    var tab = document.getElementsByClassName("tab");
    tab[tabActual].style.display = "block";
}
function fnNavTab(numTab){
    tabActual = numTab;
    var x = document.getElementsByClassName("tab");
    for( var i = 0; i<x.length;i++){
      x[i].style.display = "none";
    }
    x[numTab].style.display = "block";  
}