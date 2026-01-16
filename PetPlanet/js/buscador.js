document.addEventListener('DOMContentLoaded', () => {
    const inputBuscar = document.getElementById('buscadorPrincipal'); // ID sacado de tu index.php
    const btnBuscar = document.getElementById('btnBuscarPrincipal');  // ID sacado de tu index.php

    // Evento Click
    if (btnBuscar) {
        btnBuscar.addEventListener('click', realizarBusquedaLocal);
    }

    // Evento Enter
    if (inputBuscar) {
        inputBuscar.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                realizarBusquedaLocal();
            }
        });
    }
});

async function realizarBusquedaLocal() {
    const input = document.getElementById('buscadorPrincipal');
    const termino = input.value.toLowerCase().trim();

    if (termino.length < 2) {
        alert("Por favor, escribe al menos 2 letras para buscar.");
        return;
    }

    // 1. CARGA DE DATOS (Sin PHP, usando tu json local)
    // Llamamos a la función que está en js/datos.js
    let productos = [];
    try {
        if (typeof cargarBaseDeDatos === 'function') {
            productos = await cargarBaseDeDatos();
        } else {
            console.error("Error: No se encuentra la función cargarBaseDeDatos. Verifica que importaste js/datos.js");
            return;
        }
    } catch (error) {
        console.error("Error al cargar productos:", error);
        return;
    }

    // 2. FILTRADO (La magia de JS en lugar de SQL)
    const resultados = productos.filter(producto => {
        // Buscamos en nombre O descripción (evitamos errores si descripción es null)
        const nombre = producto.nombre ? producto.nombre.toLowerCase() : '';
        const desc = producto.descripcion ? producto.descripcion.toLowerCase() : '';
        
        return nombre.includes(termino) || desc.includes(termino);
    });

    // 3. MOSTRAR RESULTADOS
    mostrarResultadosModal(resultados);
}

function mostrarResultadosModal(productos) {
    // Limpiamos modal anterior si existe
    const modalExistente = document.getElementById('resultados-busqueda-modal');
    if (modalExistente) modalExistente.remove();

    if (productos.length === 0) {
        alert("No se encontraron productos con esa búsqueda.");
        return;
    }

    // Crear la estructura del modal dinámicamente
    const modal = document.createElement('div');
    modal.id = 'resultados-busqueda-modal';
    modal.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.8); z-index: 10000; display: flex;
        justify-content: center; align-items: center;
    `;

    let htmlLista = '';
    productos.forEach(p => {
        // Normalización de precios (algunos JSON tienen precio_oferta, otros no)
        const precio = p.precio_oferta || p.precio_original || p.precio || '0.00';
        
        htmlLista += `
            <div style="background: white; padding: 10px; margin-bottom: 10px; border-radius: 5px; display: flex; gap: 10px; align-items: center;">
                <img src="imagenes/${p.imagen}" style="width: 50px; height: 50px; object-fit: contain;">
                <div style="flex: 1;">
                    <h4 style="margin: 0; font-size: 16px;">${p.nombre}</h4>
                    <p style="margin: 0; color: green; font-weight: bold;">${precio}€</p>
                </div>
                <button onclick="agregarAlCarrito('${p.nombre}', '${precio}', '${p.imagen}', 'Desde buscador')" 
                        style="background: #27ae60; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px;">
                    Añadir
                </button>
            </div>
        `;
    });

    modal.innerHTML = `
        <div style="background: #f4f4f4; width: 90%; max-width: 500px; max-height: 80vh; overflow-y: auto; padding: 20px; border-radius: 8px; position: relative;">
            <button onclick="document.getElementById('resultados-busqueda-modal').remove()" 
                    style="position: absolute; top: 10px; right: 10px; background: transparent; border: none; font-size: 20px; cursor: pointer;">❌</button>
            <h2 style="margin-top: 0;">Resultados (${productos.length})</h2>
            <div style="margin-top: 15px;">
                ${htmlLista}
            </div>
        </div>
    `;

    document.body.appendChild(modal);
}