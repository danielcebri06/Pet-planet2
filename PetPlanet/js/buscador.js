document.addEventListener('DOMContentLoaded', () => {
    // 1. SELECTORES
    const inputBuscador = document.querySelector('.buscador') || document.getElementById('buscadorPrincipal');
    const contenedorBuscador = document.querySelector('.buscador-contenedor');

    // Validación de seguridad: si no existen en este HTML, no hacemos nada
    if (!inputBuscador || !contenedorBuscador) return;

    // Aseguramos que el contenedor tenga posición relativa para que la lista se pegue a él
    contenedorBuscador.style.position = 'relative';

    // 2. CREAR LA LISTA FLOTANTE (Oculta al principio)
    const listaResultados = document.createElement('div');
    listaResultados.id = 'resultados-busqueda-flotante';
    
    // Estilos directos (CSS en JS) para asegurar que se vea bien sin tocar tu css externo
    Object.assign(listaResultados.style, {
        position: 'absolute',
        top: '100%', // Justo debajo del input
        left: '0',
        width: '100%',
        backgroundColor: '#fff',
        boxShadow: '0 4px 6px rgba(0,0,0,0.1), 0 1px 3px rgba(0,0,0,0.08)',
        borderRadius: '0 0 8px 8px',
        zIndex: '9999',
        display: 'none', // Oculto por defecto
        maxHeight: '400px', // Scroll si hay muchos
        overflowY: 'auto',
        border: '1px solid #e2e8f0'
    });

    contenedorBuscador.appendChild(listaResultados);

    // 3. EVENTO: AL ESCRIBIR (Input)
    inputBuscador.addEventListener('input', async function() {
        const termino = this.value.toLowerCase().trim();

        // Si hay menos de 2 letras, ocultamos y salimos
        if (termino.length < 2) {
            cerrarLista();
            return;
        }

        // Cargar datos usando la función de datos.js
        let productos = [];
        if (typeof cargarBaseDeDatos === 'function') {
            try {
                productos = await cargarBaseDeDatos();
            } catch (e) {
                console.error("Error al buscar:", e); 
                return;
            }
        } else {
            console.error("Falta js/datos.js");
            return;
        }

        // Filtrar productos (Buscamos en nombre y descripción)
        const resultados = productos.filter(p => {
            const nombre = p.nombre ? p.nombre.toLowerCase() : '';
            const desc = p.descripcion ? p.descripcion.toLowerCase() : '';
            return nombre.includes(termino) || desc.includes(termino);
        });

        // Mostrar resultados
        dibujarResultados(resultados);
    });

    // 4. DIBUJAR LA LISTA
    function dibujarResultados(productos) {
        listaResultados.innerHTML = ''; // Limpiar lo anterior

        if (productos.length === 0) {
            // Mensaje de "No encontrado"
            const noEncontrado = document.createElement('div');
            noEncontrado.textContent = "Sin resultados...";
            Object.assign(noEncontrado.style, {
                padding: '15px',
                color: '#888',
                fontSize: '14px',
                textAlign: 'center'
            });
            listaResultados.appendChild(noEncontrado);
        } else {
            // Limitamos a 6 resultados para que no sea infinito
            const topProductos = productos.slice(0, 6);

            topProductos.forEach(p => {
                const item = document.createElement('div');
                
                // Estilos del item
                Object.assign(item.style, {
                    display: 'flex',
                    alignItems: 'center',
                    padding: '10px',
                    borderBottom: '1px solid #f0f0f0',
                    cursor: 'pointer',
                    transition: 'background 0.2s',
                    backgroundColor: '#fff'
                });

                // Efecto Hover
                item.onmouseenter = () => item.style.backgroundColor = '#f7fafc';
                item.onmouseleave = () => item.style.backgroundColor = '#fff';

                // Precios
                let precio = p.precio_oferta || p.precio_original || p.precio || 0;

                item.innerHTML = `
                    <img src="imagenes/${p.imagen}" style="width: 40px; height: 40px; object-fit: contain; margin-right: 10px; border-radius: 4px; background: white;">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 14px; color: #2d3748;">${p.nombre}</div>
                        <div style="font-size: 13px; color: #27ae60; font-weight: bold;">${parseFloat(precio).toFixed(2)}€</div>
                    </div>
                    <button class="btn-mini-add" title="Añadir al carrito" style="
                        background: #e2e8f0; 
                        border: none; 
                        border-radius: 50%; 
                        width: 30px; height: 30px; 
                        cursor: pointer; 
                        display: flex; align-items: center; justify-content: center; 
                        font-size: 16px;
                        transition: background 0.2s;
                    ">
                        🛒
                    </button>
                `;

                // CLIC EN EL ITEM: Añadir al carrito
                item.addEventListener('click', () => {
                    if (typeof agregarAlCarrito === 'function') {
                        agregarAlCarrito(p.nombre, precio, p.imagen, p.descripcion || '');
                    } else {
                        alert("Producto: " + p.nombre + " (Carrito no cargado)");
                    }
                    cerrarLista();
                    inputBuscador.value = ''; // Limpiar buscador tras añadir
                });

                listaResultados.appendChild(item);
            });
        }

        listaResultados.style.display = 'block';
    }

    // 5. CERRAR LISTA
    function cerrarLista() {
        listaResultados.style.display = 'none';
        listaResultados.innerHTML = '';
    }

    // 6. CERRAR AL HACER CLIC FUERA
    document.addEventListener('click', (e) => {
        if (!contenedorBuscador.contains(e.target)) {
            cerrarLista();
        }
    });

    // 7. TECLA ESCAPE
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            cerrarLista();
            inputBuscador.blur();
        }
    });
});