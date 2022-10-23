<?php
session_start();
if (empty($_SESSION['active'])) {

    header('location: ../');
}

?>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="/css/estilos.css">
<header>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a class="navbar-brand p-3" href="#">Recursos Humanos</a>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Reportes</a>
                </li>
                <li class="nav-item">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Configuraciónes
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                           <a href="registro_departamentos.php"><button class="dropdown-item" type="button">Departamentos</button></a>
                           <a href="registro_puestos.php"><button class="dropdown-item" type="button">Puestos</button></a>
                           <a href="registro_empleados.php"><button class="dropdown-item" type="button">Empleados</button></a>
                            <button class="dropdown-item" type="button">Estudios Academicos</button>
                            <button class="dropdown-item" type="button">Estados</button>
                            <button class="dropdown-item" type="button">Contratos</button>
                            <a href="./registro_usuario.php"><button class="dropdown-item" type="button">Registro de Usuarios</button></a>
                            
                            <a class="btn btn-primary dropdown-toggle " href="#" id="navbarDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Configuraciones Varias</a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="./roles.php"><button class="dropdown-item" type="button">Rol de Usuarios</button></a>
                                <a href="./registro_renglones.php"><button class="dropdown-item" type="button">Renglones de Contratos</button></a>
                                </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Listado de Registros
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="listado_usuarios.php"> <button class="dropdown-item" type="button">Usuarios Registrados</button></a>
                            <a href="listado_deptos.php"> <button class="dropdown-item" type="button">Departamentos Registrados</button></a>
                            <a href="listado_puestos.php"> <button class="dropdown-item" type="button">Puestos Registrados</button></a>

                        </div>
                    </div>
                </li>
            </div>
         </ul>
    </div>

        <button type="button" class="btn btn-primary"><?php echo $_SESSION['user']; ?></button>
        <img src="../img/user.png" class="rounded" alt="usuario">
        <a id="navbar-login" href="./salir.php"><button type="button" class="btn btn-warning btn-sm">Salir</button></a>
    </nav>

</header>