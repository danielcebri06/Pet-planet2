//esperamos a que el DOM esté cargado y ponemos el async para poder usar await dentro
document.addEventListener('DOMContentLoaded', async () => {
    // 1. Buscamos el contenedor donde se van a pintar los productos
    const contenedor = document.getElementById('lista-productos');

    // Si no existe el contenedor (ej. estamos en el index o login), no hacemos nada
    if (!contenedor) return; 

    // 2. Detectamos en qué página estamos leyendo el atributo del body
    // Recuerda poner <body data-categoria="salud"> en SaludEHigiene.php
    const categoriaPagina = document.body.getAttribute('data-categoria');

    // 3. Mostramos mensaje de carga
    contenedor.innerHTML = '<p style="text-align:center; width:100%; font-size: 1.2em; color: #666;">Cargando productos...</p>';

    try {
        // 4. Verificamos que datos.js esté cargado
        if (typeof cargarBaseDeDatos !== 'function') {
            throw new Error("La función cargarBaseDeDatos no existe. Revisa que js/datos.js esté incluido antes de este script.");
        }
        
        // 5. Cargamos TODOS los productos(esperamos a q ue se resuelva la promesa)
        const todosLosProductos = await cargarBaseDeDatos();

        // 6. Filtramos los productos según la página
        let productosFiltrados = [];

        if (categoriaPagina === 'accesorios') {
            // Filtramos por las categorías típicas de accesorios
            productosFiltrados = todosLosProductos.filter(p => 
                p.categoria === 'juguete' || 
                p.categoria === 'hogar' || 
                p.categoria === 'transporte' ||
                p.categoria === 'Accesorios' // Por si acaso
            );
        } 
        else if (categoriaPagina === 'salud') {
            // Filtramos lo que sea Salud o Higiene. 
            // Si tus JSON no tienen categoría exacta, asumimos que lo que NO es accesorio ni alimento, es salud.
            productosFiltrados = todosLosProductos.filter(p => 
                p.categoria === 'SaludEHigiene' || 
                p.categoria === 'salud' ||
                (!p.categoria && !p.tipo) // Captura genérica si falta info
            );
        } 
        else if (categoriaPagina === 'alimentacion') {
            productosFiltrados = todosLosProductos.filter(p => p.categoria === 'Alimentación' || p.categoria === 'alimentacion');
        }
        else if (categoriaPagina === 'adopciones') {
             // Si tienes un json de adopciones, filtra aquí
             productosFiltrados = todosLosProductos.filter(p => p.categoria === 'Adopción' || p.tipo === 'perro-adopcion');
        }
        else {
            // Si no hay categoría definida (ej. "Ver todo"), mostramos todo
            productosFiltrados = todosLosProductos;
        }

        // 7. Renderizamos
        renderizarProductos(productosFiltrados, contenedor);

    } catch (error) {
        console.error("Error al listar productos:", error);
        contenedor.innerHTML = `<p style="text-align:center; color:red;">Hubo un error al cargar los productos: ${error.message}</p>`;
    }
});

function renderizarProductos(productos, contenedor) {
    contenedor.innerHTML = ''; // Limpiar mensaje de carga

    if (productos.length === 0) {
        contenedor.innerHTML = '<p style="text-align:center; width:100%;">No se encontraron productos en esta categoría.</p>';
        return;
    }

    productos.forEach(p => {
        // Normalización de precios
        let precioNormal = parseFloat(p.precio_original || p.precio || 0);
        let precioOferta = parseFloat(p.precio_oferta || 0);
        let hayOferta = (p.oferta === true || p.en_oferta === true) || (precioOferta > 0 && precioOferta < precioNormal);

        // Definir precio final para mostrar y para el carrito
        let precioFinal = hayOferta ? precioOferta : precioNormal;

        // HTML del precio
        let htmlPrecio;
        if (hayOferta) {
            htmlPrecio = `
                <p class="precio-original" style="text-decoration: line-through; color: #777; font-size: 0.9em;">${precioNormal.toFixed(2)}€</p>
                <p class="precio-oferta" style="color: #e74c3c; font-weight: bold; font-size: 1.1em;">${precioOferta.toFixed(2)}€</p>
            `;
        } else {
            htmlPrecio = `
                <p class="precio-normal" style="font-weight: bold; font-size: 1.1em;">${precioNormal.toFixed(2)}€</p>
            `;
        }

        // Etiqueta visual de oferta
        let etiquetaOferta = hayOferta ? '<div class="oferta-tag">¡OFERTA!</div>' : '';

        // Crear la tarjeta
        const card = document.createElement('div');
        card.className = 'producto'; 
        
        // Añadimos atributos data para que tus filtros (saludEHigiene.js) sigan funcionando
        card.setAttribute('data-tipo', p.tipo || 'todos'); 
        card.setAttribute('data-precio', precioFinal); 
        card.setAttribute('data-nombre', p.nombre);

        card.innerHTML = `
            <img src="imagenes/${p.imagen}" alt="${p.nombre}" loading="lazy">
            ${etiquetaOferta}
            <h2>${p.nombre}</h2>
            ${htmlPrecio}
            <button class="btn-comprar" 
                onclick="agregarAlCarrito('${p.nombre}', '${precioFinal}', '${p.imagen}', '${p.descripcion || ''}')">
                Comprar
            </button>
        `;

        contenedor.appendChild(card);
    });
}