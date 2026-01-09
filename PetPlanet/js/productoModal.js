document.addEventListener("DOMContentLoaded", () => {
  const productos = document.querySelectorAll(".producto");
  const modal = document.getElementById("modalProducto");
  const cerrarBtn = document.querySelector(".cerrar");

  const modalNombre = document.getElementById("modalNombre");
  const modalDescripcion = document.getElementById("modalDescripcion");
  const modalPrecio = document.getElementById("modalPrecio");
  const modalImagen = document.getElementById("modalImagen");

  const listaComentarios = document.getElementById("listaComentarios");
  const comentarioTexto = document.getElementById("comentarioTexto");
  const btnEnviarComentario = document.getElementById("btnEnviarComentario");

  // Cargar comentarios guardados desde localStorage
  let comentariosPorProducto = JSON.parse(localStorage.getItem("comentariosPorProducto")) || {};

  let productoActualModal = {};

  productos.forEach((producto) => {
    producto.addEventListener("click", () => {
      const nombre = producto.dataset.nombre;
      const precio = producto.dataset.precio;
      const imagen = producto.dataset.imagen;
      const descripcion = producto.dataset.descripcion;

      // Guardar datos del producto actual en el modal
      productoActualModal = { nombre, precio, imagen, descripcion };

      modalNombre.textContent = nombre;
      modalDescripcion.textContent = producto.dataset.descripcion;
      modalPrecio.textContent = "Precio: " + producto.dataset.precio;
      
      modalImagen.src = "imagenes/" + producto.dataset.imagen;
      modalDescripcion.textContent = descripcion;
      modalPrecio.textContent = "Precio: " + precio;
      modalImagen.src = "imagenes/" + imagen;

      mostrarComentarios(nombre);
      modal.style.display = "block";
    });
  });

  // Botón "Añadir a la cesta"
  const btnCesta = document.querySelector(".btn-cesta");
  if (btnCesta) {
    btnCesta.addEventListener("click", () => {
      if (Object.keys(productoActualModal).length > 0) {
        agregarAlCarrito(
          productoActualModal.nombre,
          productoActualModal.precio,
          productoActualModal.imagen,
          productoActualModal.descripcion
        );
        modal.style.display = "none";
      }
    });
  }

  cerrarBtn.addEventListener("click", () => {
    modal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target == modal) {
      modal.style.display = "none";
    }
  });

  // Mostrar comentarios del producto actual
  function mostrarComentarios(nombreProducto) {
    listaComentarios.innerHTML = "";

    const comentarios = comentariosPorProducto[nombreProducto] || [];
    if (comentarios.length === 0) {
      listaComentarios.innerHTML = `<p class="sin-comentarios">Aún no hay comentarios. ¡Sé el primero en opinar!</p>`;
    } else {
      comentarios.forEach((texto) => {
        const div = document.createElement("div");
        div.classList.add("comentario");
        div.textContent = texto;
        listaComentarios.appendChild(div);
      });
    }

    // Guardar nombre del producto activo
    listaComentarios.dataset.productoActivo = nombreProducto;
  }

  // Enviar nuevo comentario
  btnEnviarComentario.addEventListener("click", () => {
    const texto = comentarioTexto.value.trim();
    const productoActivo = listaComentarios.dataset.productoActivo;

    if (texto === "") return alert("Por favor, escribe un comentario antes de enviarlo.");

    if (!comentariosPorProducto[productoActivo]) {
      comentariosPorProducto[productoActivo] = [];
    }

    comentariosPorProducto[productoActivo].push(texto);
    comentarioTexto.value = "";
    guardarEnLocalStorage();
    mostrarComentarios(productoActivo);
  });

  // Guardar los comentarios en localStorage
  function guardarEnLocalStorage() {
    localStorage.setItem("comentariosPorProducto", JSON.stringify(comentariosPorProducto));
  }
});