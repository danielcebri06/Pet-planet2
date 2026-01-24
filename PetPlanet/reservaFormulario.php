<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario de reserva - PET PLANET</title>
  <link rel="stylesheet" href="proyecto.css">
  <link rel="stylesheet" href="ali-sal-accyjcss.css">
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
    <main class="productos">
        <h1>Formulario de reserva</h1>
        <p>Completa tus datos para confirmar la reserva.</p>

        <div id="infoReserva" style="margin: 12px 0;"></div>

        <form id="formReserva" novalidate>  <!-- NOVALIDATE: es para la validación en tiempo real --> 
            <label>
                Nombre y apellidos
                <input type="text" id="nombre" required minlength="3" />
                <small id="errNombre"></small>
            </label>

            <label>
                Email
                <input type="email" id="email" required />
                <small id="errEmail"></small>
            </label>

            <label>
                Teléfono
                <input type="tel" id="telefono" required />
                <small id="errTelefono"></small>
            </label>

            <label>
                DNI/NIE 
                <input type="text" id="dni" required/>
                <small id="errDni"></small>
            </label>

            <hr style="margin:16px 0;">
            <h2 style="margin: 0 0 10px;">Cita de la reserva</h2>

            <label>
                Tipo de reserva
                <select id="tipoReserva" required>
                    <option value="">Selecciona...</option>
                    <option value="visita">Visita</option>
                    <option value="recogida">Recogida</option>
                </select>
                <small id="errTipo"></small>
            </label>

            <label>
                Fecha y hora de la cita
                <input type="datetime-local" id="fechaHora" required />
                <small id="errFechaHora"></small>
            </label>

            <div id="pasoCalendario" style="margin-top:12px;" hidden>
                <p style="margin: 6px 0 10px;">
                    Podrás ver la reserva confirmada en el calendario de adopciones.
                </p>
                <div id="calendarFormulario"></div>
            </div>

            <div style="margin-top: 14px;">
                <button id="btnGuardar" class="btn-comprar" type="submit" disabled>Guardar datos</button>
                <a href="misReservas.php">Volver</a>
            </div>
        </form>
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
    <script src="js/reservaFormulario.js?v=1"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</body>
</html>
