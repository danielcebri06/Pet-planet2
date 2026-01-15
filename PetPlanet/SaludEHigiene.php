<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salud e Higiene - PET PLANET</title>
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
                <a class="claseseleccionada" href="SaludEHigiene.php">Salud e higiene</a>
                <a href="Adopciones.php">Adopta a una Mascota</a>
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
        <img src="imagenes/Casita.png" alt="Casita" class="casita">
        <a href="index.php">Inicio</a>
        <a>></a>
        <a class="panselec" href="SaludEHigiene.php">Salud e Higiene</a>
    </div>

    <section class="productos">
        <h1>Salud e higiene para mascotas</h1>
        <p>Productos para salud e higiene.</p>
          
        <div class="filtros filtros-adopcion" data-filtros>
           
            <select class="filtro-select"  id="filtro-tipo">
                <option value="todos">Todos los animales</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="pajaro">Pájaro</option>
            </select>

            <select class="filtro-select" id="filtro-precio">
                <option value="todos">Sin limite</option>
                <option value="10">Hasta 10€</option>
                <option value="15">Hasta 15€</option>
                <option value="20">Hasta 20€</option>
            </select>
        </div>

        <div class="productos-lista">
            <div class="producto" data-tipo="perro" data-nombre="Champú para perros" data-precio="8.99" data-descripcion="Champú suave." data-imagen="champu perro.webp">
                <img src="imagenes/champu perro.webp" alt="Champú">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Champú para perros</h2>
                <p class="precio-original">12.01€</p>
                <p class="precio-oferta">8.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-tipo="gato" data-nombre="Cepillo de dientes para gatos" data-precio="13.00" data-descripcion="Cepillo dental." data-imagen="Cepillo Gatos.webp">
                <img src="imagenes/Cepillo Gatos.webp" alt="Cepillo">
                <h2>Cepillo de dientes</h2>
                <p>Precio: 13.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-tipo="pajaro" data-nombre="Arena para pájaros" data-precio="18.50" data-descripcion="Arena especial." data-imagen="arena pajaro.jpg">
                <img src="imagenes/arena pajaro.jpg" alt="Arena">
                <div class="oferta-tag">¡OFERTA!</div>
                <h2>Arena para pájaros</h2>
                <p class="precio-original">23.00€</p>
                <p class="precio-oferta">18.50€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        
        
            <div class="producto" data-tipo="perro" data-nombre="Limpiador de patas para perros" data-precio="16.00" data-descripcion="Limpiador fácil." data-imagen="limpiapatas.webp">
                <img src="imagenes/limpiapatas.webp" alt="Limpiador">
                <h2>Limpiador de patas</h2>
                <p>Precio: 16.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-tipo="gato" data-nombre="Pasta de dientes para gatos" data-precio="9.25" data-descripcion="Pasta dental." data-imagen="pasta de dientes.webp">
                <img src="imagenes/pasta de dientes.webp" alt="Pasta">
                <h2>Pasta de dientes</h2>
                <p>Precio: 9.25€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
            <div class="producto" data-tipo="pajaro" data-nombre="Protector hepático para pájaros" data-precio="13.20" data-descripcion="Suplemento." data-imagen="51yux+ii4CL.webp">
                <img src="imagenes/51yux+ii4CL.webp" alt="Protector">
                <h2>Protector hepático</h2>
                <p>Precio: 13.20€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>
    </section>
    
    <div id="modalProducto" class="modal"><div class="modal-contenido"><span class="cerrar">&times;</span><img id="modalImagen" src="" alt="" class="modal-img"><h2 id="modalNombre"></h2><p id="modalDescripcion"></p><p class="modal-precio" id="modalPrecio"></p><button class="btn-cesta">Añadir a la cesta</button><div class="comentarios-seccion"><h3>Comentarios</h3><div id="listaComentarios" class="lista-comentarios"></div><div class="nuevo-comentario"><textarea id="comentarioTexto"></textarea><button id="btnEnviarComentario">💬 Enviar</button></div></div></div></div>

<footer>
    <div class="copyright">
      &copy; 2025 PET PLANET.
    </div>
    <div class="legales">
        <a href="#">Aviso Legal</a> | <a href="#">Política de Privacidad</a> | <a href="#">Política de Cookies</a>
    </div>
 </footer>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

    <script src="js/saludEHigiene.js"></script>
    <script src="js/database.js"></script>
    <script src="js/modoOscuro.js"></script>
    <script src="js/productoModal.js"></script>
    <script src="js/buscador.js"></script>
    <script src="js/carrito.js"></script>
    <script src="js/menu.js"></script> 
</body>
</html>