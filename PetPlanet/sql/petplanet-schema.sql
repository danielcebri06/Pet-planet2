-- Base de datos PET PLANET
-- Script SQL para crear la estructura de la base de datos

CREATE DATABASE IF NOT EXISTS pet_planet CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE pet_planet;

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  imagen VARCHAR(255),
  categoria VARCHAR(100),
  stock INT NOT NULL DEFAULT 0,
  destacado TINYINT(1) NOT NULL DEFAULT 0,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FULLTEXT KEY ft_nombre_descripcion (nombre, descripcion),
  KEY idx_categoria (categoria),
  KEY idx_precio (precio)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de pedidos
CREATE TABLE IF NOT EXISTS pedidos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    total_importe DECIMAL(10,2) NOT NULL,
    estado VARCHAR(50) DEFAULT 'Pendiente',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    KEY idx_estado (estado)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla de detalles de pedidos
CREATE TABLE IF NOT EXISTS pedidos_detalles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT UNSIGNED NOT NULL,
    nombre_producto VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
    KEY idx_pedido_id (pedido_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Inserts de ejemplo
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria, stock, destacado) VALUES
('Pelota con ruido para perros', 'Pelota divertida para perros, con sonido que los mantiene activos.', 15.99, 'accesorioPerro.webp', 'Accesorios', 25, 1),
('Rascador para gatos', 'Rascador resistente para mantener las uñas de tu gato sanas y tu sofá intacto.', 29.50, 'accesorioGato.webp', 'Accesorios', 30, 0),
('Jaula para pájaros pequeña', 'Jaula compacta y segura para aves pequeñas, fácil de limpiar.', 45.00, 'accesorioPajaro.webp', 'Accesorios', 10, 0),
('Comedero automático para perros', 'Comedero automático programable para mantener la comida fresca.', 60.00, 'comederoPerro.webp', 'Accesorios', 12, 0),
('Fuente de agua para gatos', 'Fuente de agua filtrada para gatos, fomenta la hidratación.', 35.50, 'fuenteGato.webp', 'Accesorios', 18, 0),
('Cama cómoda para perros', 'Cama acolchada y lavable, perfecta para el descanso.', 40.00, 'camaPerro.webp', 'Accesorios', 20, 0),
('Alimento para Perros (Pienso)', 'Alimento seco premium para perros adultos. Nutrición completa.', 15.99, 'PiensoPerro.webp', 'Alimentación', 80, 1),
('Alimento para Gatos (Pienso)', 'Alimento completo para gatos adultos. Favorece la digestión y pelaje.', 18.00, 'PiensoGato.webp', 'Alimentación', 70, 0),
('Alimento para Aves', 'Mezcla de semillas de alta calidad para aves.', 12.00, 'PiensoPajaro.webp', 'Alimentación', 50, 0),
('Pack 12 Latas Comida Húmeda Perro', 'Pack de 12 latas de comida húmeda para perros.', 24.99, 'lataPerro.webp', 'Alimentación', 40, 0),
('Snacks Dentales Gato', 'Snacks dentales para gatos. Mantienen dientes limpios.', 9.99, 'snackGato.webp', 'Alimentación', 50, 1),
('Semillas Premium Aves', 'Mezcla premium de semillas para aves.', 16.50, 'semillaPremium.webp', 'Alimentación', 35, 0),
('Champú para perros', 'Champú con fórmula suave para perros, aroma agradable.', 8.99, 'champu perro.webp', 'SaludEHigiene', 60, 1),
('Cepillo de dientes para gatos', 'Cepillo dental especialmente diseñado para gatos.', 13.00, 'Cepillo Gatos.webp', 'SaludEHigiene', 45, 0),
('Arena para pájaros', 'Arena especial para aves que absorbe humedad y controla olores.', 18.50, 'arena pajaro.jpg', 'SaludEHigiene', 22, 1),
('Limpiador de patas para perros', 'Limpiador de patas fácil de usar para después de los paseos.', 16.00, 'limpiapatas.webp', 'SaludEHigiene', 30, 0),
('Pasta de dientes para gatos', 'Pasta dental para gatos que ayuda a reducir placa.', 9.25, 'pasta de dientes.webp', 'SaludEHigiene', 40, 0),
('Protector hepático para pájaros', 'Suplemento protector hepático para aves.', 13.20, '51yux+ii4CL.webp', 'SaludEHigiene', 15, 0),
('Correa retráctil para perros', 'Correa retráctil resistente y cómoda.', 24.99, 'correaPerro.webp', 'Accesorios', 28, 1),
('Columpio para pájaros', 'Columpio para pájaros para entretenimiento en jaula.', 11.99, 'columpioPajaro.webp', 'Accesorios', 33, 0);
