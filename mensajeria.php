<?php
session_start();

include 'conexion.php';
$conn = Conexion::ConexionBD();

if (isset($_SESSION['correo_doctor'])) {
    $correo_doctor = $_SESSION['correo_doctor'];

    $sql = "SELECT * FROM doctor WHERE correo = '$correo_doctor'";
    $result = $conn->query($sql);

    if ($result) {
        $doctor = $result->fetch(PDO::FETCH_ASSOC);
        $id_doctor = $doctor['id_doctor'];

        $sqlMensajesEnviados = "SELECT m.*, p.nombre, p.apellido 
                                FROM mensaje m
                                INNER JOIN paciente p ON m.id_receptor = p.id_paciente
                                WHERE m.id_emisor = $id_doctor";

        $resultMensajesEnviados = $conn->query($sqlMensajesEnviados);

        if ($resultMensajesEnviados) {
            $mensajesEnviados = $resultMensajesEnviados->fetchAll(PDO::FETCH_ASSOC);
        } else {
      
            $errorInfoMensajes = isset($conn) ? $conn->errorInfo() : null;
            echo "Error al obtener los mensajes enviados: " . ($errorInfoMensajes ? $errorInfoMensajes[2] : "No se pudo obtener información del error");
        }

    } else {
       
        $errorInfo = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del error");
    }

    $sqlPacientes = "SELECT id_paciente, nombre, apellido FROM paciente";
    $resultPacientes = $conn->query($sqlPacientes);


    if ($resultPacientes) {
        $pacientes = $resultPacientes->fetchAll(PDO::FETCH_ASSOC);
    } else {
   
        $errorInfoPacientes = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfoPacientes ? $errorInfoPacientes[2] : "No se pudo obtener información de los pacientes");
    }


} else {
  
    header("Location: login_doctor.html");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TechMedic - Mensajería</title>

    <script src="https://kit.fontawesome.com/c2b1422a44.js" crossorigin="anonymous"></script>

   
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

   
    <div id="wrapper">

    
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="inicio_doctor.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="logo_only.png" alt="TechMedic Logo" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3">TechMedic</div>
            </a>

         
            <hr class="sidebar-divider my-0">

           
            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>Sobre Mi</span></a>
            </li>

            
            <hr class="sidebar-divider">

          
            <li class="nav-item">
                <a class="nav-link" href="pacientes.php">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Pacientes</span>
                </a>
            </li>

        
            <li class="nav-item">
                <a class="nav-link" href="citas.php">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Citas</span>
                </a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link" href="historial_clinico.php">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Historial Clínico</span>
                </a>
            </li>

           
            <li class="nav-item active">
                <a class="nav-link" href="mensajeria.php">
                    <i class="fa-regular fa-envelope"></i>
                    <span>Mensajería</span>
                </a>
            </li>

          
            <li class="nav-item">
                <a class="nav-link" href="calendar.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Calendario</span></a>
            </li>

          
            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Permisos</span></a>
            </li>

            
            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Informaciones</span></a>
            </li>

        </ul>
        
        <div id="content-wrapper" class="d-flex flex-column">

       
            <div id="content">

                
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>


                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas las notificaciones</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Centro de Mensajes
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Leer otros mensajes</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                       <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dr. <?php echo $doctor['nombre'] . ' ' . $doctor['apellido']; ?>  </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil_doctor.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="configuracion_doctor.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuración
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Mensajes Enviados</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID Mensaje</th>
                                                    <th>Fecha Envío</th>
                                                    <th>Destinatario</th>
                                                    <th>Contenido</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($mensajesEnviados as $mensajeEnviado) : ?>
                                                    <tr>
                                                        <td><?= $mensajeEnviado['id_mensaje'] ?></td>
                                                        <td><?= $mensajeEnviado['fecha_envio'] ?></td>
                                                        <td><?= $mensajeEnviado['nombre'] . ' ' . $mensajeEnviado['apellido'] ?></td>
                                                        <td><?= $mensajeEnviado['contenido'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Nuevo Mensaje</h5>
                                <form action="enviar_mensaje.php" method="POST">
                                    <div class="form-group">
                                        <label for="recipient">Para:</label>
                                        <select class="form-control" id="recipient" name="id_receptor">
                                            <?php foreach ($pacientes as $paciente) : ?>
                                                <option value="<?= $paciente['id_paciente'] ?>">
                                                    <?= $paciente['id_paciente'] . ' - ' . $paciente['nombre'] . ' ' . $paciente['apellido'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Mensaje:</label>
                                        <textarea class="form-control" id="message" name="contenido" rows="3" placeholder="Escribe tu mensaje aquí"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
