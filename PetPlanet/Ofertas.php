<?php
session_start(); // INICIAR SESIÓN
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas - PET PLANET</title>
    <link rel="stylesheet" href="proyecto.css">
    <link rel="stylesheet" href="ali-sal-accyjcss.css">    
</head>
<body>
    <header>
        <div class="principal">
            <div class="buscador-contenedor">
                <input type="text" placeholder="Buscar..." class="buscador">
                <button class="btn-buscar">Buscar</button>
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
        </div>
    </header>

    <div class="miga-de-pan">
        <img src="imagenes/Casita.png" alt="Casita" class="casita">
        <a href="index.php">Inicio</a>
        <a>></a>
        <a class="panselec" href="Ofertas.php">Ofertas</a>
    </div>

    <section class="productos">
        <h1>¡Ofertas Especiales!</h1>
        <p>Encuentra las mejores ofertas para tus mascotas. ¡No te las pierdas!</p>

        <h2>Alimentación</h2>
        <div class="productos-lista">
            <div class="producto" data-nombre="Alimento para Perros" data-precio="15.99€" data-descripcion="Alimento en oferta." data-imagen="PiensoPerro.webp">
                <img src="imagenes/PiensoPerro.webp" alt="Alimento para perros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Alimento para Perros</h2>
                <p class="precio-original">20.00€</p>
                <p class="precio-oferta">15.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>

            <div class="producto" data-nombre="Snacks Dentales Gato" data-precio="9.99€" data-descripcion="Snacks en oferta." data-imagen="snackGato.webp">
                <img src="imagenes/snackGato.webp" alt="Snacks para gatos">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Snacks Dentales Gato</h2>
                <p class="precio-original">14.99€</p>
                <p class="precio-oferta">9.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <h2>Salud e Higiene</h2>
        <div class="productos-lista">
            <div class="producto" data-nombre="Champú para perros" data-precio="8.99€" data-descripcion="Champú en oferta." data-imagen="champu perro.webp">
                <img src="imagenes/champu perro.webp" alt="Champú para perros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Champú para perros</h2>
                <p class="precio-original">12.01€</p>
                <p class="precio-oferta">8.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>

            <div class="producto" data-nombre="Arena para pájaros" data-precio="18.50€" data-descripcion="Arena en oferta." data-imagen="arena pajaro.jpg">
                <img src="imagenes/arena pajaro.jpg" alt="Arena para pájaros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Arena para pájaros</h2>
                <p class="precio-original">23.00€</p>
                <p class="precio-oferta">18.50€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <h2>Accesorios</h2>
        <div class="productos-lista">
            <div class="producto" data-nombre="Pelota con ruido para perros" data-precio="15.99€" data-descripcion="Pelota en oferta." data-imagen="accesorioPerro.webp">
                <img src="imagenes/accesorioPerro.webp" alt="Pelota para perros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Pelota con ruido para perros</h2>
                <p class="precio-original">20.00€</p>
                <p class="precio-oferta">15.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>

            <div class="producto" data-nombre="Jaula para aves grandes" data-precio="19.99€" data-descripcion="Jaula en oferta." data-imagen="accesorioPajaro.webp">
                <img src="imagenes/accesorioPajaro.webp" alt="Jaula para aves">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Jaula para aves grandes</h2>
                <p class="precio-original">25.00€</p>
                <p class="precio-oferta">19.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="productos-lista">
            <div class="producto" data-nombre="Correa retráctil para perros" data-precio="24.99€" data-descripcion="Correa en oferta." data-imagen="correaPerro.webp">
                <img src="imagenes/correaPerro.webp" alt="Correa para perros">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Correa retráctil para perros</h2>
                <p class="precio-original">30.00€</p>
                <p class="precio-oferta">24.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>

            <div class="producto" data-nombre="Columpio para pájaros" data-precio="11.99€" data-descripcion="Columpio en oferta." data-imagen="columpioPajaro.webp">
                <img src="imagenes/columpioPajaro.webp" alt="Columpio para aves">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Columpio para pájaros</h2>
                <p class="precio-original">15.00€</p>
                <p class="precio-oferta">11.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>
    </section>

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