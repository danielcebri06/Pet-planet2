<?php
session_start();
?>
<!--hola-->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adopciones - PET PLANET</title>
  <link rel="stylesheet" href="proyecto.css">
  <link rel="stylesheet" href="ali-sal-accyjcss.css">    
  <link rel="stylesheet" href="modal.css"> 
  <link rel="stylesheet" href="filtro.css">   
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
</head>
<body>
  <header>
    <div class="principal">
      <div class="buscador-contenedor">
        <input type="text" placeholder="Buscar..." class="buscador">
        <button class="btn-buscar">Buscar</button>
      </div>
      <div class="cabecera-logo">
        <a href="index.php"><img src="imagenes/logoPetPlanet.jpg" alt="Logo" class="logo"></a>
      </div>
      <nav class="menu">
        <a href="Accesorios.php">Accesorios</a>   
        <a href="alimentacion.php">Alimentación</a>
        <a href="SaludEHigiene.php">Salud e higiene</a>        
        <a class="claseseleccionada" href="Adopciones.php">Adopta a una Mascota</a> 
        <a href="https://search.brave.com/search?q=kiwoko&view=full&map_src=c&bbox=-3.710%2C40.381%2C-3.480%2C40.551" target="_blank">Nuestras Tiendas</a>
      </nav>
      <div class="menu-hamburguesa">
        <button class="hamburguesa-btn" id="hamburguesa-btn">☰</button>
        <div class="menu-desplegable" id="menuDesplegable">
          <a href="#">Ajustes de la cuenta</a>
          <?php if (isset($_SESSION['usuario'])): ?>
              <div class="menu-link" style="font-weight: bold; color: #2c3e50;">👤 <?= htmlspecialchars($_SESSION['usuario']) ?></div>
              <a href="logout.php" class="menu-link" style="color: #d9534f;">❌ Cerrar sesión</a>
          <?php else: ?>
              <a href="login.html" class="menu-link login-link">🔑 Iniciar sesión</a>
          <?php endif; ?>
          <a href="carrito.php" class="menu-link carrito-link">🛒 Mi Carrito</a>
          <a href="misReservas.php" class="menu-link">📅 Mis reservas</a>
          <div class="modo-oscuro-switch">
            <label class="switch"><input type="checkbox" id="darkModeSwitch"><span class="slider"></span></label>
            <span id="estadoModoOscuro">Modo oscuro desactivado</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="miga-de-pan">
        <img src="imagenes/Casita.png" alt="Casita" class="casita">
        <a href="index.php">Inicio</a>
        <a>></a>
        <a class="panselec" href="Adopciones.php">Adopta a una Mascota</a>
  </div>

  <section class="productos">
        <h1>Adopciones de Mascotas</h1>
        <p>Descubre a nuestros amigos necesitados de una familia.</p>

        <!-- Banner donación (se muestra al entrar y se oculta con setTimeout) -->
        <div id="bannerDonacion" class="banner-donacion" hidden>
            🐾 DONA COMIDA O UTENSILIOS PARA LAS MASCOTAS PENDIENTES DE ADOPCIÓN
        </div>

        <!-- Filtros (DOM) -->
        <div class="filtros filtros-adopcion" data-filtros>
                
            <select class="filtro-select" data-filter="tipo">
                <option value="todos">Todos los animales</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="pajaro">Pájaro</option>
            </select>

            <select class="filtro-select" data-filter="edad">
                <option value="todas">Todas las edades</option>
                <option value="cachorro">Cachorro / Joven</option>
                <option value="adulto">Adulto</option>
                <option value="anciano">Anciano</option>
            </select>
        </div>

        <!-- TARJETAS DE LAS MASCOTAS - lo rellena el JS leyendo adopciones.json-->
        <div class="productos-lista" id="mascotas-lista"></div>

        <!-- Calendario FullCalendar (Reservas) -->
        <h2 class="titulo-calendario">Reservas</h2>
        <p class="texto-calendario">
           Aquí verás las citas confirmadas. Haz clic en una cita para eliminarla.
        </p>

  <div id="calendarAdopciones" class="calendar-adopciones"></div>

    </section>

    <div id="modalMascota" class="modal">
            <div class="modal-contenido">
                <span class="cerrar">&times;</span>
                <img id="modalImagen" src="" alt="" class="modal-img">
                <h2 id="modalNombre"></h2>
                <p id="modalDescripcion"></p>
                <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
                <p><strong>Edad:</strong> <span id="modalEdad"></span></p>
                <button class="btn-comprar btn-reservado" id="btnReservar">Reservar adopción</button>
            </div>
    </div>
 
    <footer>
        <div class="copyright">
        &copy; 2025 PET PLANET.
        </div>
        <div class="legales">
            <a href="#">Aviso Legal</a> | <a href="#">Política de Privacidad</a> | <a href="#">Política de Cookies</a>
        </div>
    </footer>

  <script src="js/modoOscuro.js"></script>
  

  <script src="js/database.js"></script>
  <script src="js/listarProductos.js"></script>
  <script src="js/datos.js"></script>
  <script src="js/buscador.js"></script>
  
  <script src="js/adopciones.js"></script>
  <script src="js/reservas.js"></script>
  <script src="js/adopcionModal.js"></script>

  <!-- FullCalendar JS (CDN) -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

  <!-- Integración del calendario -->
  <script src="js/adopcionesCalendar.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
  <script src="js/confeti.js"></script>
  

  

</body>
</html>