document.addEventListener("DOMContentLoaded", () => {
  // Referencias fijas (el contenedor del modal no cambia)
  const modal = document.getElementById("modalProducto");
  const cerrarBtn = document.querySelector(".cerrar");

  // Referencias a los campos de texto
  const modalNombre = document.getElementById("modalNombre");
  const modalDescripcion = document.getElementById("modalDescripcion");
  const modalPrecio = document.getElementById("modalPrecio");
  const modalImagen = document.getElementById("modalImagen");

  // Referencias a comentarios
  const listaComentarios = document.getElementById("listaComentarios");
  const comentarioTexto = document.getElementById("comentarioTexto");
  const btnEnviarComentario = document.getElementById("btnEnviarComentario");

  // Cargar comentarios
  let comentariosPorProducto = JSON.parse(localStorage.getItem("comentariosPorProducto")) || {};

  if (!modal) return;

  // ---------------------------------------------------------------------------
  // 1. FUNCIÓN GLOBAL (Se llama cada vez que haces clic en un producto)
  // ---------------------------------------------------------------------------
  window.abrirModalProducto = function(nombre, precio, imagen, descripcion) {
    // A. Rellenar datos visuales
    modalNombre.textContent = nombre;
    modalDescripcion.textContent = descripcion;
    modalPrecio.textContent = parseFloat(precio).toFixed(2) + "€";
    modalImagen.src = "imagenes/" + imagen;

    // B. Cargar comentarios
    mostrarComentarios(nombre);

    // C. Configurar el botón "Añadir a la cesta"
    // --- CORRECCIÓN AQUÍ ---
    // 1. Buscamos el botón que existe AHORA MISMO en el DOM
    const btnCestaActual = modal.querySelector(".btn-cesta");

    if (btnCestaActual) {
        // 2. Lo clonamos para limpiar los eventos del producto anterior
        const nuevoBtn = btnCestaActual.cloneNode(true);
        
        // 3. Reemplazamos el botón actual por el clon limpio
        btnCestaActual.parentNode.replaceChild(nuevoBtn, btnCestaActual);

        // 4. Le damos la función de añadir este producto específico
        nuevoBtn.addEventListener("click", () => {
            agregarAlCarrito(nombre, precio, imagen, descripcion);
            modal.style.display = "none";
        });
    }

    // D. Mostrar el modal
    modal.style.display = "block";
  };

  // ---------------------------------------------------------------------------
  // 2. Lógica de Comentarios
  // ---------------------------------------------------------------------------
  function mostrarComentarios(nombreProducto) {
    listaComentarios.innerHTML = "";
    listaComentarios.dataset.productoActivo = nombreProducto;

    const comentarios = comentariosPorProducto[nombreProducto] || [];
    
    if (comentarios.length === 0) {
      listaComentarios.innerHTML = `<p class="sin-comentarios" style="color:#777;">Aún no hay comentarios.</p>`;
    } else {
      comentarios.forEach((texto) => {
        const div = document.createElement("div");
        div.classList.add("comentario");
        div.textContent = "👤 " + texto;
        div.style.marginBottom = "5px";
        div.style.borderBottom = "1px solid #eee";
        listaComentarios.appendChild(div);
      });
    }
  }

  if (btnEnviarComentario) {
    btnEnviarComentario.addEventListener("click", () => {
      const texto = comentarioTexto.value.trim();
      const productoActivo = listaComentarios.dataset.productoActivo;

      if (!productoActivo) return;
      if (texto === "") return alert("Escribe un comentario.");

      if (!comentariosPorProducto[productoActivo]) {
        comentariosPorProducto[productoActivo] = [];
      }

      comentariosPorProducto[productoActivo].push(texto);
      comentarioTexto.value = "";
      
      guardarEnLocalStorage();
      mostrarComentarios(productoActivo);
    });
  }

  function guardarEnLocalStorage() {
    localStorage.setItem("comentariosPorProducto", JSON.stringify(comentariosPorProducto));
  }

  // ---------------------------------------------------------------------------
  // 3. Cerrar Modal
  // ---------------------------------------------------------------------------
  if (cerrarBtn) {
    cerrarBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  }

  window.addEventListener("click", (e) => {
    if (e.target == modal) {
      modal.style.display = "none";
    }
  });
});