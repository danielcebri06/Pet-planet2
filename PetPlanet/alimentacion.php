<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alimentación - PET PLANET</title>
    <link rel="stylesheet" href="proyecto.css">
    <link rel="stylesheet" href="ali-sal-accyjcss.css">
    <link rel="stylesheet" href="modal.css">
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
                <a class="claseseleccionada" href="alimentacion.php">Alimentación</a>
                <a href="SaludEHigiene.php">Salud e higiene</a>
                <a href="Adopciones.php">Adopta a una Mascota</a>
                <a href="https://search.brave.com/search?q=kiwoko&view=full&map_src=c&bbox=-3.710%2C40.381%2C-3.480%2C40.551" target="_blank">Nuestras Tiendas</a>
            </nav>
            <div class="menu-hamburguesa">
                <button class="hamburguesa-btn" id="hamburguesa-btn">☰</button>
                <div class="menu-desplegable" id="menuDesplegable">
                    <a href="#">Ajustes de la cuenta</a>
                    <?php if (isset($_SESSION['usuario'])): ?>
                        <div class="menu-link" style="font-weight: bold;">👤 <?= htmlspecialchars($_SESSION['usuario']) ?></div>
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
        <img src="imagenes/Casita.png" alt="Casita" class="casita">
        <a href="index.php">Inicio</a>
        <a>></a>
        <a class="panselec" href="alimentacion.php">Alimentación</a>
    </div>

    <section class="productos">
        <h1>Alimentación para Mascotas</h1>
        <p>Descubre nuestra amplia variedad de alimentos.</p>
        <div class="productos-lista">
            <div class="producto" data-nombre="Alimento para Perros" data-precio="15.99€" data-descripcion="Alimento seco." data-imagen="PiensoPerro.webp">
                <img src="imagenes/PiensoPerro.webp" alt="Alimento para perros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Alimento para Perros</h2>
                <p class="precio-original">20.00€</p>
                <p class="precio-oferta">15.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-nombre="Alimento para Gatos" data-precio="18.00€" data-descripcion="Alimento completo." data-imagen="PiensoGato.webp">
                <img src="imagenes/PiensoGato.webp" alt="Alimento para gatos">
                <h2>Alimento para Gatos</h2>
                <p>Precio: 18.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-nombre="Alimento para Aves" data-precio="12.00€" data-descripcion="Mezcla de semillas." data-imagen="PiensoPajaro.webp">
                <img src="imagenes/PiensoPajaro.webp" alt="Alimento para aves">
                <h2>Alimento para Aves</h2>
                <p>Precio: 12.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>
        <div class="productos-lista">
            <div class="producto" data-nombre="Pack 12 Latas Comida Húmeda Perro" data-precio="24.99€" data-descripcion="Comida húmeda." data-imagen="lataPerro.webp">
                <img src="imagenes/lataPerro.webp" alt="Comida húmeda">
                <h2>Pack 12 Latas</h2>
                <p>Precio: 24.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
             <div class="producto" data-nombre="Snacks Dentales Gato" data-precio="9.99€" data-descripcion="Snacks dentales." data-imagen="snackGato.webp">
                <img src="imagenes/snackGato.webp" alt="Snacks">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Snacks Dentales Gato</h2>
                <p class="precio-original">14.99€</p>
                <p class="precio-oferta">9.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
             <div class="producto" data-nombre="Semillas Premium Aves" data-precio="16.50€" data-descripcion="Mezcla premium." data-imagen="semillaPremium.webp">
                <img src="imagenes/semillaPremium.webp" alt="Semillas premium">
                <h2>Semillas Premium</h2>
                <p>Precio: 16.50€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>
    </section>
    
    <div id="modalProducto" class="modal"><div class="modal-contenido"><span class="cerrar">&times;</span><img id="modalImagen" src="" alt="" class="modal-img"><h2 id="modalNombre"></h2><p id="modalDescripcion"></p><p class="modal-precio" id="modalPrecio"></p><button class="btn-cesta">Añadir a la cesta</button><div class="comentarios-seccion"><h3>Comentarios</h3><div id="listaComentarios" class="lista-comentarios"></div><div class="nuevo-comentario"><textarea id="comentarioTexto"></textarea><button id="btnEnviarComentario">💬 Enviar</button></div></div></div></div>
    <footer><div class="copyright">&copy; 2025 PET PLANET.</div></footer>
  
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