document.addEventListener('DOMContentLoaded', function() {
    // Selectores principales
    // Usamos querySelector para mayor flexibilidad (clase o ID)
    const inputBuscador = document.querySelector('.buscador'); 
    const contenedorBuscador = document.querySelector('.buscador-contenedor');

    // Si no existe el buscador en esta página, detenemos el script
    if (!inputBuscador || !contenedorBuscador) return;

    // 1. Crear dinámicamente el contenedor de resultados (la lista flotante)
    const listaResultados = document.createElement('div');
    listaResultados.classList.add('resultados-busqueda');
    listaResultados.style.display = 'none'; // Oculto por defecto
    contenedorBuscador.appendChild(listaResultados);

    // 2. Evento: Escuchar cuando el usuario escribe
    inputBuscador.addEventListener('input', function() {
        const termino = inputBuscador.value.trim();

        // Si hay menos de 2 letras, ocultamos la lista y salimos
        if (termino.length < 2) {
            listaResultados.style.display = 'none';
            listaResultados.innerHTML = '';
            return;
        }

        // 3. Petición al servidor (Fetch)
        fetch(`php/buscar_productos.php?q=${encodeURIComponent(termino)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.productos.length > 0) {
                    mostrarListaResultados(data.productos);
                } else {
                    // Si no hay coincidencias, ocultamos la lista
                    listaResultados.style.display = 'none'; 
                }
            })
            .catch(error => console.error('Error en búsqueda:', error));
    });

    // 4. Función para dibujar la lista de productos encontrados
    function mostrarListaResultados(productos) {
        listaResultados.innerHTML = ''; // Limpiar resultados anteriores
        listaResultados.style.display = 'block'; // Mostrar la caja

        productos.forEach(producto => {
            const item = document.createElement('div');
            item.classList.add('item-resultado');
            
            // HTML interno del item: Imagen pequeña + Texto
            item.innerHTML = `
                <img src="imagenes/${producto.imagen}" alt="${producto.nombre}" class="img-mini" onerror="this.src='imagenes/logoPetPlanet.jpg'">
                <div class="info-mini">
                    <span class="nombre-mini">${producto.nombre}</span>
                    <span class="precio-mini">${producto.precio.toFixed(2)}€</span>
                </div>
            `;

            // Evento: Al hacer clic en un resultado
            item.addEventListener('click', () => {
                abrirModalProducto(producto); // Abrimos el modal
                listaResultados.style.display = 'none'; // Ocultamos la lista
                inputBuscador.value = ''; // Limpiamos el input (opcional)
            });

            listaResultados.appendChild(item);
        });
    }

    // 5. Función para abrir el Modal (Integra con tu modal existente)
    function abrirModalProducto(producto) {
        const modal = document.getElementById("modalProducto");
        if (!modal) return;

        // Referencias a los elementos dentro del modal
        const modalImagen = document.getElementById("modalImagen");
        const modalNombre = document.getElementById("modalNombre");
        const modalDescripcion = document.getElementById("modalDescripcion");
        const modalPrecio = document.getElementById("modalPrecio");
        const btnCesta = modal.querySelector(".btn-cesta");

        // Rellenar datos
        modalImagen.src = "imagenes/" + producto.imagen;
        modalNombre.textContent = producto.nombre;
        modalDescripcion.textContent = producto.descripcion || "Sin descripción disponible.";
        modalPrecio.textContent = "Precio: " + parseFloat(producto.precio).toFixed(2) + "€";
        
       
        const nuevoBtn = btnCesta.cloneNode(true);
        btnCesta.parentNode.replaceChild(nuevoBtn, btnCesta);
        
        nuevoBtn.addEventListener("click", () => {
            if (window.agregarAlCarrito) {
                window.agregarAlCarrito(
                    producto.nombre, 
                    producto.precio, 
                    producto.imagen, 
                    producto.descripcion
                );
            } else {
                console.error("La función agregarAlCarrito no está definida.");
            }
            modal.style.display = "none";
        });

        modal.style.display = "block";
        
        const listaComentarios = document.getElementById("listaComentarios");
        if (listaComentarios) {
             listaComentarios.innerHTML = '<p class="sin-comentarios">Cargando comentarios...</p>';
        }
    }

    // 6. Cerrar la lista si el usuario hace clic fuera del buscador
    document.addEventListener('click', function(e) {
        // Si el clic NO fue dentro del contenedor del buscador
        if (!contenedorBuscador.contains(e.target)) {
            listaResultados.style.display = 'none';
        }
    });
});