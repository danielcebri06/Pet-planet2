document.addEventListener("DOMContentLoaded", () => {

    //LOCALIZA EL BLOQUE DE FILTROS Y LISTA DE TARJETAS
    
    const filtrosBox = document.querySelector("[data-filtros]");  /*constante que almacena el elemento del DOM
    que tiene el atributo data-filtrosBox, que corresponde al contenedor de los filtros*/

    const lista = document.getElementById("mascotas-lista") || document.querySelector(".productos-lista");
    /*constante que referencia el contenedor de tarjetas, se obtiene por el id mascotas-lista y, si no existiese, lo obtiene por su clase*/

    if(!filtrosBox || !lista) return;  // si no existiese uno u el otro, no sigue ejecutándose el código

    const cards = Array.from(lista.querySelectorAll(".producto"));  /*obtenemos las tarjetas a filtrar .producto
    quereySelectorAll devuelve los nodos */

    const controles = Array.from(filtrosBox.querySelectorAll("[data-filter"));

    function aplicarFiltros(){
        let textoBusqueda ="";
        let tipo="";
        let edad ="";

        controles.forEach(control => {
            if(control.dataset.filter === "q"){
                textoBusqueda = control.value;
            }

            if(control.dataset.filter === "tipo"){
                tipo = control.value;
            }

            if(control.dataset.filter === "edad"){
                edad = control.value;
            }
        });


        cards.forEach(card => {
            let visible = true;

            //Filtro de texto
            if(textoBusqueda && !card.textContent.includes(textoBusqueda)){
                visible = false;
            }

            //Filtro por tipo
            if(tipo && tipo !== "todos" && card.dataset.tipo !==tipo){
                visible = false;
            }

            //Filtro por edad
            if(edad && edad !== "todas" && card.dataset.edad !==edad){
                visible = false;
            }

            card.style.display = visible ? "" : "none";  //mostramos u ocultamos
        });
    }

    controles.forEach(control => {
        const evento = control.tagName === "INPUT" ? "input" : "change";

        control.addEventListener(evento, aplicarFiltros);
    });

    aplicarFiltros();

});