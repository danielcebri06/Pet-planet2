<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mis Reservas - PET PLANET</title>
  <link rel="stylesheet" href="proyecto.css">
  <link rel="stylesheet" href="ali-sal-accyjcss.css">    
  <link rel="stylesheet" href="modal.css"> 
  <link rel="stylesheet" href="filtro.css">
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
          <div class="modo-oscuro-switch">
            <label class="switch"><input type="checkbox" id="darkModeSwitch"><span class="slider"></span></label>
            <span id="estadoModoOscuro">Modo oscuro desactivado</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="miga-de-pan">
    <a href="index.php">Inicio</a> <a>></a>
    <a href="misReservas.php">Mis reservas</a>
  </div>

  <main class="productos">
    <h1>Mis reservas</h1>
    <p>Aquí verás las mascotas que has reservado.</p>

    <div id="reservas-vacio" style="display:none;">
        <p>No tienes reservas todavía.</p>
        <a href="Adopciones.php">Ir a adopciones</a>
    </div>

    <div id="reservas-contenedor" class="productos-lista"></div>

    <div style="margin-top: 16px;">
        <button id="btnVaciarReservas" class="btn-peligro">Vaciar reservas</button>
    </div>
  </main>

    <footer>
        <div class="copyright">
        &copy; 2025 PET PLANET.
        </div>
        <div class="legales">
            <a href="#">Aviso Legal</a> | <a href="#">Política de Privacidad</a> | <a href="#">Política de Cookies</a>
        </div>
    </footer>

    <script src="js/reservas.js"></script>
    <script src="js/misReservas.js"></script>
</body>
</html>

