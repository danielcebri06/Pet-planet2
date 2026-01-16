// js/datos.js

/**
 * Carga todos los archivos JSON y devuelve una promesa con todos los productos unificados.
 */
async function cargarBaseDeDatos() {
    const archivos = [
        'accesorios.json',
        'saludEHigiene.json'
        // Agrega 'alimentacion.json' aquí si lo creas
    ];

    let todosLosProductos = [];

    try {
        const promesas = archivos.map(url => fetch(url).then(res => res.json()));
        const resultados = await Promise.all(promesas);

        resultados.forEach(data => {
            // Normalizar: algunos JSON son arrays directos, otros tienen propiedad "productos"
            let productosDelArchivo = [];
            
            if (Array.isArray(data)) {
                productosDelArchivo = data; // Caso accesorios.json
            } else if (data.productos && Array.isArray(data.productos)) {
                productosDelArchivo = data.productos; // Caso saludEHigiene.json
            }

            // Añadimos estos productos a la lista general
            todosLosProductos = todosLosProductos.concat(productosDelArchivo);
        });

        return todosLosProductos;

    } catch (error) {
        console.error("Error cargando la base de datos JSON:", error);
        return [];
    }
}