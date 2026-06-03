<!DOCTYPE html>
<php lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>DisciTrack - Inicio</title>
    <meta name="description" content="DisciTrack: plataforma para registrar, gestionar y dar seguimiento a procesos disciplinarios en instituciones educativas.">
    
    <link rel="icon" type="image/png" href="img/1.1.png" sizes="16x16">
    <link rel="icon" type="image/png" href="img/1/1.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="img/1/1.png">

    <!-- Bootstrap (igual que en tu original) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tu CSS (mantén la ruta) -->
    <link rel="stylesheet" href="style/style.css">
    
</head>
<body>

    <header>
        <nav>
            <div class="logo">
                <img src="img/1.1.png" alt="Logo DisciTrack">
                <span>DisciTrack</span>
            </div>
            <!-- Botón hamburguesa (aria + control) -->
            <button class="hamburger-menu" aria-label="Abrir menú de navegación" aria-controls="main-nav" aria-expanded="false" id="hamburgerBtn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>

            <ul class="nav-links" id="main-nav">
                <li><a href="index.php#Inicio">Inicio</a></li>
                <li><a href="index.php#Servicios">Servicios</a></li>
                <li><a href="index.php#Nosotros">Nosotros</a></li>
                <li><a href="index.php#Contáctanos">Contáctanos</a></li>
                <li class="li-login">
                    <a href="pages/iniciarsesion.php" aria-label="Iniciar sesión">
                        <button class="btn-login" type="button">Iniciar Sesión</button>
                    </a>
                </li>
            </ul>
        </nav>
    </header>


    <section class="hero-section" id="Inicio">
        <div class="hero-content">
            <h1>Información Detallada</h1>
            <p>Este aplicativo web permite registrar, gestionar y hacer seguimiento a los procesos disciplinarios de estudiantes dentro de una Institución Educativa. Facilita la organización de reportes, evidencias, y sanciones, promoviendo una convivencia escolar justa y ordenada.</p>
        </div>

        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/1.1.png" class="d-block w-100" alt="Imagen 1">
                </div>
                <div class="carousel-item">
                    <img src="img/disciplina.jpg" class="d-block w-100" alt="Disciplina">
                </div>
                <div class="carousel-item">
                    <img src="img/3.jpg" class="d-block w-100" alt="Imagen 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <section class="services-section" id="Servicios">
        <h2>Servicios</h2>
        <div class="services-content-wrapper">
            <div class="services-text-container">
                <p>Ofrecemos soluciones integrales para la gestión de procesos disciplinarios en Instituciones Educativas y organizaciones. Nuestros servicios incluyen el registro, seguimiento y control de casos disciplinarios, garantizando transparencia, confidencialidad y cumplimiento normativo. Facilitamos la toma de decisiones a través de informes detallados, alertas automáticas y acceso seguro para los diferentes actores involucrados.</p>
            </div>
            <div class="services-image-container">
                <img src="img/3.jpg" alt="Escudo de Justicia con Balanza y Check">
            </div>
        </div>
    </section>

    <section class="perfiles-section" id="Nosotros">
        <h2>Conoce a Nuestro Equipo</h2>
        <div class="perfiles-grid">
            <div class="perfil-container">
                <div class="imagen-perfil">
                    <img src="./img/yo.jpeg" alt="Foto de Cristian Portilla">
                </div>
                <div class="info-perfil">
                    <p class="nombre-perfil">Cristian Portilla</p>
                    <p class="rol-perfil">Diseñador</p>
                    <p>Encargado de que el aplicativo web luzca bien, que esté organizado y de darle diseños agradables</p>
                </div>
            </div>

            <div class="perfil-container">
                <div class="imagen-perfil">
                    <img src="img/y.jpg" alt="Foto de Juan José Giraldo Marín">
                </div>
                <div class="info-perfil">
                    <p class="nombre-perfil">Juan José Giraldo Marín</p>
                    <p class="rol-perfil">Líder - Desarrollador Principal</p>
                    <p>El desarrollador principal es el responsable clave de la lógica y funcionalidad del backend, asegurando la operación de la aplicación.</p>
                </div>
            </div>

            <div class="perfil-container">
                <div class="imagen-perfil">
                    <img src="img/a.jpg" alt="Foto de Alex López">
                </div>
                <div class="info-perfil">
                    <p class="nombre-perfil">Alex López</p>
                    <p class="rol-perfil">Desarrollador Secundario</p>
                    <p>Verifica que las líneas de código no tengan errores.</p>
                </div>
            </div>

            <div class="perfil-container">
                <div class="imagen-perfil">
                    <img src="img/g.jpg" alt="Foto de Alejandro Alzate">
                </div>
                <div class="info-perfil">
                    <p class="nombre-perfil">Alejandro Alzate</p>
                    <p class="rol-perfil">Especialista en Datos</p>
                    <p>Analiza la información y genera informes detallados.</p>
                </div>
            </div>
        </div>

        <div class="mision-vision-wrapper">
            <div class="mision-container">
                <h3>Misión</h3>
                <p>Ofrecer una plataforma digital integral e intuitiva que simplifique y optimice la gestión de procesos disciplinarios en la Institución Educativa Francisco Miranda y organizaciones, garantizando la transparencia, la equidad y el cumplimiento normativo, para fomentar un ambiente escolar y organizacional justo, seguro y propicio para el desarrollo integral de todos.</p>
            </div>
            <div class="vision-container">
                <h3>Visión</h3>
                <p>Ser la solución líder y referente en la gestión disciplinaria a nivel nacional e internacional, reconocida por nuestra innovación tecnológica, la excelencia en el servicio y nuestro impacto positivo en la construcción de comunidades educativas y laborales más armoniosas y responsables.</p>
            </div>
        </div>
    </section>

    <section class="contact-section" id="Contáctanos">
        <h2>Contáctanos</h2>
        <form action="#" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombres">Nombres Completos</label>
                    <input type="text" id="nombres" name="nombres" placeholder="Nombres" required>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos Completos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                </div>
            </div>
            <div class="form-group full-width">
                <label for="email">Correo Electrónico o Número de Celular</label>
                <input type="text" id="email" name="email" placeholder="Email@gmail.com o 3001234567" required>
            </div>
            <div class="form-group full-width">
                <label for="mensaje">Describe el Problema</label>
                <textarea id="mensaje" name="mensaje" rows="5" placeholder="Mensaje" required></textarea>
            </div>
            <button type="submit" class="btn-submit">Enviar</button>
        </form>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img/1.1.png" alt="DisciTrack Logo Footer">
                <span>DisciTrack</span>
            </div>
            <div class="footer-links">
                <h3>Navegación</h3>
                <ul>
                    <li><a href="index.php#Inicio">Inicio</a></li>
                    <li><a href="index.php#Servicios">Servicios</a></li>
                    <li><a href="index.php#Nosotros">Nosotros</a></li>
                    <li><a href="index.php#Contáctanos">Contáctanos</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contacto</h3>
                <p>Email: info@disciplinapp.com</p>
                <p>Teléfono: +57 123 4567890</p>
                <p>Dirección: Calle 123 #45-67, Medellín, Colombia</p>
            </div>
            <div class="footer-social">
                <h3>Síguenos</h3>
                <div class="social-icons">
                    <a href="#"><img src="img/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="img/twitter.png" alt="Twitter"></a>
                    <a href="https://www.instagram.com/kennedy_zzz_/"><img src="img/instagram.png" alt="Instagram"></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 DisciTrack. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- JS de Bootstrap (igual que tu original) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Tu JS (reemplaza ./js/script.js con este contenido en tu proyecto) -->
    <script src="./js/script.js"></script>
</body>
</php>
<wrap></wrap>