class PetPlanetAPI {
 static baseURL = 'http://localhost/pet-planet/php';
    // Obtener productos por categoría
    static async obtenerProductos(categoria = '', tipoMascota = '') {
        try {
            let url = `${this.baseURL}/obtener_productos.php`;
            const params = new URLSearchParams();
            
            if (categoria) params.append('categoria', categoria);
            if (tipoMascota) params.append('tipo_mascota', tipoMascota);
            
            if (params.toString()) {
                url += '?' + params.toString();
            }
            
            const response = await fetch(url);
            const data = await response.json();
            
            return data.success ? data.productos : [];
        } catch (error) {
            console.error('Error obteniendo productos:', error);
            return [];
        }
    }

    // Obtener productos en oferta
    static async obtenerOfertas() {
        try {
            const response = await fetch(`${this.baseURL}/obtener_ofertas.php`);
            const data = await response.json();
            
            return data.success ? data.ofertas : [];
        } catch (error) {
            console.error('Error obteniendo ofertas:', error);
            return [];
        }
    }

    // Buscar productos
    static async buscarProductos(termino) {
        try {
            const response = await fetch(`${this.baseURL}/buscar_productos.php?q=${encodeURIComponent(termino)}`);
            const data = await response.json();
            
            return data.success ? data.productos : [];
        } catch (error) {
            console.error('Error buscando productos:', error);
            return [];
        }
    }
}

// Clase para manejar el catálogo de productos
class CatalogoManager {
    constructor() {
        this.productos = [];
        this.cargarListeners();
    }

    cargarListeners() {
        // Buscador
        const buscador = document.querySelector('.buscador');
        const btnBuscar = document.querySelector('.btn-buscar');
        
        if (buscador && btnBuscar) {
            const realizarBusqueda = () => {
                const termino = buscador.value.trim();
                if (termino) {
                    this.buscarProductos(termino);
                }
            };
            
            btnBuscar.addEventListener('click', realizarBusqueda);
            buscador.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    realizarBusqueda();
                }
            });
        }
    }

    async cargarProductosPorCategoria(categoria, contenedorId = 'productos-lista') {
        try {
            this.productos = await PetPlanetAPI.obtenerProductos(categoria);
            this.mostrarProductos(this.productos, contenedorId);
        } catch (error) {
            console.error('Error cargando productos:', error);
        }
    }

    async cargarOfertas() {
        try {
            const ofertas = await PetPlanetAPI.obtenerOfertas();
            this.mostrarProductos(ofertas, 'productos-lista');
        } catch (error) {
            console.error('Error cargando ofertas:', error);
        }
    }

    async buscarProductos(termino) {
        try {
            const resultados = await PetPlanetAPI.buscarProductos(termino);
            this.mostrarProductos(resultados, 'productos-lista');
            
            // Mostrar mensaje si no hay resultados
            const contenedor = document.getElementById('productos-lista');
            if (resultados.length === 0 && contenedor) {
                contenedor.innerHTML = `<p class="no-resultados">No se encontraron productos para "${termino}"</p>`;
            }
        } catch (error) {
            console.error('Error en búsqueda:', error);
        }
    }

    mostrarProductos(productos, contenedorId) {
        const contenedor = document.getElementById(contenedorId);
        if (!contenedor) return;

        if (productos.length === 0) {
            contenedor.innerHTML = '<p class="no-productos">No hay productos disponibles.</p>';
            return;
        }

        contenedor.innerHTML = productos.map(producto => this.crearTarjetaProducto(producto)).join('');
    }

    crearTarjetaProducto(producto) {
        const tieneOferta = producto.precio_original > producto.precio;
        const esOferta = tieneOferta ? `
            <div class="oferta-tag">¡OFERTA!</div>
            <p class="precio-original">${producto.precio_original}€</p>
            <p class="precio-oferta">${producto.precio}€</p>
        ` : `<p class="precio-normal">${producto.precio}€</p>`;

        return `
            <div class="producto" data-categoria="${producto.categoria}" data-mascota="${producto.tipo_mascota}">
                <img src="${producto.imagen}" alt="${producto.nombre}" onerror="this.src='placeholder.jpg'">
                ${tieneOferta ? '<div class="oferta-tag">¡OFERTA!</div>' : ''}
                <h2>${producto.nombre}</h2>
                <p class="descripcion">${producto.descripcion || ''}</p>
                ${esOferta}
                <p class="stock">Stock: ${producto.stock} unidades</p>
                <button class="btn-comprar" onclick="catalogo.agregarAlCarrito(${producto.id})">Comprar</button>
            </div>
        `;
    }

    agregarAlCarrito(productoId) {
        // Implementar lógica del carrito
        const producto = this.productos.find(p => p.id === productoId);
        if (producto) {
            alert(`✅ ${producto.nombre} agregado al carrito`);
            // Aquí puedes implementar la lógica del carrito de compras
        }
    }
}

// Instancia global del catálogo
const catalogo = new CatalogoManager();