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
        <img src="imagenes/Casita.png" alt="Casita" class="casita">
        <a href="index.php">Inicio</a>
        <a>></a>
        <a class="panselec" href="Adopciones.php">Adopta a una Mascota</a>
  </div>

  <section class="productos">
        <h1>Adopciones de Mascotas</h1>
        <p>Descubre nuestros amigos necesitados de una familia.</p>

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

        <!-- TARJETAS DE LAS MASCOTAS -->
        <div class="productos-lista" id="mascotas-lista">

            <!--PERROS-->
            <div class="producto" 
                    data-nombre="Toy"
                    data-tipo="perro"
                    data-edad="adulto"
                    data-descripcion="Cariñoso, sociable y con energía moderada."
                    data-imagen="imagenes/perro1.jpg">
                <img src="imagenes/perro1.jpg" alt="Toy">
                <h2>Toy</h2>
                <p><strong>Tipo:</strong>Perro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Cariñoso y sociable, ideal para familias con niños</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Tristán"
                    data-tipo="perro"
                    data-edad="adulto"
                    data-descripcion="Cariñoso y juguetón, tamaño mediano. Ideal para familias activas."
                    data-imagen="imagenes/perro2.jpg">
                <img src="imagenes/perro2.jpg" alt="Tristán">
                <h2>Tristán</h2>
                <p><strong>Tipo:</strong>Perro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Cariñoso y juguetón, tamaño mediano. Ideal para familias activas</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Farru"
                    data-tipo="perro"
                    data-edad="anciano"
                    data-descripcion="Poco sociable, sólo busca que le quieran."
                    data-imagen="imagenes/perro3.jfif">
                <img src="imagenes/perro3.jfif" alt="Farru">
                <h2>Farru</h2>
                <p><strong>Tipo:</strong>Perro</p>
                <p><strong>Edad:</strong>Anciano</p>
                <p>Poco sociable, sólo busca que le quieran</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Pecas"
                    data-tipo="perro"
                    data-edad="adulto"
                    data-descripcion="Cariñoso y sociable, ideal para familias con niños."
                    data-imagen="imagenes/perro4.jpeg">
                <img src="imagenes/perro4.jpeg" alt="Pecas">
                <h2>Pecas</h2>
                <p><strong>Tipo:</strong>Perro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Cariñoso y sociable, ideal para familias con niños</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Lúa"
                    data-tipo="perro"
                    data-edad="adulto"
                    data-descripcion="Cariñoso, juguetón y sociable, ideal para familias con niños."
                    data-imagen="imagenes/perro5.jfif">
                <img src="imagenes/perro5.jfif" alt="Lua">
                <h2>Lúa</h2>
                <p><strong>Tipo:</strong>Perro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Cariñoso, juguetón y sociable, ideal para familias con niños</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>


            <!--GATOS-->
            <div class="producto" 
                    data-nombre="Michi"
                    data-tipo="gato"
                    data-edad="adulto"
                    data-descripcion="Macho capado. Casero, cariñoso y sociable."
                    data-imagen="imagenes/gato1.png">
                <img src="imagenes/gato1.png" alt="Michi">
                <h2>Michi</h2>
                <p><strong>Tipo:</strong>Gato</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Macho capado. Casero, cariñoso y sociable</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Tisbe"
                    data-tipo="gato"
                    data-edad="cachorro"
                    data-descripcion="Cariñoso, juguetón y curioso. Tiene 3 meses."
                    data-imagen="imagenes/gato2.webp">
                <img src="imagenes/gato2.webp" alt="Tisbe">
                <h2>Tisbe</h2>
                <p><strong>Tipo:</strong>Gato</p>
                <p><strong>Edad:</strong>Cachorro</p>
                <p>Cariñoso, juguetón y curioso. Tiene 3 meses</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Pulga"
                    data-tipo="gato"
                    data-edad="cachorro"
                    data-descripcion="Inquieto, juguetón y curioso. Tiene 3 meses."
                    data-imagen="imagenes/gato3.jpg">
                <img src="imagenes/gato3.jpg" alt="Pulga">
                <h2>Pulga</h2>
                <p><strong>Tipo:</strong>Gato</p>
                <p><strong>Edad:</strong>Cachorro</p>
                <p>Inquieto, juguetón y curioso. Tiene 3 meses</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Luna"
                    data-tipo="gato"
                    data-edad="adulto"
                    data-descripcion="Asustadizo y casero."
                    data-imagen="imagenes/gato4.jpg"> 
                <img src="imagenes/gato4.jpg" alt="Luna">
                <h2>Luna</h2>
                <p><strong>Tipo:</strong>Gato</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Asustadizo y casero</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Sombra"
                    data-tipo="gato"
                    data-edad="adulto"
                    data-descripcion="Juguetón y sociable."
                    data-imagen="imagenes/gato5.jpg"> 
                <img src="imagenes/gato5.jpg" alt="Sombra">
                <h2>Sombra</h2>
                <p><strong>Tipo:</strong>Gato</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Juguetón y sociable</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>


            <!--PAJAROS-->
            <div class="producto" 
                    data-nombre="Agapornis"
                    data-tipo="pajaro"
                    data-edad="adulto"
                    data-descripcion="Agapornis en busca de pareja."
                    data-imagen="imagenes/pajaro1.webp"> 
                <img src="imagenes/pajaro1.webp" alt="agapornis">
                <h2>Agapornis</h2>
                <p><strong>Tipo:</strong>Pájaro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Agapornis en busca de pareja</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Pareja de Periquitos"
                    data-tipo="pajaro"
                    data-edad="adulto"
                    data-descripcion="Pareja fieles busca de hogar."
                    data-imagen="imagenes/pajaro2.webp"> 
                <img src="imagenes/pajaro2.webp" alt="periquito">
                <h2>Pareja de Periquitos</h2>
                <p><strong>Tipo:</strong>Pájaro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Pareja fieles busca de hogar</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

            <div class="producto" 
                    data-nombre="Canarios"
                    data-tipo="pajaro"
                    data-edad="adulto"
                    data-descripcion="Canario hace honor a la expresión amarillo canario."
                    data-imagen="imagenes/pajaro3.jpg"> 
                <img src="imagenes/pajaro3.jpg" alt="Canario">
                <h2>Canario</h2>
                <p><strong>Tipo:</strong>Pájaro</p>
                <p><strong>Edad:</strong>Adulto</p>
                <p>Canario hace honor a la expresión "amarillo canario"</p>
                <button class="btn-reservar-tarjeta" type="button">Reservar</button>
            </div>

        </div>

    </section>

    <div id="modalMascota" class="modal">
            <div class="modal-contenido">
                <span class="cerrar">&times;</span>
                <img id="modalImagen" src="" alt="" class="modal-img">
                <h2 id="modalNombre"></h2>
                <p id="modalDescripcion"></p>
                <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
                <p><strong>Edad:</strong> <span id="modalEdad"></span></p>
                <button class="btn-reservado" id="btnReservar">Reservar adopción</button>
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
  <script src="js/adopcionModal.js"></script>   
  <script src="js/buscador.js"></script>
  <script src="js/carrito.js"></script>
  <script src="js/adopociones.js"></script>
  <script src="js/menu.js"></script> 
    <script src=> "js/datos.js"</script>

</body>
</html>