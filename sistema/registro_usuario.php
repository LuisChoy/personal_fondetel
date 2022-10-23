<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('../sistema/scripts.php');

    require_once('../sistema/Templates/header.php');
    include('../conexion.php');

    // funcion guardar
    if (!empty($_POST)) {
        $alert = '';
        if (
            empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) ||
            empty($_POST['clave']) || empty($_POST['rol'])
        ) {
            $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
        } else {


            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $usuario = $_POST['usuario'];
            $clave = md5($_POST['clave']);
            $rol = $_POST['rol'];

            /* $nombre = mysqli_real_escape_string($conection, $_POST['nombre']);
                    $correo = mysqli_real_escape_string($conection, $_POST['correo']);
                    $usuario = mysqli_real_escape_string($conection, $_POST['usuario']);
                    $clave = md5(mysqli_real_escape_string($conection, $_POST['clave']));
                    $rol = mysqli_real_escape_string($conection, $_POST['rol']);*/

            $query = mysqli_query($conection, "SELECT * FROM  usuarios 
                                                 WHERE usuario ='$usuario' OR correo ='$correo'");

            $result = mysqli_fetch_array($query);

            if ($result > 0) {

                $alert = '<p class="msg_error">El correo o Usuario ya estan Registrados</p>';
            } else {
                $query_insert  = mysqli_query($conection, "INSERT INTO usuarios (nombre,correo,usuario,clave,rol,estatus) 
                                                  VALUES ('$nombre','$correo','$usuario','$clave','$rol',1)");
                //print_r(array($query_insert));
                if ($query_insert) {
                    $alert = '<p class="msg_save">Usuario Registrado Correctamente</p>';
                    // header("Location: listado_usuarios.php");
                    //exit(0);
                } else {
                    $alert = '<p class="msg_error">Error al crear el usuario.</p>';
                }
            }
        }
    }

    //fin funcion guardar


    ?>
    <title>Registrar Usuarios</title>

</head>

<body>
    <div class="container py-3">
        <div class="row ">
            <div class="col align-self-center">
                <div class="form_register">
                    <h4>Registrar Usuarios</h4>
                    <hr>
                    <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

                    <form action="" method="POST">
                        <label for="Nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" placeholder="Correo Electrónico">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                        <label for="clave">Contraseña</label>
                        <input type="password" name="clave" id="clave" placeholder="Contraseña">
                        <label for="rol">Tipo Usuario</label>
                        <?php
                        $query_rol = mysqli_query($conection, "SELECT * FROM roles");
                        mysqli_close($conection);
                        $result_rol = mysqli_num_rows($query_rol);


                        ?>

                        <select name="rol" id="rol">
                            <?php
                            if ($result_rol > 0) {

                                while ($rol = mysqli_fetch_array($query_rol)) {
                            ?>
                                    <option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol'] ?></option>

                            <?php


                                }
                            }

                            ?>

                        </select>
                        <hr>

                        <div class="d-grid gap-2">
                            <button type="submit" name="guardar_usuario" class="btn btn-success">Registrar Usuario</button>
                            <a href="listado_usuarios.php" class="btn btn-danger float-end">Usuarios Registrados</a>
                        </div>


                    </form>

                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">

        <?php

        require_once('./Templates/footer.php');

        ?>

    </div>



</body>


</html>