<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventosC | Inicio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Frontend/assets/css/index.css">

    <link rel="stylesheet" href="Frontend/assets/css/homepage_support.css">
</head>

<body>

    <?php require_once 'Frontend/views/layouts/header.php'; ?>

    <div class="main-wrapper">

        <section class="hero-split">
            <div class="hero-video-panel">
                <video src="Frontend/assets/img/background.mp4" autoplay muted loop class="split-video"></video>
                <div class="video-overlay"></div>
            </div>
            <div class="hero-info-panel">
                <div class="hero-content-wrapper">
                    <img src="Frontend/assets/img/eventosclogo.png" alt="EventosC" class="hero-logo-lg">
                    <h1 class="hero-title">EXPERIENCIAS <span class="neon-text">DIGITALES</span></h1>
                    <p class="hero-subtitle">La plataforma definitiva para la gestión de eventos de alto nivel.</p>
                    <div class="hero-actions">
                        <a href="index.php?view=reservas" class="cy-btn primary">
                            RESERVAR AHORA <span class="material-symbols-rounded">arrow_forward</span>
                        </a>
                        <a href="#reviews" class="cy-btn outline">
                            VER RESEÑAS
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="stat-item">
                <span class="stat-number" data-target="150">+150</span>
                <span class="stat-label">EVENTOS REALIZADOS</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-number" data-target="99">99%</span>
                <span class="stat-label">CLIENTES SATISFECHOS</span>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <span class="stat-number" data-target="24">24/7</span>
                <span class="stat-label">SOPORTE TÉCNICO</span>
            </div>
        </section>

        <section class="hive-section">
            <h2 class="hive-title">SERVICIOS INTEGRALES</h2>

            <div class="hive-carousel-container">
                <div class="hive-track">

                    <div class="hex-wrapper theme-one">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/onekoritalogo.png" alt="Onekora" class="hex-icon-img">
                            <h3>ONEKORA</h3>
                            <p>Gestión de Residuos Eco-Friendly</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-dim">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logodimesaur.png" alt="Dimesaur" class="hex-icon-img">
                            <h3>DIMESAUR</h3>
                            <p>Pagos y Facturación Instantánea</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-sec">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logoseguridad.png" alt="Seguridad" class="hex-icon-img">
                            <h3>SEGURIDAD</h3>
                            <p>Control de Acceso y Vigilancia</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-cat">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logocatering.png" alt="Catering" class="hex-icon-img">
                            <h3>CATERING</h3>
                            <p>Gastronomía y Barra Ejecutiva</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-vid">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logomultimedia.png" alt="Multimedia" class="hex-icon-img">
                            <h3>MULTIMEDIA</h3>
                            <p>Fotografía y Video 4K Profesional</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-lig">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logoiluminacion.png" alt="Iluminación" class="hex-icon-img">
                            <h3>ILUMINACIÓN</h3>
                            <p>Ambientación Escénica y Láser</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-sou">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logosonidopro.png" alt="Sonido" class="hex-icon-img">
                            <h3>SONIDO PRO</h3>
                            <p>Audio de Alta Fidelidad y DJ</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-str">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/streaminglogo.png" alt="Streaming" class="hex-icon-img">
                            <h3>STREAMING</h3>
                            <p>Transmisión en Vivo Multi-Plataforma</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-stf">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/stafflogo.png" alt="Staff" class="hex-icon-img">
                            <h3>STAFF VIP</h3>
                            <p>Anfitriones y Seguridad Personal</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-dec">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/decoracioneslogo.png" alt="Decoración" class="hex-icon-img">
                            <h3>DECORACIÓN</h3>
                            <p>Diseño de Interiores y Mobiliario</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-log">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/logisticalogo.png" alt="Logística" class="hex-icon-img">
                            <h3>LOGÍSTICA</h3>
                            <p>Transporte y Montaje Completo</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-vip">
                        <div class="hex-content">
                            <img src="Frontend/assets/img/viplogo.png" alt="VIP" class="hex-icon-img">
                            <h3>ZONA VIP</h3>
                            <p>Espacios Exclusivos para Invitados</p>
                        </div>
                    </div>

                    <div class="hex-wrapper theme-one">
                        <div class="hex-content"><img src="Frontend/assets/img/onekoritalogo.png" class="hex-icon-img">
                            <h3>ONEKORA</h3>
                            <p>Gestión de Residuos Eco-Friendly</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-dim">
                        <div class="hex-content"><img src="Frontend/assets/img/logodimesaur.png" class="hex-icon-img">
                            <h3>DIMESAUR</h3>
                            <p>Pagos y Facturación Instantánea</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-sec">
                        <div class="hex-content"><img src="Frontend/assets/img/logoseguridad.png" class="hex-icon-img">
                            <h3>SEGURIDAD</h3>
                            <p>Control de Acceso y Vigilancia</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-cat">
                        <div class="hex-content"><img src="Frontend/assets/img/logocatering.png" class="hex-icon-img">
                            <h3>CATERING</h3>
                            <p>Gastronomía y Barra Ejecutiva</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-vid">
                        <div class="hex-content"><img src="Frontend/assets/img/logomultimedia.png" class="hex-icon-img">
                            <h3>MULTIMEDIA</h3>
                            <p>Fotografía y Video 4K Profesional</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-lig">
                        <div class="hex-content"><img src="Frontend/assets/img/logoiluminacion.png"
                                class="hex-icon-img">
                            <h3>ILUMINACIÓN</h3>
                            <p>Ambientación Escénica y Láser</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-sou">
                        <div class="hex-content"><img src="Frontend/assets/img/logosonidopro.png" class="hex-icon-img">
                            <h3>SONIDO PRO</h3>
                            <p>Audio de Alta Fidelidad y DJ</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-str">
                        <div class="hex-content"><img src="Frontend/assets/img/streaminglogo.png" class="hex-icon-img">
                            <h3>STREAMING</h3>
                            <p>Transmisión en Vivo Multi-Plataforma</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-stf">
                        <div class="hex-content"><img src="Frontend/assets/img/stafflogo.png" class="hex-icon-img">
                            <h3>STAFF VIP</h3>
                            <p>Anfitriones y Seguridad Personal</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-dec">
                        <div class="hex-content"><img src="Frontend/assets/img/decoracioneslogo.png"
                                class="hex-icon-img">
                            <h3>DECORACIÓN</h3>
                            <p>Diseño de Interiores y Mobiliario</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-log">
                        <div class="hex-content"><img src="Frontend/assets/img/logisticalogo.png" class="hex-icon-img">
                            <h3>LOGÍSTICA</h3>
                            <p>Transporte y Montaje Completo</p>
                        </div>
                    </div>
                    <div class="hex-wrapper theme-vip">
                        <div class="hex-content"><img src="Frontend/assets/img/viplogo.png" class="hex-icon-img">
                            <h3>ZONA VIP</h3>
                            <p>Espacios Exclusivos para Invitados</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="arrow-reviews-section" id="reviews">
            <div class="section-header-small" style="text-align: center; margin-bottom: 50px;">
                <h3>LO QUE DICEN NUESTROS CLIENTES</h3>
            </div>

            <div class="arrow-container">

                <div class="arrow-card-wrapper point-right">
                    <div class="arrow-avatar-float">A</div>
                    <div class="arrow-glass-body">
                        <svg class="bg-star-decoration right-bottom" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>

                        <div class="review-content">
                            <p>"La mejor plataforma que he usado. La organización de mi boda fue impecable gracias a
                                EventosC."</p>
                            <div class="review-meta">
                                <span class="review-author-name">Ana García</span>
                                <div class="star-rating">
                                    <svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="arrow-card-wrapper point-left">
                    <div class="arrow-avatar-float">C</div>
                    <div class="arrow-glass-body">
                        <svg class="bg-star-decoration left-bottom" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>

                        <div class="review-content">
                            <p>"Interfaz increíblemente rápida y futurista. Da gusto trabajar con herramientas así."</p>
                            <div class="review-meta">
                                <div class="star-rating"><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg></div>
                                <span class="review-author-name">Carlos M.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="arrow-card-wrapper point-right">
                    <div class="arrow-avatar-float">S</div>
                    <div class="arrow-glass-body">
                        <svg class="bg-star-decoration right-bottom" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <div class="review-content">
                            <p>"Soporte 10/10. Tuve un problema complejo y lo solucionaron en minutos."</p>
                            <div class="review-meta">
                                <span class="review-author-name">Sarah J.</span>
                                <div class="star-rating"><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg empty" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="arrow-card-wrapper point-left">
                    <div class="arrow-avatar-float">D</div>
                    <div class="arrow-glass-body">
                        <svg class="bg-star-decoration left-bottom" viewBox="0 0 24 24">
                            <path
                                d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                        </svg>
                        <div class="review-content">
                            <p>"Absolutamente cine. La estética Cyberpunk le da un toque único."</p>
                            <div class="review-meta">
                                <div class="star-rating"><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg><svg class="star-svg" viewBox="0 0 24 24">
                                        <path
                                            d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                    </svg></div>
                                <span class="review-author-name">David R.</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>

    <?php require_once 'Frontend/views/layouts/footer.php'; ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.querySelector('.hive-track');

            // CONFIGURACIÓN
            let speed = 0.8; // Velocidad del auto-scroll (más alto = más rápido)

            // VARIABLES DE ESTADO
            let position = 0;
            let isDragging = false;
            let startX = 0;
            let lastPosition = 0;
            let animationId;

            // Calculamos el punto de reinicio (La mitad exacta del ancho total)
            // Como duplicamos los items, cuando llegamos a la mitad, volvemos a 0 sin que se note.
            // (260px ancho + 40px gap) * 12 items = 3600px
            const resetPoint = -3600;

            // --- FUNCIÓN PRINCIPAL DE ANIMACIÓN (EL MOTOR) ---
            function animate() {
                if (!isDragging) {
                    position -= speed;

                    // Lógica del Loop Infinito
                    if (position <= resetPoint) {
                        position = 0;
                    }
                    // Si arrastran hacia la derecha más allá del inicio
                    if (position > 0) {
                        position = resetPoint;
                    }

                    updatePosition();
                }
                animationId = requestAnimationFrame(animate);
            }

            function updatePosition() {
                track.style.transform = `translateX(${position}px)`;
            }

            // --- EVENTOS DEL MOUSE (ARRASTRAR) ---

            track.addEventListener('mousedown', (e) => {
                isDragging = true;
                track.classList.add('grabbing'); // Cambia el cursor
                startX = e.pageX; // Guarda donde hiciste click
                lastPosition = position; // Guarda donde estaba el carrusel
            });

            window.addEventListener('mouseup', () => {
                isDragging = false;
                track.classList.remove('grabbing');
            });

            window.addEventListener('mousemove', (e) => {
                if (!isDragging) return;

                e.preventDefault(); // Evita seleccionar texto
                const currentX = e.pageX;
                const diff = currentX - startX; // Cuánto moviste el mouse

                // Mueve el carrusel sumando la diferencia a donde estaba antes
                position = lastPosition + diff;

                updatePosition();
            });

            // --- EVENTOS TÁCTILES (PARA MÓVIL) ---
            track.addEventListener('touchstart', (e) => {
                isDragging = true;
                startX = e.touches[0].pageX;
                lastPosition = position;
            });

            window.addEventListener('touchend', () => {
                isDragging = false;
            });

            window.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                const currentX = e.touches[0].pageX;
                const diff = currentX - startX;
                position = lastPosition + diff;
                updatePosition();
            });

            // ENCENDEMOS EL MOTOR
            animate();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Seleccionamos todas las tarjetas de reseña
            const cards = document.querySelectorAll('.arrow-card-wrapper');

            // Configuración del Observador (El ojo que vigila el scroll)
            const observerOptions = {
                threshold: 0.2, // Se activa cuando el 20% de la tarjeta es visible
                rootMargin: "0px"
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // Si la tarjeta entra en pantalla...
                    if (entry.isIntersecting) {
                        // ...le agregamos la clase 'visible' que activa el CSS
                        entry.target.classList.add('visible');
                        // Dejamos de observarla (para que no se anime de nuevo al subir)
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Ponemos el observador a vigilar cada tarjeta
            cards.forEach(card => {
                observer.observe(card);
            });
        });
    </script>



</body>

</html>