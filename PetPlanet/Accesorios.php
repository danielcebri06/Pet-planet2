<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accesorios - PET PLANET</title>
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
        <a class="claseseleccionada" href="Accesorios.php">Accesorios</a>
        <a href="alimentacion.php">Alimentación</a>
        <a href="SaludEHigiene.php">Salud e higiene</a>
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
    <a class="panselec" href="Accesorios.php">Accesorios</a>
  </div>

  <section class="productos">
    <h1>Accesorios para Mascotas</h1>
    <p>Descubre nuestra amplia variedad de accesorios.</p>

        <div class="filtros filtros-adopcion" data-filtros>
            <input type="text" class="filtro-texto" placeholder="Buscar por nombre...">
    
            <select id="filtro-tipo" class="filtro-select">
                <option value="todos">Todos los animales</option>
                <option value="perro">Perro</option>
                <option value="gato">Gato</option>
                <option value="pajaro">Pájaro</option>
            </select>

            <select id="filtro-categoria" class="filtro-select">
                <option value="todas">Todas las categorías</option>
                <option value="juguete">Juguetes</option>
                <option value="hogar">Hogar / Jaulas</option>
            </select>
        </div>

    <div class="productos-lista">
      
      <div class="producto" 
           data-tipo="perro" 
           data-categoria="juguete"
           data-nombre="Pelota con ruido para perros" 
           data-precio="15.99€" 
           data-descripcion="Pelota interactiva." 
           data-imagen="accesorioPerro.webp">
        <img src="imagenes/accesorioPerro.webp" alt="Accesorios para perros">
        <div class="oferta-tag">¡OFERTA!</div>
        <h2>Pelota con ruido para perros</h2>
        <p class="precio-original">20.00€</p>
        <p class="precio-oferta">15.99€</p>
        <button class="btn-comprar">Comprar</button>
      </div>

  



      <div class="producto" 
           data-tipo="pajaro" 
           data-categoria="hogar"
           data-nombre="Jaula para aves grandes" 
           data-precio="19.99€" 
           data-descripcion="Jaula espaciosa." 
           data-imagen="accesorioPajaro.webp">
        <img src="imagenes/accesorioPajaro.webp" alt="Accesorios para aves">
        <div class="oferta-tag">¡OFERTA!</div>
        <h2>Jaula para aves grandes</h2>
        <p class="precio-original">25.00€</p>
        <p class="precio-oferta">19.99€</p>
        <button class="btn-comprar">Comprar</button>
      </div>

         <div class="producto" 
           data-tipo="perro" 
           data-categoria="hogar"
           data-nombre="cama para perros medianos" 
           data-precio="19.99€" 
           data-descripcion="Cama acolchada para perros pequeños o medianos." 
           data-imagen="camaPerro2.webp">
        <img src="imagenes/camaPerro2.webp" alt="Accesorios para perros">
        <h2>Cama de perro mediano</h2>
        <p>Precio: 25.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>

    </div>

    <div class="productos-lista">

           <div class="producto" 
           data-tipo="perro" 
           data-categoria="juguete"
           data-nombre="Correa de perro para el coche" 
           data-precio="7.99€" 
           data-descripcion="Correa ajustable para coche." 
           data-imagen="correaPerro2.webp">
        <img src="imagenes/correaPerro2.webp" alt="Accesorios para perros">
        <div class="oferta-tag">¡OFERTA!</div>
        <h2>Pelota con ruido para perros</h2>
        <p class="precio-original">15.99€</p>
        <p class="precio-oferta">7.99€</p>
        <button class="btn-comprar">Comprar</button>
      </div>

            <div class="producto" 
           data-tipo="gato" 
           data-categoria="hogar"
           data-nombre="Rascador para gatos" 
           data-precio="20.00€" 
           data-descripcion="Rascador de sisal." 
           data-imagen="accesorioGato.webp">
        <img src="imagenes/accesorioGato.webp" alt="Accesorios para gatos">
        <h2>Rascador para gatos</h2>
        <p>Precio: 20.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>

                <div class="producto" 
           data-tipo="pajaro" 
           data-categoria="hogar"
           data-nombre="Juguete para jaula" 
           data-precio="20.00€" 
           data-descripcion="Juguete para aves grandes." 
           data-imagen="jugueteAve.webp">
        <img src="imagenes/jugueteAve.webp" alt="Accesorios para pajaros">
        <h2>Juguete para aves.</h2>
        <p>Precio: 20.00€</p>
        <button class="btn-comprar">Comprar</button>
      </div>


    </div>
    <div class="productos-lista">

            <div class="producto" 
           data-tipo="gato" 
           data-categoria="hogar"
           data-nombre="Transportin para gatos" 
           data-precio="20.00€" 
           data-descripcion="Transportín mediano para gatos." 
           data-imagen="transportinGato.webp">
        <img src="imagenes/transportinGato.webp" alt="Accesorios para gatos">
        <h2>Transportin para gatos.</h2>
        <p>Precio: 20.00€</p>
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

  <script src="js/database.js"></script>
  <script src="js/modoOscuro.js"></script>
  <script src="js/productoModal.js"></script>
  <script src="js/buscador.js"></script>
  <script src="js/carrito.js"></script>
  
  <script src="js/accesorios.js"></script>
  <script src="js/menu.js"></script> 
  </body>
</html>