document.addEventListener("DOMContentLoaded", () => {

  // 1) LOCALIZA EL BLOQUE DE FILTROS Y EL CONTENEDOR DONDE VAMOS A PINTAR TARJETAS
  const filtrosBox = document.querySelector("[data-filtros]");
  const lista = document.getElementById("mascotas-lista") || document.querySelector(".productos-lista");

  // Si no existen, no hacemos nada
  if (!filtrosBox || !lista) return;

  const controles = Array.from(filtrosBox.querySelectorAll("[data-filter]"));

  // 2) "BASE DE DATOS" EN MEMORIA (aquí guardaremos las mascotas del JSON)
  let mascotas = [];

  // 3) CARGAR EL JSON (esto sustituye a las tarjetas escritas a mano en el HTML)
  async function cargarMascotas() {
    try {
      const res = await fetch("json/adopciones.json");
      const data = await res.json();

      // En tu JSON, las mascotas están dentro de data.productos
      mascotas = Array.isArray(data.productos) ? data.productos : [];

      // Pintamos todo al principio (sin filtros)
      aplicarFiltros();
    } catch (error) {
      console.error("Error cargando adopciones.json:", error);
      lista.innerHTML = "<p>Error cargando las adopciones.</p>";
    }
  }

  // 4) PINTAR TARJETAS EN EL DOM
  function pintarTarjetas(arrayMascotas) {
    // Vacía el contenedor
    lista.innerHTML = "";

    // Si no hay resultados, mostramos un mensaje
    if (arrayMascotas.length === 0) {
      lista.innerHTML = "<p>No hay resultados con esos filtros.</p>";
      return;
    }

    arrayMascotas.forEach(m => {
      const card = document.createElement("div");
      card.classList.add("producto");

      // Estos data-* los usamos para filtros y para el modal
      card.dataset.id = m.id || "";
      card.dataset.nombre = m.nombre || "";
      card.dataset.descripcion = m.descripcion || "";
      card.dataset.tipo = m.tipo || "";
      card.dataset.edad = m.edad || "";
      card.dataset.imagen = m.imagen || "";

      
      card.innerHTML = `
        <img src="${m.imagen}" alt="${m.nombre}">
        <h3>${m.nombre}</h3>
        <p>${m.descripcion || ""}</p>
        <button class="btn-reservar-tarjeta">Reservar</button>
      `;

      lista.appendChild(card);
    });
  }

  // 5) APLICAR FILTROS (ahora filtramos el ARRAY y luego pintamos)
  function aplicarFiltros() {
    let tipo = "todos";
    let edad = "todas";

    controles.forEach(control => {
      if (control.dataset.filter === "tipo") tipo = control.value;
      if (control.dataset.filter === "edad") edad = control.value;
    });

    const filtradas = mascotas.filter(m => {
      let visible = true;

      // filtro tipo
      if (tipo !== "todos" && m.tipo !== tipo) visible = false;

      // filtro edad
      if (edad !== "todas" && m.edad !== edad) visible = false;

      return visible;
    });

    pintarTarjetas(filtradas);
  }

  // 6) EVENTOS DE LOS FILTROS (cuando cambias un select, se vuelve a filtrar)
  controles.forEach(control => {
    const evento = control.tagName === "INPUT" ? "input" : "change";
    control.addEventListener(evento, aplicarFiltros);
  });

  // 7) Arrancamos cargando el JSON
  cargarMascotas();
});