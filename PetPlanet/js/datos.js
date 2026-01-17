// js/datos.js

async function cargarBaseDeDatos() {
    // AQUÍ ESTABA EL PROBLEMA:
    // Antes buscaba 'saludEHigiene.json', ahora busca 'json/saludEHigiene.json'
    const archivos = [
        'json/accesorios.json',       
        'json/saludEHigiene.json',
        'json/adopciones.json'
    ];

    let todosLosProductos = [];

    try {
        const promesas = archivos.map(url => fetch(url).then(respuesta => {
            if (!respuesta.ok) {
                throw new Error(`No se pudo encontrar el archivo: ${url}`);
            }
            return respuesta.json();
        }));
        
        const resultados = await Promise.all(promesas);

        resultados.forEach(data => {
            let productosDelArchivo = [];
            
            // Detectar si es array directo o objeto con propiedad "productos"
            if (Array.isArray(data)) {
                productosDelArchivo = data; 
            } else if (data.productos && Array.isArray(data.productos)) {
                productosDelArchivo = data.productos; 
            }

            todosLosProductos = todosLosProductos.concat(productosDelArchivo);
        });

        return todosLosProductos;

    } catch (error) {
        console.error("Error cargando la base de datos JSON:", error);
        // Si falla, mostramos una alerta para que sepas qué archivo falta
        alert("Error: " + error.message);
        return [];
    }
}