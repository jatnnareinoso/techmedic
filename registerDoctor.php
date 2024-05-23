<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="CSS/rgDoctor.css">
    <title>Registro Doctor</title>
</head>
<body>
    <div class="container">
        <header>Registro Doctor</header>

        <form action="registro_doctor.php" method="POST" id="registrationForm">
            <div class="form first">
                <div class="details personal">
                    <span class="title">Detalles Personales</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Nombre</label>
                            <input type="text" name="nombre" placeholder="Ingrese su nombre" required>
                        </div>

                        <div class="input-field">
                            <label>Apellido</label>
                            <input type="text" name="apellido" placeholder="Ingrese su apellido" required>
                        </div>

                        <div class="input-field">
                            <label>Fecha de Nacimiento</label>
                            <input type="date" name="fecha_nacimiento" placeholder="Ingrese su fecha de nacimiento" required>
                        </div>

                        <div class="input-field">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo" placeholder="Ingrese correo electrónico" required>
                        </div>

                        <div class="input-field">
                            <label for="gender">Sexo</label>
                            <select id="gender" name="sexo" required>
                                <option value="" disabled selected>Seleccione su sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro...</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" placeholder="Ingresa su teléfono" required>
                        </div>    
                    </div>
                </div>

                <div class="details ID">
                    <span class="title">Documentación</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Número de Identidad</label>
                            <input type="number" name="cedula" placeholder="Ingrese número de indentidad" required>
                        </div>

                        <div class="input-field">
                            <label>Número de Colegiatura</label>
                            <input type="number" name="colegiatura" placeholder="Ingrese su número de colegio médico" required>
                        </div>

                        <div class="input-field">
                            <label for="specialty">Especialidad</label>
                            <select id="id_especialidad" name="id_especialidad" required>
                            <option value="" disabled selected>Seleccione su especialidad</option>
                            <?php
                                include 'conexion.php';
                                $conn = Conexion::ConexionBD();

                                $queryEspecialidades = "SELECT id_especialidad, especialidad FROM especialidad";
                                $resultEspecialidades = $conn->query($queryEspecialidades);

                                if (!$resultEspecialidades) {
                                    echo "Error en la consulta: " . $conn->errorInfo()[2];
                                } else {
                                    while ($row = $resultEspecialidades->fetch(PDO::FETCH_ASSOC)) {
                                        echo '<option value="' . $row["id_especialidad"] . '">' . $row["especialidad"] . '</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Lugar de Trabajo</label>
                            <input type="text" name="lugar_trabajo" placeholder="Ingrese lugar de trabajo" required>
                        </div>

                        <div class="input-field">
                            <label for="specialty">Seguro Médico</label>
                            <input type="text" name="seguro" placeholder="Ingrese su seguro médico" required>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="details education">
                    <span class="title">Educación</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Estudios Secundarios</label>
                            <input type="text" name="estudio_sec" placeholder="Ingrese la institución" required>
                        </div>

                        <div class="input-field">
                            <label>Estudios Universitarios</label>
                            <input type="text" name="universidad" placeholder="Ingrese la institución" required>
                        </div>

                        <div class="input-field">
                            <label>Especialidad</label>
                            <input type="text" name="especialidad_uni" placeholder="Ingrese la institución" required>
                        </div>

                        <div class="input-field">
                            <label>Titulos / Certificados</label>
                            <input type="text" name="titulo" placeholder="Ingrese sus titulos y certificados" required>
                        </div>

                        <div class="input-field">
                            <label>Cursos</label>
                            <input type="text" name="curso" placeholder="Ingrese cursos realizados" required>
                        </div>

                        <div class="input-field">
                            <label>Experiencia Laboral</label>
                            <input type="text" name="experiencia" placeholder="Ingresa su experiencia laboral" required>
                        </div>    
                    </div>
                </div>

                <div class="details direction">
                    <span class="title">Dirección</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Nacionalidad</label>
                            <input type="text" name="nacionalidad" placeholder="Ingrese la nacionalidad" required>
                        </div>

                        <div class="input-field">
                            <label>Provincia</label>
                            <input type="text" name="provincia" placeholder="Ingrese la provincia" required>
                        </div>

                        <div class="input-field">
                            <label>Ciudad</label>
                            <input type="text" name="ciudad" placeholder="Ingrese la ciudad" required>
                        </div>

                        <div class="input-field">
                            <label>Dirección</label>
                            <input type="text" name="direccion" placeholder="Ingrese su dirección" required>
                        </div>
                    </div>
                </div>

                <div class="details password">
                    <span class="title">Detalles Contraseña</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Contraseña</label>
                            <input type="password" name="pass" id="password" placeholder="Ingrese la contraseña" required>
                        </div>

                        <div class="input-field">
                            <label>Confirmar Contraseña</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirmar contraseña" required>
                        </div>
                    </div>

                    <p id="passwordError" style="color: red;"></p>
                    
                    <div class="alert">
                        <p>Al hacer clic en Registrarse, aceptas nuestros <a href="a">Términos</a>, <a href="a"> Políticas de Privacidad</a> y
                            <a href="a"> Políticas de Cookies. </a>Puede recibir nuestras notificaciones por SMS y puede optar por no participar en cualquier momento.</p> 
                    </div>
    
                    <div class="button-container" type="submit">
                        <button type="btntext">Registrarse</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const form = document.getElementById("registrationForm");
            const passwordInput = document.getElementById("password");
            const confirmPasswordInput = document.getElementById("confirmPassword");
            const passwordError = document.getElementById("passwordError");

            confirmPasswordInput.addEventListener("blur", function () {
                if (confirmPasswordInput.value !== passwordInput.value) {
                    passwordError.textContent = "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
                } else {
                    passwordError.textContent = ""; 
                }
            });

            form.addEventListener("submit", function (event) {
                const password = passwordInput.value;
                const hasUpperCase = /[A-Z]/.test(password);
                const hasLowerCase = /[a-z]/.test(password);
                const hasNumber = /\d/.test(password);
                const hasValidLength = password.length >= 8;

                let errorMessages = [];

                if (!hasUpperCase) {
                    errorMessages.push("La contraseña debe tener al menos una mayúscula.");
                }

                if (!hasLowerCase) {
                    errorMessages.push("La contraseña debe tener al menos una minúscula.");
                }

                if (!hasNumber) {
                    errorMessages.push("La contraseña debe tener al menos un número.");
                }

                if (!hasValidLength) {
                    errorMessages.push("La contraseña debe tener al menos 8 caracteres de longitud.");
                }

                if (confirmPasswordInput.value !== password) {
                    errorMessages.push("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
                }

                if (errorMessages.length > 0) {
                    passwordError.textContent = errorMessages.join(" ");
                    event.preventDefault(); 
                } else {
                    passwordError.textContent = ""; 
                }
            });
        });
    </script>
</body>
</html>
