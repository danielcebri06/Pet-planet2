document.addEventListener("DOMContentLoaded", () => {
  const boxVacio = document.getElementById("reservas-vacio");
  const contenedor = document.getElementById("reservas-contenedor");
  const btnVaciar = document.getElementById("btnVaciarReservas");

  if (!contenedor || !boxVacio) return;

  function pintarReservas() {
    const reservas = getReservas(); // viene de reservas.js
    contenedor.innerHTML = "";

    if (reservas.length === 0) {
      boxVacio.style.display = "block";
      contenedor.style.display = "none";
      if (btnVaciar) btnVaciar.style.display = "none";
      return;
    }

    boxVacio.style.display = "none";
    contenedor.style.display = "grid";
    if (btnVaciar) btnVaciar.style.display = "inline-block";

    reservas.forEach(r => {
      const card = document.createElement("div");
      card.className = "producto";

      const fechaBonita = r.fechaReserva
        ? new Date(r.fechaReserva).toLocaleString()
        : "—";

      card.innerHTML = `
        <img src="${r.imagen}" alt="${r.nombre}">
        <h3>${r.nombre}</h3>
        <p><strong>Tipo:</strong> ${r.tipo}</p>
        <p><strong>Edad:</strong> ${r.edad}</p>
        <p><strong>Creada:</strong> ${fechaBonita}</p>

        <button class="btn-peligro btn-eliminar-reserva" data-id="${r.id}">
            Eliminar reserva
        </button>
        
        <a href="reservaFormulario.php?id=${r.id}">
            Completar datos
        </a>
      `;

      contenedor.appendChild(card);
    });
  }

  // Delegación: escuchar clicks en botones de eliminar
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-eliminar-reserva");
    if (!btn) return;

    const id = btn.dataset.id;
    removeReserva(id);   // viene de reservas.js
    pintarReservas();      // repintamos
  });

  // Vaciar todo
  btnVaciar?.addEventListener("click", () => {
    if (confirm("¿Seguro que quieres vaciar todas las reservas?")) {
      clearReservas();    // viene de reservas.js
      pintarReservas();
    }
  });

  pintarReservas();
});