/**
 * Lógica de Salud e Higiene - Pet Planet
 * Incluye: Filtrado dinámico y efectos de Confeti
 */

// 1. Función Global de Confeti con Z-Index corregido para ali-sal-accyjcss.css
function lanzarConfeti() {
    if (typeof confetti === 'function') {
        confetti({
            particleCount: 150,
            spread: 70,
            origin: { y: 0.6 },
            zIndex: 999999, // Supera el position:relative de tus .producto
            colors: ['#1c692e', '#ad8d17', '#ff4444'] // Colores corporativos (Verde, Dorado, Rojo oferta)
        });
    } else {
        console.error("Librería canvas-confetti no detectada.");
    }
}

document.addEventListener('DOMContentLoaded', function() {
    
    // Selectores
    const selectorTipo = document.getElementById('filtro-tipo');
    const selectorPrecio = document.getElementById('filtro-precio');
    const productos = document.querySelectorAll('.producto');

    if (!selectorTipo || !selectorPrecio) return;

    // 2. Función de filtrado
    function filtrarProductos() {
        const tipoElegido = selectorTipo.value;
        const precioMaximoSeleccionado = selectorPrecio.value;

        // Lanzar confeti al cambiar cualquier filtro
        lanzarConfeti();

        productos.forEach(function(producto) {
            const tipoProducto = producto.getAttribute('data-tipo');
            const precioProducto = parseFloat(producto.getAttribute('data-precio'));

            const esTipoCorrecto = (tipoElegido === 'todos' || tipoElegido === tipoProducto);
            
            let esPrecioCorrecto = true;
            if (precioMaximoSeleccionado !== "todos") {
                const limite = parseInt(precioMaximoSeleccionado);
                esPrecioCorrecto = (precioProducto <= limite);
            }

            // Aplicar visibilidad
            if (esTipoCorrecto && esPrecioCorrecto) {
                producto.style.display = 'flex'; // Usamos flex por tu ali-sal.css
            } else {
                producto.style.display = 'none';
            }
        });
    }

    // 3. Escuchadores de eventos para Filtros
    selectorTipo.addEventListener('change', filtrarProductos);
    selectorPrecio.addEventListener('change', filtrarProductos);

    // 4. Delegación de eventos para botones (Compra y Cesta)
    // Esto asegura que funcione aunque el modal modifique el DOM
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btn-comprar') || 
            event.target.classList.contains('btn-cesta')) {
            lanzarConfeti();
        }
    });

    // Estado inicial: mostrar todos sin lanzar confeti al cargar
    productos.forEach(p => p.style.display = 'flex');
});