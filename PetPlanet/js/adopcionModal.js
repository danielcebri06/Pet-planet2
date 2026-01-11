document.addEventListener("DOMContentLoaded", () => {
  
    // 1) Referencias al modal
  const modal = document.getElementById("modalMascota");
  if (!modal) return;

  const btnCerrar = modal.querySelector(".cerrar");

  // 2) Referencias a los elementos internos del modal
  const modalImagen = document.getElementById("modalImagen");
  const modalNombre = document.getElementById("modalNombre");
  const modalDescripcion = document.getElementById("modalDescripcion");
  const modalTipo = document.getElementById("modalTipo");
  const modalEdad = document.getElementById("modalEdad");

  // 3) Botón reservar (presentación)
  const btnReservar = document.getElementById("btnReservar");

  let mascotaActual = null;

  // 4) Abrir modal al hacer click en la imagen de una tarjeta
  document.addEventListener("click", (e) => {
    const img = e.target.closest(".producto img");
    if (!img) return;

    const card = img.closest(".producto");
    if (!card) return;

    // Guardamos la mascota seleccionada (leemos data-* del HTML)
    mascotaActual = {
      nombre: card.dataset.nombre || "",
      descripcion: card.dataset.descripcion || "",
      tipo: card.dataset.tipo || "",
      edad: card.dataset.edad || "",
      imagen: card.dataset.imagen || img.getAttribute("src") || ""
    };

    // Rellenar el modal
    if (modalImagen) {
      modalImagen.src = mascotaActual.imagen;
      modalImagen.alt = mascotaActual.nombre;
    }
    if (modalNombre) modalNombre.textContent = mascotaActual.nombre;
    if (modalDescripcion) modalDescripcion.textContent = mascotaActual.descripcion;
    if (modalTipo) modalTipo.textContent = mascotaActual.tipo;
    if (modalEdad) modalEdad.textContent = mascotaActual.edad;

    // Mostrar modal
    modal.style.display = "block";
  });

  // 5) Cerrar modal con la X
  if (btnCerrar) {
    btnCerrar.addEventListener("click", () => {
        modal.style.display = "none";
    });
  }

  // 6) Cerrar modal al pinchar fuera del contenido
  window.addEventListener("click", (e) => {
    if (e.target === modal) modal.style.display = "none";
  });

  // 7) Botón reservar (por ahora: solo placeholder)
  btnReservar?.addEventListener("click", () => {
    // Aquí en el futuro llamarás a tu sistema de reservas
    alert("Reserva pendiente de implementar ✅");
    modal.style.display = "none";
  });
});