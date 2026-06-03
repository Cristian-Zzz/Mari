<!DOCTYPE html>
<php lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - DisciTrack</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/1.1.png"> <!-- Ruta ajustada -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <link rel="stylesheet" href="../style/registro.css">
    <!-- Si tienes un archivo CSS global para la navegación, enlaza aquí.
         Por simplicidad, he incluido todo el CSS de la navegación en registro.css. -->
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
                    <a href="../pages/iniciarsesion.php" aria-label="Registrarse">
                        <button class="btn-login" type="button">iniciar Sesion</button>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <!-- Contenedor principal para centrar el formulario de registro -->
    <main class="content-wrapper">
        <div class="register-container">
            <div class="register-header">
                <a href="../index.php"><img src="../img/1.1.png" alt="DisciTrack Logo"></a> <!-- Ruta ajustada -->
                <h2>Crear Cuenta</h2>
            </div>
            <form class="register-form" action="../../Controlador/php/registro.php" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" placeholder="Tu apellido" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@gmail.com" required>
                </div>

                <div class="form-group full-width">
                    <label for="idTipoDoc">Tipo de Documento</label>
                    <select id="idTipoDoc" name="idTipoDoc" required>
                        <option selected disabled>Seleccione el tipo de Documento</option>
                        <option value="1">Cédula de Ciudadanía</option>
                        <option value="2">Tarjeta de Identidad</option>
                        <option value="3">Pasaporte</option>
                        <option value="4">PPT</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="identificacion">Número de Documento</label>
                    <input type="text" id="identificacion" name="identificacion" placeholder="Ej: 1234567890" required>
                </div>

                <div class="form-group full-width">
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular" placeholder="Ej: 3001234567" required>
                </div>

                <div class="form-group full-width">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Mínimo 8 caracteres" required>
                </div>

                <div class="form-group full-width">
                    <label for="confirm_password">Confirmar Contraseña</label>
                    <input type="password" id="confirm_password" name="confirm_password"
                        placeholder="Repite tu contraseña" required>
                </div>

                <button type="submit" class="btn-register-page">Registrarse</button>
                <p class="login-link">¿Ya tienes cuenta? <a href="../pages/iniciarsesion.php">Inicia sesión aquí</a>
                </p>
            </form>

        </div>
    </main>
    <script src="../js/registro.js"></script>
</body>

</php>