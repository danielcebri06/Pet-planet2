

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

