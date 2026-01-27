document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Obtener selectores, productos y EL LOADER
    const selectorTipo = document.getElementById('filtro-tipo');
    const selectorCategoria = document.getElementById('filtro-categoria');
    const productos = document.querySelectorAll('.producto');
    const loader = document.getElementById('loader-container');

    // 2. Función de filtrado que RETORNA una Promesa
    function filtrarAccesorios() {
        return new Promise((resolve, reject) => {
            
            // Mostramos el loader justo antes de empezar
            loader.classList.remove('loader-hidden');

            const tipoElegido = selectorTipo.value;
            const categoriaElegida = selectorCategoria.value;
            let encontrados = 0;

            // Simulamos el retraso para que el usuario vea la "ventana de carga"
            setTimeout(() => {
                try {
                    productos.forEach(producto => {
                        const tipoProducto = producto.getAttribute('data-tipo');
                        const categoriaProducto = producto.getAttribute('data-categoria');

                        const esTipoCorrecto = (tipoElegido === 'todos' || tipoElegido === tipoProducto);
                        const esCategoriaCorrecta = (categoriaElegida === 'todas' || categoriaElegida === categoriaProducto);

                        if (esTipoCorrecto && esCategoriaCorrecta) {
                            producto.style.display = ''; 
                            encontrados++;
                        } else {
                            producto.style.display = 'none';
                        }
                    });

                    resolve(encontrados); 

                } catch (error) {
                    reject(error);
                }
            }, 600); //600ms para que la animación se aprecie mejor
        });
    }

    // 3. Manejador del evento
    function manejarCambio() {
        // Deshabilitar selects y mostrar feedback en consola
        selectorTipo.disabled = true;
        selectorCategoria.disabled = true;
        console.log("Iniciando filtrado...");

        filtrarAccesorios()
            .then((cantidad) => {
                console.log(`Filtrado completado. Se mostraron ${cantidad} productos.`);
            })
            .catch((error) => {
                console.error("Hubo un error al filtrar:", error);
            })
            .finally(() => {
                
                // Ocultamos el loader y reactivamos los selects al terminar
                loader.classList.add('loader-hidden');
                selectorTipo.disabled = false;
                selectorCategoria.disabled = false;
            });
    }

    // Asignar el manejador
    selectorTipo.addEventListener('change', manejarCambio);
    selectorCategoria.addEventListener('change', manejarCambio);

});