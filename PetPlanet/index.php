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
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

  <style>
    /* --- ESTILOS DEL BANNER SUPERIOR (FONDO DESLIZANTE) --- */
    .banner-container {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
        background-color: #333;
    }

    /* Texto Fijo encima del banner */
    .contenido-fijo {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10; 
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: #ffffff;
        pointer-events: none;
    }

    .contenido-fijo h1, .contenido-fijo p, .contenido-fijo a {
        pointer-events: auto;
    }

    .contenido-fijo h1 {
        font-size: 3.5rem;
        margin-bottom: 20px;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    }

    .contenido-fijo p {
        font-size: 1.5rem;
        margin-bottom: 30px;
        text-shadow: 1px 1px 5px rgba(0,0,0,0.7);
        font-weight: 500;
    }

    .btn-banner {
        display: inline-block;
        padding: 15px 40px;
        background-color: #e67e22;
        color: white;
        text-decoration: none;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    }
    .btn-banner:hover {
        background-color: #d35400;
        transform: scale(1.05);
    }

    /* Imágenes de fondo del banner */
    .banner-swiper {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0; left: 0;
        z-index: 1; 
    }

    .banner-swiper .swiper-slide {
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .banner-swiper .swiper-slide::after {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
    }

    /* --- ESTILOS DEL SLIDER DE PRODUCTOS --- */
    .swiper-productos {
        width: 100%;
        padding: 20px 50px; /* Padding lateral para que quepan las flechas */
        box-sizing: border-box;
    }

    /* Ajuste de la tarjeta de producto dentro del swiper */
    .swiper-productos .swiper-slide {
        display: flex;
        justify-content: center;
        height: auto; /* Para que todas tengan la misma altura */
    }

    .swiper-productos .producto {
        width: 100%; /* Ocupa el ancho que le asigne el swiper */
        margin: 0; /* Quitamos márgenes externos ya que Swiper maneja el espacio */
    }

    /* Flechas de navegación de productos (negras/naranjas) */
    .btn-prod-prev, .btn-prod-next {
        color: #e67e22; /* Color naranja */
        font-weight: bold;
    }
    .btn-prod-prev::after, .btn-prod-next::after {
        font-size: 2rem;
    }

  </style>
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

  <div class="banner-container">
    <div class="contenido-fijo">
        <h1>Todo para tu mascota</h1>
        <p>Encuentra los mejores productos y ofertas para perros, gatos y pájaros.</p>
        <a href="Ofertas.php" class="btn-banner">Ver ofertas</a>
    </div>

    <div class="swiper banner-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" style="background-image: url('imagenes/Banner.avif');"></div>
            <div class="swiper-slide" style="background-image: url('imagenes/banner-gato.webp');"></div>
             <div class="swiper-slide" style="background-image: url('imagenes/banner-pajaro.webp');"></div>
        </div>
    </div>
  </div>

  <section class="productos-destacados">
    <h2 style="text-align: center; margin-bottom: 20px;">Productos Destacados</h2>
    
    <div class="swiper swiper-productos">
      <div class="swiper-wrapper">
        
        <div class="swiper-slide">
            <div class="producto" data-nombre="Pelota con ruido para perros" data-descripcion="Pelota divertida para perros, con sonido que los mantiene activos." data-precio="15.99€" data-imagen="accesorioPerro.webp">
                <img src="imagenes/accesorioPerro.webp" alt="Pelota con ruido para perros">
                <h3>Pelota con ruido</h3>
                <p class="precio-oferta">15.99€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="producto" data-nombre="Rascador para gatos" data-descripcion="Rascador resistente para mantener las uñas de tu gato sanas." data-precio="29.50€" data-imagen="accesorioGato.webp">
                <img src="imagenes/accesorioGato.webp" alt="Rascador para gatos">
                <h3>Rascador para gatos</h3>
                <p class="precio-oferta">29.50€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="producto" data-nombre="Jaula para pájaros pequeña" data-descripcion="Jaula compacta y segura para aves pequeñas." data-precio="45.00€" data-imagen="accesorioPajaro.webp">
                <img src="imagenes/accesorioPajaro.webp" alt="Jaula para pájaros pequeña">
                <h3>Jaula para pájaros</h3>
                <p class="precio-oferta">45.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="producto" data-nombre="Comedero automático" data-descripcion="Mantén la comida de tu perro siempre fresca." data-precio="60.00€" data-imagen="comederoPerro.webp">
                <img src="imagenes/comederoPerro.webp" alt="Comedero automático">
                <h3>Comedero automático</h3>
                <p class="precio-oferta">60.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="producto" data-nombre="Fuente de agua" data-descripcion="Fuente de agua filtrada para gatos." data-precio="35.50€" data-imagen="fuenteGato.webp">
                <img src="imagenes/fuenteGato.webp" alt="Fuente de agua">
                <h3>Fuente de agua</h3>
                <p class="precio-oferta">35.50€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="producto" data-nombre="Cama cómoda" data-descripcion="Cama acolchada y lavable." data-precio="40.00€" data-imagen="camaPerro.webp">
                <img src="imagenes/camaPerro.webp" alt="Cama cómoda">
                <h3>Cama cómoda</h3>
                <p class="precio-oferta">40.00€</p>
                <button class="btn-comprar">Comprar</button>
            </div>
        </div>

      </div>
      
      <div class="swiper-button-prev btn-prod-prev"></div>
      <div class="swiper-button-next btn-prod-next"></div>
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
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="js/menu.js"></script> 
  <script src=> "js/datos.js"</script>
  
  
  <script>
    // 1. CONFIGURACIÓN BANNER PRINCIPAL
    const swiperBanner = new Swiper('.banner-swiper', {
        direction: 'horizontal',
        loop: true,
        effect: 'slide', 
        speed: 800,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        allowTouchMove: false, 
    });

    // 2. CONFIGURACIÓN SLIDER PRODUCTOS
    const swiperProductos = new Swiper('.swiper-productos', {
        direction: 'horizontal',
        loop: true, // Infinito
        // Espacio entre productos (en px)
        spaceBetween: 20,

        // Botones de navegación
        navigation: {
            nextEl: '.btn-prod-next',
            prevEl: '.btn-prod-prev',
        },

        // Breakpoints (Responsivo)
        breakpoints: {
            // Cuando la pantalla es pequeña (Móvil): 1 producto
            320: {
                slidesPerView: 1,
                spaceBetween: 10
            },
            // Cuando la pantalla es mediana (Tablet): 2 productos
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            // Cuando la pantalla es grande (PC): 3 productos
            1024: {
                slidesPerView: 3,
                slidesPerGroup: 3,
                spaceBetween: 30
            }
        }
    });
  </script>
</body>
</html>