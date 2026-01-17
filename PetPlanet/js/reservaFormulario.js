document.addEventListener("DOMContentLoaded", () => {
  const info = document.getElementById("infoReserva");
  const form = document.getElementById("formReserva");

  const nombre = document.getElementById("nombre");
  const email = document.getElementById("email");
  const telefono = document.getElementById("telefono");
  const dni = document.getElementById("dni");
  const btnGuardar = document.getElementById("btnGuardar");

  const errNombre = document.getElementById("errNombre");
  const errEmail = document.getElementById("errEmail");
  const errTelefono = document.getElementById("errTelefono");
  const errDni = document.getElementById("errDni");

  // 1) Saber qué reserva vamos a editar (por URL: ?id=m001)
  const params = new URLSearchParams(window.location.search);
  const id = params.get("id");

  if (!id) {
    info.textContent = "Error: falta el id de la reserva.";
    form.style.display = "none";
    return;
  }

  // 2) Buscar reserva
  const reservas = getReservas();
  const reserva = reservas.find(r => r.id === id);

  if (!reserva) {
    info.textContent = "Error: no existe esa reserva.";
    form.style.display = "none";
    return;
  }

  // 3) Mostrar info de la mascota
  info.innerHTML = `
    <div class="producto producto-reserva">
      <img src="${reserva.imagen}" alt="${reserva.nombre}">
      <h3>${reserva.nombre}</h3>
      <p><strong>Tipo:</strong> ${reserva.tipo} · <strong>Edad:</strong> ${reserva.edad}</p>
    </div>
  `;

  // 4) Si ya hay datos guardados, rellenar inputs
  if (reserva.usuario) {
    nombre.value = reserva.usuario.nombre || "";
    email.value = reserva.usuario.email || "";
    telefono.value = reserva.usuario.telefono || "";
    dni.value = reserva.usuario.dni || "";
  }

  // -------------------------
  // VALIDACIÓN EN TIEMPO REAL
  // -------------------------
  function validarNombre() {
    const v = nombre.value.trim();
    if (v.length < 3) {
      errNombre.textContent = "Mínimo 3 caracteres.";
      return false;
    }
    errNombre.textContent = "";
    return true;
  }

  function validarEmail() {
    const v = email.value.trim();
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
    if (!ok) {
      errEmail.textContent = "Introduce un email válido.";
      return false;
    }
    errEmail.textContent = "";
    return true;
  }

  function validarTelefono() {
    const v = telefono.value.trim();
    const soloDigitos = v.replace(/\s+/g, "");
    const ok = /^[0-9]{9}$/.test(soloDigitos); 
    if (!ok) {
      errTelefono.textContent = "Teléfono inválido (9 números).";
      return false;
    }
    errTelefono.textContent = "";
    return true;
  }

  function validarDni() {
    const v = dni.value.trim();
    if (v === "") { errDni.textContent = ""; return true; }
    const ok = /^[0-9A-Za-z]{6,12}$/.test(v);
    if (!ok) {
      errDni.textContent = "DNI/NIE inválido.";
      return false;
    }
    errDni.textContent = "";
    return true;
  }

  function validarTodo() {
    const ok =
      validarNombre() &
      validarEmail() &
      validarTelefono() &
      validarDni();

    btnGuardar.disabled = !ok;
    return !!ok;
  }

  // eventos en tiempo real
  [nombre, email, telefono, dni].forEach(inp => {
    inp.addEventListener("input", validarTodo);
  });

  validarTodo();

  // 5) Guardar al enviar
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!validarTodo()) return;

    const usuario = {
      nombre: nombre.value.trim(),
      email: email.value.trim(),
      telefono: telefono.value.trim(),
      dni: dni.value.trim()
    };

    // actualizar reserva en el array
    const nuevas = reservas.map(r => {
      if (r.id !== id) return r;
      return { ...r, usuario };
    });

    saveReservas(nuevas);

    alert("✅ Datos guardados");
    window.location.href = "misReservas.php";
  });
});