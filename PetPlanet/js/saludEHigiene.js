document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Obtener los selectores por su ID 
    const selectorTipo = document.getElementById('filtro-tipo');
    const selectorPrecio = document.getElementById('filtro-precio');
    const productos = document.querySelectorAll('.producto');

    // Comprobación de seguridad: si no existen los filtros, no ejecutar nada
    if (!selectorTipo || !selectorPrecio) return;

    // 2. Función de filtrado
    function filtrarProductos() {
        const tipoElegido = selectorTipo.value;
        const precioMaximoSeleccionado = selectorPrecio.value;

        productos.forEach(function(producto) {
            // Obtener el tipo
            const tipoProducto = producto.getAttribute('data-tipo');
            
            // PRECIO: Lo convertimos a número decimal (float) 
            const precioProducto = parseFloat(producto.getAttribute('data-precio'));

            // CONDICIÓN 1: Tipo de animal
            const esTipoCorrecto = (tipoElegido === 'todos' || tipoElegido === tipoProducto);

            // CONDICIÓN 2: Precio (Menor o igual al límite)
            let esPrecioCorrecto = true;
            if (precioMaximoSeleccionado !== "todos") {
                // Convertimos el límite de la casilla a número entero (int) 
                const limite = parseInt(precioMaximoSeleccionado);
                esPrecioCorrecto = (precioProducto <= limite);
            }

            // MOSTRAR U OCULTAR
            if (esTipoCorrecto && esPrecioCorrecto) {
                // Usamos '' en lugar de 'block' para que respete el flexbox/grid original del CSS
                producto.style.display = ''; 
            } else {
                producto.style.display = 'none';
            }
        });
    }

    // 3. Activar el filtro al cambiar las opciones
    selectorTipo.addEventListener('change', filtrarProductos);
    selectorPrecio.addEventListener('change', filtrarProductos);

    // Ejecutar al inicio para asegurar que la vista sea correcta
    filtrarProductos();
});