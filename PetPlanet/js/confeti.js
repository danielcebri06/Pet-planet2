// 1. Función Global de Confeti
function lanzarConfeti() {
    // Verificamos si la librería cargó correctamente
    if (typeof confetti === 'function') {
        
        // Efecto 1: Disparo central
        confetti({
            particleCount: 500,
            spread: 500,
            origin: { y: 0.5 },
            zIndex: 9999999, // Z-Index muy alto para que salga ENCIMA del modal
            
        });

        // Efecto 2: Pequeños disparos laterales (opcional, para más fiesta)
        setTimeout(() => {
            confetti({
                particleCount: 500,
                angle: 60,
                spread: 500,
                origin: { x: 0 },
                zIndex: 9999999,
                
              
            });
            
        }, 200);
        setTimeout(() => {
        confetti({
                particleCount: 500,
                angle: 120,
                spread: 500,
                origin: { x: 1 },
                zIndex: 9999999,
                
            });
            }, 400);

    } else {
        console.warn("La librería canvas-confetti no se ha cargado aún.");
    }
}
/**
 * 2. DETECTOR DE CLICS GLOBAL (Fuera del DOMContentLoaded)
 * Usamos {capture: true} para asegurar que detectamos el clic ANTES 
 * que el modal o el carrito detengan la propagación.
 */
document.addEventListener('click', function(event) {
    // Verifica si el elemento clicado (o su padre) tiene la clase deseada
    
    if (event.target.matches('.btn-comprar') || event.target.matches('.btn-cesta')) {
        lanzarConfeti();

    }
}, true); // <--- El 'true' es la clave: fase de captura







