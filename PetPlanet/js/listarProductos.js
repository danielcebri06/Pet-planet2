// Esperamos a que el DOM esté cargado
document.addEventListener('DOMContentLoaded', async () => {
    // 1. Buscamos el contenedor por ID
    const contenedor = document.getElementById('productos-lista');

    // Si no existe el contenedor (ej. estamos en el index o login), no hacemos nada
    if (!contenedor) return; 

    // 2. Detectamos categoría
    const categoriaPagina = document.body.getAttribute('data-categoria');

    // 3. Mensaje de carga
    contenedor.innerHTML = '<p style="text-align:center; width:100%; font-size: 1.2em; color: #666;">Cargando productos...</p>';

    try {
        // 4. Verificamos datos.js
        if (typeof cargarBaseDeDatos !== 'function') {
            throw new Error("La función cargarBaseDeDatos no existe. Revisa que js/datos.js esté incluido antes.");
        }
        
        // 5. Cargamos TODOS los productos
        const todosLosProductos = await cargarBaseDeDatos();

        // 6. Filtramos
        let productosFiltrados = [];

        if (categoriaPagina === 'accesorios') {
            productosFiltrados = todosLosProductos.filter(p => 
                p.categoria === 'juguete' || 
                p.categoria === 'hogar' || 
                p.categoria === 'transporte' ||
                p.categoria === 'Accesorios'
            );
        } 
        else if (categoriaPagina === 'salud') {
            // CORREGIDO: Faltaba un || antes del paréntesis final
            productosFiltrados = todosLosProductos.filter(p => 
                p.categoria === 'Salud e Higiene' || 
                p.categoria === 'salud' ||
                p.categoria === 'Salud e Higiene' || 
                (!p.categoria && !p.tipo) 
            );
        } 
        else if (categoriaPagina === 'alimentacion') {
            productosFiltrados = todosLosProductos.filter(p => p.categoria === 'Alimentación' || p.categoria === 'alimentacion');
        }
        else if (categoriaPagina === 'adopciones') {
             productosFiltrados = todosLosProductos.filter(p => p.categoria === 'Adopción' || p.tipo === 'perro-adopcion');
        }
        else {
            productosFiltrados = todosLosProductos;
        }

        // 7. Renderizamos
        renderizarProductos(productosFiltrados, contenedor);

    } catch (error) {
        console.error("Error al listar productos:", error);
        contenedor.innerHTML = `<p style="text-align:center; color:red;">Hubo un error: ${error.message}</p>`;
    }
});

function renderizarProductos(productos, contenedor) {
    contenedor.innerHTML = ''; 

    if (productos.length === 0) {
        contenedor.innerHTML = '<p style="text-align:center; width:100%;">No se encontraron productos en esta categoría.</p>';
        return;
    }

    productos.forEach(p => {
        // Precios
        let precioNormal = parseFloat(p.precio_original || p.precio || 0);
        let precioOferta = parseFloat(p.precio_oferta || 0);
        let hayOferta = (p.oferta === true || p.en_oferta === true) || (precioOferta > 0 && precioOferta < precioNormal);
        let precioFinal = hayOferta ? precioOferta : precioNormal;

        // IMPORTANTE: Limpiamos comillas para que no rompan el HTML del onclick
        let nombreLimpio = p.nombre.replace(/'/g, "\\'").replace(/"/g, "&quot;");
        let descripcionLimpia = (p.descripcion || '').replace(/'/g, "\\'").replace(/"/g, "&quot;").replace(/\n/g, " ");

        // HTML del precio visual
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

        let etiquetaOferta = hayOferta ? '<div class="oferta-tag">¡OFERTA!</div>' : '';

        const card = document.createElement('div');
        card.className = 'producto'; 
        
        // Data attributes para filtros
        card.setAttribute('data-tipo', p.tipo || 'todos'); 
        card.setAttribute('data-precio', precioFinal); 
        card.setAttribute('data-nombre', p.nombre);

        card.innerHTML = `
            <img src="imagenes/${p.imagen}" alt="${nombreLimpio}" loading="lazy">
            ${etiquetaOferta}
            <h2>${p.nombre}</h2>
            ${htmlPrecio}
            <button class="btn-comprar" 
                onclick="abrirModalProducto('${nombreLimpio}', '${precioFinal}', '${p.imagen}', '${descripcionLimpia}')">
                Comprar
            </button>
        `;

        contenedor.appendChild(card);
    });
}