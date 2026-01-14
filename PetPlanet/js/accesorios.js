document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Obtener los selectores por su ID
    var selectorTipo = document.getElementById('filtro-tipo');
    var selectorCategoria = document.getElementById('filtro-categoria');
    
    // Obtener todos los productos
    var productos = document.querySelectorAll('.producto');

    // 2. Función de filtrado
    function filtrarAccesorios() {
        var tipoElegido = selectorTipo.value;
        var categoriaElegida = selectorCategoria.value;

        productos.forEach(function(producto) {
            // Leer los datos del HTML (data-tipo y data-categoria)
            var tipoProducto = producto.getAttribute('data-tipo');
            var categoriaProducto = producto.getAttribute('data-categoria');

            // CONDICIÓN 1: Tipo de animal
            var esTipoCorrecto = (tipoElegido === 'todos' || tipoElegido === tipoProducto);

            // CONDICIÓN 2: Categoría (Juguete vs Hogar)
            var esCategoriaCorrecta = (categoriaElegida === 'todas' || categoriaElegida === categoriaProducto);

            // Mostrar u ocultar
            if (esTipoCorrecto && esCategoriaCorrecta) {
                producto.style.display = ''; 
            } else {
                producto.style.display = 'none';
            }
        });
    }

    // 3. Activar el filtro al cambiar las opciones
    selectorTipo.addEventListener('change', filtrarAccesorios);
    selectorCategoria.addEventListener('change', filtrarAccesorios);

});