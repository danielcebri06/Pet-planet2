/**
 * Lógica de Salud e Higiene - Pet Planet
 * Actualizada para garantizar Confeti en botones
 */

// 1. Función Global de Confeti
function lanzarConfeti() {
    // Verificamos si la librería cargó correctamente
    if (typeof confetti === 'function') {
        
        // Efecto 1: Disparo central
        confetti({
            particleCount: 1000,
            spread: 500,
            origin: { y: 0.5 },
            zIndex: 9999999, // Z-Index muy alto para que salga ENCIMA del modal
            
        });

        // Efecto 2: Pequeños disparos laterales (opcional, para más fiesta)
        setTimeout(() => {
            confetti({
                particleCount: 1000,
                angle: 60,
                spread: 500,
                origin: { x: 0 },
                zIndex: 9999999,
                
              
            });
            
        }, 200);
        setTimeout(() => {
        confetti({
                particleCount: 1000,
                angle: 120,
                spread: 500,
                origin: { x: 1 },
                zIndex: 9999999,
                
            });
            }, 400);

    } else {
        console.warn("La librería canvas-confetti no se ha cargado aún.");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    
    // Selectores de filtros
    const selectorTipo = document.getElementById('filtro-tipo');
    const selectorPrecio = document.getElementById('filtro-precio');
    const productos = document.querySelectorAll('.producto');

    // 2. Función de filtrado
    function filtrarProductos() {
        if (!selectorTipo || !selectorPrecio) return;

        const tipoElegido = selectorTipo.value;
        const precioMaximoSeleccionado = selectorPrecio.value;

        // Opcional: Si quieres confeti al filtrar, descomenta la siguiente línea
        // lanzarConfeti(); 

        productos.forEach(function(producto) {
            const tipoProducto = producto.getAttribute('data-tipo');
            const precioProducto = parseFloat(producto.getAttribute('data-precio'));

            const esTipoCorrecto = (tipoElegido === 'todos' || tipoElegido === tipoProducto);
            
            let esPrecioCorrecto = true;
            if (precioMaximoSeleccionado !== "todos") {
                const limite = parseInt(precioMaximoSeleccionado);
                esPrecioCorrecto = (precioProducto <= limite);
            }

            if (esTipoCorrecto && esPrecioCorrecto) {
                producto.style.display = 'flex'; 
            } else {
                producto.style.display = 'none';
            }
        });
    }

    // Escuchadores para filtros
    if(selectorTipo) selectorTipo.addEventListener('change', filtrarProductos);
    if(selectorPrecio) selectorPrecio.addEventListener('change', filtrarProductos);

    // Estado inicial
    productos.forEach(p => p.style.display = 'flex');
});

/**
 * 3. DETECTOR DE CLICS GLOBAL (Fuera del DOMContentLoaded)
 * Usamos {capture: true} para asegurar que detectamos el clic ANTES 
 * que el modal o el carrito detengan la propagación.
 */
document.addEventListener('click', function(event) {
    // Verifica si el elemento clicado (o su padre) tiene la clase deseada
    
    if (event.target.matches('.btn-comprar') || event.target.matches('.btn-cesta')) {
        lanzarConfeti();

    }
}, true); // <--- El 'true' es la clave: fase de captura