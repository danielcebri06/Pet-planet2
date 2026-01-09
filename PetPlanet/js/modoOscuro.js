document.addEventListener("DOMContentLoaded", () => {
  const menuBtn = document.getElementById("hamburguesa-btn");
  const menu = document.getElementById("menuDesplegable");
  const darkSwitch = document.getElementById("darkModeSwitch");
  const estadoTexto = document.getElementById("estadoModoOscuro");

  // --- Menú hamburguesa con animación ---
  if (menuBtn && menu) {
    menuBtn.addEventListener("click", () => {
      menu.classList.toggle("mostrar");
      menuBtn.classList.toggle("rotar"); // 🔹 añade animación de rotación
    });

    document.addEventListener("click", (event) => {
      if (!menu.contains(event.target) && !menuBtn.contains(event.target)) {
        menu.classList.remove("mostrar");
        menuBtn.classList.remove("rotar"); // 🔹 quita animación al cerrar
      }
    });
  }

  // --- Inicializar modo oscuro ---
  if (localStorage.getItem("modoOscuro") === "true") {
    document.body.classList.add("modo-oscuro");
    if (darkSwitch) darkSwitch.checked = true;
    if (estadoTexto) estadoTexto.textContent = "Modo oscuro activado";
  }

  // --- Activar/desactivar modo oscuro ---
  if (darkSwitch) {
    darkSwitch.addEventListener("change", () => {
      const activado = darkSwitch.checked;
      document.body.classList.toggle("modo-oscuro", activado);
      localStorage.setItem("modoOscuro", activado);
      if (estadoTexto)
        estadoTexto.textContent = activado
          ? "Modo oscuro activado"
          : "Modo oscuro desactivado";
    });
  }
});
