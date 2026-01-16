// js/buscador.js

document.addEventListener('DOMContentLoaded', () => {
    //llamamos a los elementos del DOM
    const input = document.getElementById('buscadorPrincipal');
    const btn = document.getElementById('btnBuscarPrincipal');

    //cuando se haga click en el boton o se presione enter en el input, se ejecuta la busqueda
    if (btn) btn.addEventListener('click', buscarProductos);
    if (input) {
        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') buscarProductos();
        });
    }
});
// Función principal de búsqueda asíncrona async hace que la función retorne una promesa 
// y permite el uso de await dentro de ella hasta esperar a que se resuelvan otras promesas
async function buscarProductos() {
    const input = document.getElementById('buscadorPrincipal');
    const termino = input.value.toLowerCase().trim();

    if (termino.length < 2) {
        alert("Por favor escribe al menos 2 caracteres.");
        return;
    }

    // Usamos la función del archivo datos.js
    const productos = await cargarBaseDeDatos();

    // Filtramos (simulando el LIKE de SQL)
    const resultados = productos.filter(p => 
        p.nombre.toLowerCase().includes(termino) || 
        (p.descripcion && p.descripcion.toLowerCase().includes(termino))
    );

    mostrarResultadosEnModal(resultados);
}

function mostrarResultadosEnModal(productos) {
    // Eliminar modal anterior si existe
    const viejoModal = document.getElementById('modal-busqueda');
    if (viejoModal) viejoModal.remove();

    const modal = document.createElement('div');
    modal.id = 'modal-busqueda';
    modal.style.cssText = "position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;display:flex;justify-content:center;align-items:center;";

    let contenidoHTML = `<div style="background:white;padding:20px;width:90%;max-width:600px;max-height:80vh;overflow-y:auto;border-radius:8px;position:relative;">
        <button onclick="document.getElementById('modal-busqueda').remove()" style="position:absolute;top:10px;right:10px;border:none;background:transparent;font-size:20px;cursor:pointer;">❌</button>
        <h2>Resultados (${productos.length})</h2>`;

    if (productos.length === 0) {
        contenidoHTML += `<p>No se encontraron productos.</p>`;
    } else {
        productos.forEach(p => {
            // Manejo de precio (algunos tienen precio_oferta, otros precio_original)
            let precioFinal = p.precio_oferta || p.precio_original || 0;
            
            contenidoHTML += `
                <div style="border-bottom:1px solid #eee;padding:10px;display:flex;align-items:center;gap:15px;">
                    <img src="imagenes/${p.imagen}" style="width:50px;height:50px;object-fit:contain;">
                    <div style="flex-grow:1;">
                        <strong>${p.nombre}</strong>
                        <div style="color:green;font-weight:bold;">${parseFloat(precioFinal).toFixed(2)}€</div>
                    </div>
                    <button onclick="agregarAlCarrito('${p.nombre}', '${precioFinal}', '${p.imagen}', '${p.descripcion || ''}')" 
                            style="background:#27ae60;color:white;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;">
                        Añadir
                    </button>
                </div>
            `;
        });
    }

    // Cerrar el div del contenido
    contenidoHTML += `</div>`;
    modal.innerHTML = contenidoHTML;
    // Agregar modal al body
    //appendChild agrega un nodo al final de la lista de hijos de un nodo padre especificado
    document.body.appendChild(modal);
}