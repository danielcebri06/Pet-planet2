document.addEventListener("DOMContentLoaded", () => {
  const calendarEl = document.getElementById("calendarAdopciones");
  if (!calendarEl) return;

  // Spinner opcional (si no existe, no pasa nada)
  function mostrarSpinner(mostrar) {
    const sp = document.getElementById("spinnerGlobal");
    if (!sp) return;
    sp.hidden = !mostrar;
  }

  // 1) PROMESA: pedir reservas reales (petplanet_reservas) usando getReservas()
  function pedirReservas() {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        try {
          if (typeof getReservas !== "function") {
            throw new Error("getReservas() no existe. Asegúrate de cargar reservas.js antes.");
          }
          resolve(getReservas());
        } catch (e) {
          reject(e);
        }
      }, 200);
    });
  }

  // 2) Convertir reservas con cita a eventos de FullCalendar
  function reservasAEventos(reservas) {
    return reservas
      .filter(r => r.cita && r.cita.start) // solo las que tienen cita
      .map(r => ({
        id: r.id, // usamos el id de la reserva/mascota
        title: `${(r.cita.tipo || "reserva").toUpperCase()} - ${r.nombre || ""}`,
        start: r.cita.start,
        end: r.cita.end || null
      }));
  }

  // 3) ASYNC + FINALLY: iniciar calendario
  async function iniciarCalendario() {
    mostrarSpinner(true);

    try {
      const reservas = await pedirReservas();
      const eventos = reservasAEventos(reservas);

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        locale: "es",
        nowIndicator: true,
        selectable: false, // la cita se crea en el formulario, no aquí
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay"
        },
        events: eventos,

        // ✅ Borrar cita (y por tanto el evento) con click
        eventClick: (clickInfo) => {
          const ok = confirm(`¿Eliminar la cita?\n\n${clickInfo.event.title}`);
          if (!ok) return;

          const id = clickInfo.event.id;

          const nuevas = getReservas().map(r => {
            if (r.id !== id) return r;

            const copia = { ...r };
            delete copia.cita;
            copia.estado = "pendiente";
            return copia;
          });

          saveReservas(nuevas);
          clickInfo.event.remove();
        }
      });

      calendar.render();
    } catch (e) {
      console.error("Error cargando calendario de Adopciones:", e);
    } finally {
      mostrarSpinner(false);
    }
  }

  iniciarCalendario();
});