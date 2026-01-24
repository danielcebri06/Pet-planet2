document.addEventListener("DOMContentLoaded", () => {

  // EXTRA) Banner de donación: se muestra al entrar y se oculta con setTimeout
  function mostrarBannerDonacion(duracionMs = 5000) {
    const banner = document.getElementById("bannerDonacion");
    if (!banner) return;

    // Mostrar al entrar
    banner.hidden = false;

    // Ocultar tras X ms
    setTimeout(() => {
      banner.hidden = true;
    }, duracionMs);
  }

  mostrarBannerDonacion(5000);

  // 1) LOCALIZA EL BLOQUE DE FILTROS Y EL CONTENEDOR DONDE VAMOS A PINTAR TARJETAS
  const filtrosBox = document.querySelector("[data-filtros]");
  const lista = document.getElementById("mascotas-lista") || document.querySelector(".productos-lista");

  // Si no existen, no hacemos nada
  if (!filtrosBox || !lista) return;

  const controles = Array.from(filtrosBox.querySelectorAll("[data-filter]"));

  // 2) "BASE DE DATOS" EN MEMORIA (aquí guardaremos las mascotas del JSON)
  let mascotas = [];

  // 3) CARGAR EL JSON (esto sustituye a las tarjetas escritas a mano en el HTML)
  function pedirMascotas() {
    return new Promise((resolve, reject) => {
    fetch("json/adopciones.json")
      .then(res => {
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        return res.json();
      })
      .then(data => {
        const arrayMascotas = Array.isArray(data.productos) ? data.productos : [];
        resolve(arrayMascotas); // éxito -> entrego el array
      })
      .catch(err => {
        reject(err); // fallo -> paso el error
      });
    });
  }


  async function cargarMascotas() {
    // (opcional) mostrar spinner global si existe
    const spinner = document.getElementById("spinnerGlobal");
    if (spinner) spinner.hidden = false;

    try {
      mascotas = await pedirMascotas(); // aquí está el “luego async”
      aplicarFiltros();                 // pintamos al inicio (sin filtros)
    } catch (error) {
      console.error("Error cargando adopciones.json:", error);
      lista.innerHTML = "<p>Error cargando las adopciones.</p>";
    } finally {
      // SIEMPRE se ejecuta: éxito o error
      if (spinner) spinner.hidden = true;  //apaga el spinner siempre
    }
  }

  // 4) PINTAR TARJETAS EN EL DOM
  function pintarTarjetas(arrayMascotas) {
    // Vacía el contenedor
    lista.innerHTML = "";

    // 1) Dejo fuera las mascotas ya reservadas (si existe isReservada)
    const visibles = (typeof isReservada === "function")
      ? arrayMascotas.filter(m => !isReservada(m.id))
      : arrayMascotas;

    // 2) El mensaje de “no hay resultados” debe depender de lo que REALMENTE se va a pintar
    if (visibles.length === 0) {
      lista.innerHTML = "<p>No hay resultados con esos filtros.</p>";
      return;
    }

    // 3) Pintamos las tarjetas visibles
    visibles.forEach(m => {
      const card = document.createElement("div");
      card.classList.add("producto");

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
        <button class="btn-comprar btn-reservar-tarjeta">Reservar</button>
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