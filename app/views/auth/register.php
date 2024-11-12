<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../assets/css/Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="/PARCIAL_4_DSW7/public/icono.png" type="image/png">

    <title>Biblioteca</title>
</head>

<body>

    <div id="registerContainer">
        <div class="register-container">
            <h2>Registro</h2>
            <form action="../../../public/register.php" class="form" method="POST">
                <div class="mb-3">
                    <label class="form-label" for="name">Nombre Completo:</label>
                    <input type="text" id="name" clas="form-control" placeholder="Ingrese su Nombre Completo"  name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Correo Electrónico:</label>
                    <input type="email" id="email" clas="form-control" placeholder="Ingrese su correo" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Contraseña:</label>
                    <input type="password" id="password" clas="form-control" name="password" placeholder="Ingrese su Contraseña" required>
                </div>
                <div style="margin-top: 20px;">
                    <p>¿ Tienes una cuenta? <a href="../../../index.php">Iniciar Sesion aquí</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>
        </div>
    </div>

    <?php include_once '../layout/footer.php'; ?>