<!DOCTYPE html>
<php lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - DisciTrack</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/1.1.png"> <!-- Ruta ajustada -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <link rel="stylesheet" href="../style/iniciarsesion.css">
    <!-- Si tienes un archivo CSS global para la navegación, enlaza aquí. 
    Por simplicidad, he incluido todo el CSS de la navegación en iniciarsesion.css. -->
</head>
<body>
    <!-- Barra de navegación integrada -->
    <header>
        <nav>
            <div class="logo">
                <img src="../img/1.1.png" alt="Logo DisciTrack">
                <span>DisciTrack</span>
            </div>
            <!-- Botón hamburguesa (aria + control) -->
            <button class="hamburger-menu" aria-label="Abrir menú de navegación" aria-controls="main-nav" aria-expanded="false" id="hamburgerBtn">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </button>

            <ul class="nav-links" id="main-nav">
                <li><a href="../index.php#Inicio">Inicio</a></li>
                <li><a href="../index.php#Servicios">Servicios</a></li>
                <li><a href="../index.php#Nosotros">Nosotros</a></li>
                <li><a href="../index.php#Contáctanos">Contáctanos</a></li>
                <li class="li-login">
                    <a href="../pages/registro.php" aria-label="Registrarse">
                        <button class="btn-login" type="button">Registrarse</button>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Contenedor principal para centrar el formulario de login -->
    <main class="content-wrapper">
        <div class="login-container">
            <div class="login-header">
                <a href="../index.php"><img src="../img/1.1.png" alt="DisciTrack Logo"></a> <!-- Ruta ajustada -->
                <h2>Iniciar Sesión</h2>
            </div>
            <form class="login-form" action="../../Controlador/login.php" method="POST">
                <div class="form-group">
                    <label for="username">Correo Electrónico</label>
                    <input type="email" id="username" name="username" placeholder="Tu correo" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                </div>
                <button type="submit" class="btn-login-page" name="login">Ingresar</button>
                <a class="forgot-password"><a href="#">¿Olvidaste tu contraseña?</a></a>
                <a class="register-link">¿No tienes cuenta? <a href="../pages/registro.php">Regístrate aquí</a></a>
            </form>
        </div>
    </main>
    <script src="../js/iniciarsesion.js"></script>
</body>
</php>
