// js/datos.js

async function cargarBaseDeDatos() {
    const archivos = [
        'json/accesorios.json',       
        'json/saludEHigiene.json',
        'json/adopciones.json' // ¡Perfecto que lo hayas añadido!
    ];

    let todosLosProductos = [];

    try {
        // TRUCO ANTI-CACHÉ: Añadimos una "marca de tiempo" a la URL
        // Así el navegador cree que es un archivo nuevo cada vez y no usa la memoria vieja.
        const promesas = archivos.map(url => 
            fetch(url + '?t=' + Date.now()).then(respuesta => {
                if (!respuesta.ok) {
                    throw new Error(`No se pudo encontrar el archivo: ${url}`);
                }
                return respuesta.json();
            })
        );
        
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
        alert("Error: " + error.message);
        return [];
    }
}