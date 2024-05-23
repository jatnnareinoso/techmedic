<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/login.css">
    <title>Inicio Sesión TechMedic</title>
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1>Crea tu cuenta</h1>
                <span>Selecciona el tipo de cuenta a crear.</span>
                <a href="registerDoctor.php"><button type="button">Doctor</button></a>
                <a href="registerPatient.php"><button type="button">Paciente</button></a>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="login_doctor.php" method="POST">
                <h1>Ingresa a tu cuenta</h1>
                <span>Con tu email y contraseña ingresa nuevamente.</span>
                <input type="email" name="correo" placeholder="Email"/>
                <input type="password" name="pass" placeholder="Contraseña"/>
                <a href="#">¿Olvidó su contraseña?</a>
 
                <button>Ingresa</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img src="IMG/logo.png" style="width: 110px; margin-bottom: 15px;" alt="logo">
                    <h1>¡Bienvenido a TechMedic!</h1>
                    <p>¡Ingresa sesión con tu cuenta personal para usar todo lo que tiene TechMedic para ti!</p>
                    <button class="hidden" id="login">Inicia Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="IMG/logo.png" style="width: 110px; margin-bottom: 15px;" alt="logo">
                    <h1>¡Bienvenido a TechMedic!</h1>
                    <p>Si todavía no tienes una cuenta creada. ¿Qué esperas para hacerlo?</p>
                    <button class="hidden" id="register">Registrate</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
