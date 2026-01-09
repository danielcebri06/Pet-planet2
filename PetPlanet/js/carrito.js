//camabiar todo 
document.addEventListener('DOMContentLoaded', function() {
  const listaCarrito = document.getElementById('listaCarrito');
  const carritoVacio = document.getElementById('carritoVacio');
  const carritoLleno = document.getElementById('carritoLleno');
  const btnFinalizarCompra = document.getElementById('btnFinalizarCompra');

  // Cargar carrito desde localStorage
  function cargarCarrito() {
    const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    return carrito;
  }

  // Guardar carrito en localStorage
  function guardarCarrito(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarUI();
  }

  // Actualizar interfaz
  function actualizarUI() {
    const carrito = cargarCarrito();

    if (carrito.length === 0) {
      carritoVacio.style.display = 'block';
      carritoLleno.style.display = 'none';
      return;
    }

    carritoVacio.style.display = 'none';
    carritoLleno.style.display = 'block';

    listaCarrito.innerHTML = '';
    let subtotal = 0;

    carrito.forEach((producto, index) => {
      const precio = parseFloat(producto.precio);
      const cantidad = parseInt(producto.cantidad);
      const subtotalProducto = precio * cantidad;
      subtotal += subtotalProducto;

      const fila = `
        <tr>
          <td><img src="imagenes/${producto.imagen}" alt="${producto.nombre}"></td>
          <td>${producto.nombre}</td>
          <td>${precio.toFixed(2)}€</td>
          <td>
            <input type="number" min="1" value="${cantidad}" class="cantidad-input" 
                   data-index="${index}" onchange="actualizarCantidad(${index}, this.value)">
          </td>
          <td>${subtotalProducto.toFixed(2)}€</td>
          <td>
            <button class="btn-eliminar" onclick="eliminarProducto(${index})">Eliminar</button>
          </td>
        </tr>
      `;
      listaCarrito.innerHTML += fila;
    });

    const impuestos = subtotal * 0.21;
    const total = subtotal + impuestos;

    document.getElementById('subtotal').textContent = subtotal.toFixed(2) + '€';
    document.getElementById('impuestos').textContent = impuestos.toFixed(2) + '€';
    document.getElementById('total').textContent = total.toFixed(2) + '€';
  }

  // Actualizar cantidad de un producto
  window.actualizarCantidad = function(index, nuevaCantidad) {
    const carrito = cargarCarrito();
    const cantidad = parseInt(nuevaCantidad);

    if (cantidad <= 0) {
      eliminarProducto(index);
      return;
    }

    carrito[index].cantidad = cantidad;
    guardarCarrito(carrito);
  };

  // Eliminar producto del carrito
  window.eliminarProducto = function(index) {
    const carrito = cargarCarrito();
    carrito.splice(index, 1);
    guardarCarrito(carrito);
  };

  // Finalizar compra
  btnFinalizarCompra.addEventListener('click', function() {
    const carrito = cargarCarrito();

    if (carrito.length === 0) {
      alert('El carrito está vacío');
      return;
    }

    // Enviar carrito a la base de datos
    fetch('php/guardar_carrito.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ productos: carrito })
    })
    .then(response => response.json())
    .then(datos => {
      if (datos.exito) {
        alert('Pedido realizado con éxito. Número de pedido: ' + datos.pedido_id);
        localStorage.removeItem('carrito');
        actualizarUI();
        // Redirigir a página de confirmación o inicio
        setTimeout(() => {
          window.location.href = 'index.html';
        }, 1500);
      } else {
        alert('Error al procesar el pedido: ' + datos.error);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('Error al procesar el pedido');
    });
  });

  // Cargar carrito al iniciar
  actualizarUI();
});

// Función para agregar producto al carrito desde la página de productos
function agregarAlCarrito(nombre, precio, imagen, descripcion) {
  const carrito = JSON.parse(localStorage.getItem('carrito')) || [];

  // Verificar si el producto ya existe en el carrito
  const productoExistente = carrito.find(p => p.nombre === nombre);

  if (productoExistente) {
    productoExistente.cantidad++;
  } else {
    carrito.push({
      nombre: nombre,
      precio: precio.toString().replace('€', ''),
      imagen: imagen,
      descripcion: descripcion,
      cantidad: 1
    });
  }

  localStorage.setItem('carrito', JSON.stringify(carrito));
  alert('Producto añadido al carrito');
}
