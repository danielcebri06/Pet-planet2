<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mi Carrito - PET PLANET</title>
  <link rel="stylesheet" href="proyecto.css">
  <link rel="stylesheet" href="ali-sal-accyjcss.css">
  <link rel="stylesheet" href="modal.css">
  <style>
    .carrito-vacio {
         text-align: center; padding: 40px; font-size: 18px; color: #666;
         }
    .carrito-contenedor { 
        max-width: 1000px; margin: 20px auto; padding: 20px;
     }
    .carrito-tabla { 
        width: 100%; border-collapse: collapse; margin-bottom: 20px; 
    }
    .carrito-tabla th, .carrito-tabla td { 
        padding: 12px; text-align: left; border-bottom: 1px solid #ddd; 
    }
    .carrito-tabla th { 
        background-color: #f5f5f5; font-weight: bold; 
    }
    .carrito-tabla img {
         width: 60px; height: 60px; object-fit: cover; 
        }
    .cantidad-input {
         width: 60px; padding: 5px; text-align: center;
         }
    .btn-eliminar { 
        background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer; font-size: 14px;
     }
    .btn-eliminar:hover {
         background-color: #c82333; 
        }
    .resumen-carrito { 
        background-color: #f9f9f9; padding: 20px; border-radius: 8px; max-width: 400px; margin-left: auto; 
    }
    .resumen-item { 
        display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 16px; 
    }
    .resumen-total {
         display: flex; justify-content: space-between; font-size: 20px; font-weight: bold; border-top: 2px solid #ddd; padding-top: 10px; margin-top: 10px; color: #27ae60; 
        }
    .btn-finalizar {
         width: 100%; background-color: #27ae60; color: white; border: none; padding: 12px; border-radius: 4px; font-size: 18px; cursor: pointer; margin-top: 15px; 
        }
    .btn-finalizar:hover {
         background-color: #229954; 
        }
    .btn-seguir-comprando {
         width: 100%; background-color: #3498db; color: white; border: none; padding: 10px; border-radius: 4px; font-size: 16px; cursor: pointer; margin-top: 10px; text-decoration: none; display: inline-block; text-align: center; 
        }
    .btn-seguir-comprando:hover {
         background-color: #2980b9; 
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
        <a href="index.php"><img src="imagenes/logoPetPlanet.jpg" alt="Logo" class="logo"></a>
      </div>
      <nav class="menu">
        <a href="Accesorios.php">Accesorios</a>
        <a href="alimentacion.php">Alimentación</a>
        <a href="SaludEHigiene.php">Salud e higiene</a>
        <a href="https://search.brave.com/search?q=kiwoko&view=full&map_src=c&bbox=-3.710%2C40.381%2C-3.480%2C40.551" target="_blank">Nuestras Tiendas</a>
      </nav>
      <div class="menu-hamburguesa">
        <button class="hamburguesa-btn" id="hamburguesa-btn">☰</button>
        <div class="menu-desplegable" id="menuDesplegable">
          <a href="#">Ajustes de la cuenta</a>
          <a href="carrito.php" class="menu-link carrito-link">🛒 Mi Carrito</a>
          <?php if (isset($_SESSION['usuario'])): ?>
              <div class="menu-link" style="font-weight: bold;">👤 <?= htmlspecialchars($_SESSION['usuario']) ?></div>
              <a href="logout.php" class="menu-link" style="color: #d9534f;">❌ Cerrar sesión</a>
          <?php else: ?>
              <a href="login.html" class="menu-link login-link">🔑 Iniciar sesión</a>
          <?php endif; ?>
          <div class="modo-oscuro-switch">
            <label class="switch"><input type="checkbox" id="darkModeSwitch"><span class="slider"></span></label>
            <span id="estadoModoOscuro">Modo oscuro desactivado</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class="carrito-contenedor">
    <h1>Mi Carrito de Compras</h1>

    <div id="carritoVacio" class="carrito-vacio" style="display: none;">
      <p>Tu carrito está vacío. ¡Comienza a comprar!</p>
      <a href="index.php" class="btn-seguir-comprando">Seguir comprando</a>
    </div>

    <div id="carritoLleno">
      <table class="carrito-tabla">
        <thead><tr><th>Imagen</th><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>Acción</th></tr></thead>
        <tbody id="listaCarrito"></tbody>
      </table>
      <div class="resumen-carrito">
        <div class="resumen-item"><span>Subtotal:</span><span id="subtotal">0.00€</span></div>
        <div class="resumen-item"><span>Impuestos (21%):</span><span id="impuestos">0.00€</span></div>
        <div class="resumen-total"><span>Total:</span><span id="total">0.00€</span></div>
        <button class="btn-finalizar" id="btnFinalizarCompra">Finalizar Compra</button>
        <a href="index.php" class="btn-seguir-comprando">Seguir comprando</a>
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