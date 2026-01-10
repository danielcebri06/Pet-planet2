<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PET PLANET - Tienda de Mascotas</title>
  <link rel="stylesheet" href="proyecto.css">
  <link rel="stylesheet" href="ali-sal-accyjcss.css">
  <link rel="stylesheet" href="modal.css">
</head>
<body>
  <header>
    <div class="principal">
      <div class="buscador-contenedor">
        <input type="text" placeholder="Buscar productos..." class="buscador" id="buscadorPrincipal">
        <button class="btn-buscar" id="btnBuscarPrincipal">Buscar</button>
      </div>

      <div class="cabecera-logo">
        <a href="index.php">
            <img src="imagenes/logoPetPlanet.jpg" alt="Logo" class="logo">
        </a>
      </div>

      <nav class="menu">
        <a href="Accesorios.php">Accesorios</a>
        <a href="alimentacion.php">Alimentación</a>
        <a href="SaludEHigiene.php">Salud e higiene</a>
        <a href="Adopciones.php">Adopta a una Mascota</a>
        <a href="https://search.brave.com/search?q=kiwoko&view=full&map_src=c&bbox=-3.710%2C40.381%2C-3.480%2C40.551" target="_blank" title="Ver tiendas Kiwoko">Nuestras Tiendas</a>
      </nav>

     <div class="menu-hamburguesa">
      <button class="hamburguesa-btn" id="hamburguesa-btn">☰</button>
      <div class="menu-desplegable" id="menuDesplegable">
        <a href="#">Ajustes de la cuenta</a>
        
        <?php if (isset($_SESSION['usuario'])): ?>
            <div class="menu-link" style="font-weight: bold; color: #2c3e50; cursor: default;">
                👤 <?= htmlspecialchars($_SESSION['usuario']) ?>
            </div>
            <a href="logout.php" class="menu-link" style="color: #d9534f; font-size: 0.9em;">❌ Cerrar sesión</a>
        <?php else: ?>
            <a href="login.html" class="menu-link login-link">🔑 Iniciar sesión</a>
        <?php endif; ?>

        <a href="carrito.php" class="menu-link carrito-link">🛒 Mi Carrito</a>

        <div class="modo-oscuro-switch">
          <label class="switch">
            <input type="checkbox" id="darkModeSwitch">
            <span class="slider"></span>
          </label>
          <span id="estadoModoOscuro">Modo oscuro desactivado</span>
        </div>
      </div>
    </div>
  </header>

  <section class="banner">
    <h1>Todo para tu mascota</h1>
    <p>Encuentra los mejores productos y ofertas para perros, gatos y pájaros.</p>
    <a href="Ofertas.php">Adopta a un pau</a>
  </section>

  <section class="productos-destacados">
    <h2>Productos Destacados</h2>
    <div class="productos-lista">
      <div class="producto" data-nombre="Pelota con ruido para perros" data-descripcion="Pelota divertida para perros, con sonido que los mantiene activos." data-precio="15.99€" data-imagen="accesorioPerro.webp">
        <img src="imagenes/accesorioPerro.webp" alt="Pelota con ruido para perros">
        <h3>Pelota con ruido para perros</h3>
        <p class="precio-oferta">15.99€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
      <div class="producto" data-nombre="Rascador para gatos" data-descripcion="Rascador resistente para mantener las uñas de tu gato sanas y tu sofá intacto." data-precio="29.50€" data-imagen="accesorioGato.webp">
        <img src="imagenes/accesorioGato.webp" alt="Rascador para gatos">
        <h3>Rascador para gatos</h3>
        <p class="precio-oferta">29.50€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
      <div class="producto" data-nombre="Jaula para pájaros pequeña" data-descripcion="Jaula compacta y segura para aves pequeñas, fácil de limpiar." data-precio="45.00€" data-imagen="accesorioPajaro.webp">
        <img src="imagenes/accesorioPajaro.webp" alt="Jaula para pájaros pequeña">
        <h3>Jaula para pájaros pequeña</h3>
        <p class="precio-oferta">45.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
    </div>
    <div class="productos-lista">
      <div class="producto" data-nombre="Comedero automático para perros" data-descripcion="Mantén la comida de tu perro siempre fresca con este comedero automático programable." data-precio="60.00€" data-imagen="comederoPerro.webp">
        <img src="imagenes/comederoPerro.webp" alt="Comedero automático para perros">
        <h3>Comedero automático para perros</h3>
        <p class="precio-oferta">60.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
      <div class="producto" data-nombre="Fuente de agua para gatos" data-descripcion="Fuente de agua filtrada para gatos, fomenta la hidratación y mantiene agua fresca." data-precio="35.50€" data-imagen="fuenteGato.webp">
        <img src="imagenes/fuenteGato.webp" alt="Fuente de agua para gatos">
        <h3>Fuente de agua para gatos</h3>
        <p class="precio-oferta">35.50€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
      <div class="producto" data-nombre="Cama cómoda para perros" data-descripcion="Cama acolchada y lavable, perfecta para el descanso de tu mascota." data-precio="40.00€" data-imagen="camaPerro.webp">
        <img src="imagenes/camaPerro.webp" alt="Cama cómoda para perros">
        <h3>Cama cómoda para perros</h3>
        <p class="precio-oferta">40.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>
    </div>
  </section>

  <div id="modalProducto" class="modal">
    <div class="modal-contenido">
      <span class="cerrar">&times;</span>
      <img id="modalImagen" src="" alt="Producto" class="modal-img">
      <h2 id="modalNombre"></h2>
      <p id="modalDescripcion"></p>
      <p class="modal-precio" id="modalPrecio"></p>
      <button class="btn-cesta">Añadir a la cesta</button>
      <div class="comentarios-seccion">
        <h3>Comentarios de clientes</h3>
        <div id="listaComentarios" class="lista-comentarios">
          <p class="sin-comentarios">Aún no hay comentarios. ¡Sé el primero en opinar!</p>
        </div>
        <div class="nuevo-comentario">
          <label for="comentarioTexto" class="comentario-label">Tu opinión:</label>
          <textarea id="comentarioTexto" placeholder="Escribe tu comentario aquí..."></textarea>
          <button id="btnEnviarComentario" class="btn-enviar-comentario">💬 Enviar comentario</button>
        </div>
      </div>
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

  <script src="js/database.js"></script>
  <script src="js/modoOscuro.js"></script>
  <script src="js/productoModal.js"></script>
  <script src="js/buscador.js"></script>
  <script src="js/carrito.js"></script>
  
  <script src="js/menu.js"></script> 
  </body>
</html>