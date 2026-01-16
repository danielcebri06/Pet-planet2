// js/listarProductos.js

document.addEventListener('DOMContentLoaded', async () => {
    // Detectar en qué página estamos para saber qué categoría cargar
    const path = window.location.pathname;
    const contenedor = document.getElementById('lista-productos'); // Asegúrate de tener este ID en tu HTML principal
    
    if (!contenedor) return; // Si no hay contenedor, no hacemos nada

    let filtroCategoria = null; // 'todos', 'juguete', 'hogar', etc.
    let filtroTipoMascota = null; // 'perro', 'gato', 'pajaro'
    
    // Lógica simple para saber qué filtrar según el nombre del archivo HTML
    if (path.includes('Accesorios')) {
        // En accesorios mostramos todo lo que venga de accesorios.json (o filtramos por categoría interna)
        // Como accesorios.json ya son solo accesorios, cargamos todo o filtramos si usas botones.
    } else if (path.includes('SaludEHigiene')) {
       // Igual para salud
    }

    // 1. Obtenemos TODOS los productos
    const todos = await cargarBaseDeDatos();

    // 2. Filtramos según la página actual
    // NOTA: Para simplificar, aquí filtraremos por el nombre del archivo origen o propiedades del JSON
    // Si quieres filtrar específicamente por 'perro' o 'gato', deberás agregar botones en tu HTML que llamen a renderizar()
    
    // Ejemplo: Si estamos en SaludEHigiene.html, filtramos los que vienen del JSON de salud (o por alguna propiedad)
    // Una estrategia mejor: Detectar qué JSON renderizar basándonos en una clase en el body o una variable global.
    
    // Vamos a renderizar TODO lo que coincida con la logica de la pagina:
    let productosA_Mostrar = todos;

    if (document.body.classList.contains('pagina-accesorios')) {
        // Filtramos solo los que tengan categoría juguete o hogar (basado en tu json)
        productosA_Mostrar = todos.filter(p => p.categoria === 'juguete' || p.categoria === 'hogar');
    } else if (document.body.classList.contains('pagina-salud')) {
        // Filtramos por lógica de salud (tu json de salud tiene estructura distinta, pero ya está normalizado)
        // Una forma segura es ver si tienen ID numérico bajo o alguna propiedad única, 
        // pero lo ideal es cargar SOLO el json especifico si la pagina es especifica.
        
        // PAUSA: Para hacerlo más fácil y limpio sin mezclar:
        // Cargaré solo el JSON específico de la página
    }

    renderizarGrid(productosA_Mostrar, contenedor);
});

function renderizarGrid(lista, contenedor) {
    contenedor.innerHTML = '';
    
    lista.forEach(p => {
        let precioReal = p.precio_oferta || p.precio_original;
        let precioHTML = '';
        
        if (p.en_oferta || p.oferta) {
            precioHTML = `<span style="text-decoration:line-through;color:red;margin-right:5px;">${p.precio_original}€</span> 
                          <span style="font-weight:bold;color:green;">${p.precio_oferta}€</span>`;
        } else {
            precioHTML = `<span style="font-weight:bold;">${precioReal}€</span>`;
        }

        const card = document.createElement('div');
        card.className = 'producto-card'; // Asegúrate de tener CSS para esto
        card.innerHTML = `
            <img src="imagenes/${p.imagen}" alt="${p.nombre}">
            <h3>${p.nombre}</h3>
            <p>${p.descripcion || ''}</p>
            <div class="precios">${precioHTML}</div>
            <button onclick="agregarAlCarrito('${p.nombre}', '${precioReal}', '${p.imagen}', '${p.descripcion}')" class="btn-agregar">
                Añadir al Carrito
            </button>
        `;
        contenedor.appendChild(card);
    });
}