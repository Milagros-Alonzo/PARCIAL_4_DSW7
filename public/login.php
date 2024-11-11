<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Iniciar Sesión">
    </form>
    <div style="margin-top: 20px;">
        <p>¿No tienes una cuenta? <a href="../app/views/auth/login.php">Regístrate aquí</a></p>
    </div>
    <div style="margin-top: 20px;">
        <?php include __DIR__ . '/../app/oauth/sesion_GoogleOauth.php'; ?>
    </div>
</div>