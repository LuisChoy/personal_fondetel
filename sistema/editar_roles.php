<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <?php
    require_once('../sistema/scripts.php');
    require_once('../sistema/Templates/header.php');
    include('../conexion.php');

    // funcion guardar
    if (!empty($_POST))
    {
        $alert = '';
        if(empty($_POST['nombre'])|| empty($_POST['correo'])|| empty($_POST['usuario'])||
            empty($_POST['rol']))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';

        }else
            $idusuario = $_POST['idUsuario'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];

        $query = mysqli_query($conection,"SELECT * FROM  usuarios 
                                                  WHERE (usuario ='$idusuario' AND idusuario !='$idusuario')
                                                  OR (correo ='$correo' AND idusuario != '$idusuario')");


        $result = mysqli_fetch_array($query);

        if($result>0){

            $alert='<p class="msg_error">El correo o Usuario ya estan Registrados</p>';

        }else{

            if(empty($_POST['clave']))
            {
                $sql_update = mysqli_query($conection," UPDATE usuarios
                                                                    SET  nombre ='$nombre', correo='$correo', usuario ='$usuario',
                                                                    rol='$rol'
                                                                     WHERE idusuario = '$idusuario'");

            }else{

                $sql_update = mysqli_query($conection,"UPDATE usuarios
                                                            SET  nombre ='$nombre', correo='$correo', usuario ='$usuario', clave='$clave',
                                                            rol='$rol' WHERE idusuario = '$idusuario'");
            }



            if($sql_update){
                $alert='<p class="msg_save">Usuario Actualizado Correctamente</p>';
                // header("Location: listado_usuarios.php");
                //exit(0);
            }else{
                $alert='<p class="msg_error">Error al actualizar el usuario.</p>';
            }
        }

    }

    //fin funcion guardar
    //inicio funcion actualizar
    if(empty($_GET['idusuario']))
    {
        header('Location:listado_usuarios.php');
    }
    $iduser = $_GET['idusuario'];
    $usuarioObtenido = mysqli_query($conection,"SELECT usuarios.idusuario,
                                        usuarios.nombre,
                                        usuarios.correo,
                                        usuarios.usuario,
                                        usuarios.rol AS idRol,
                                        roles.rol AS nombreRol
                                        FROM usuarios INNER JOIN roles
                                        ON usuarios.rol = roles.idrol
                                        WHERE idusuario= $iduser");

    $result_sql = mysqli_num_rows($usuarioObtenido);
    if ($result_sql ==0){

        header('Location:listado_usuarios.php');

    }else{
        $option='';
        while ($data = mysqli_fetch_array($usuarioObtenido)){
            $iduser = $data['idusuario'];
            $nombreUserlist = $data['nombre'];
            $correoUserlist = $data['correo'];
            $userlist = $data['usuario'];
            $idrol = $data['idRol'];
            $nombreRolUser = $data['nombreRol'];
            if($idrol ==1){
                $option = '<option value="'.$idrol.'">'.$nombreRolUser.'</option>';
            }else if($idrol ==2){

                $option = '<option value="'.$idrol.'">'.$nombreRolUser.'</option>';

            }else if($idrol ==3){

                $option = '<option value="'.$idrol.'">'.$nombreRolUser.'</option>';
            }

        }
    }

    //fin funcion actualizar

    ?>
    <title>Actualizar Usuarios</title>

</head>

<body>
<div class="container py-3">
    <div class="row ">
        <div class="col align-self-center">
            <div class="form_register">
                <h4>Actualizar Usuarios</h4>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>

                <form action="" method="POST">
                    <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>">
                    <label for="Nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombreUserlist;?>">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo Electrónico" value="<?php echo $correoUserlist; ?>">
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $userlist; ?>">
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave" id="clave" placeholder="Contraseña">
                    <label for="rol">Tipo Usuario</label>
                    <?php
                    $query_rol = mysqli_query($conection,"SELECT * FROM roles");
                    $result_rol = mysqli_num_rows($query_rol);


                    ?>

                    <select name="rol" id="rol" class="notItemOne">
                        <?php
                        echo $option;
                        if ($result_rol>0){

                            while ($rol=mysqli_fetch_array($query_rol)){
                                ?>
                                <option value="<?php echo $rol['idrol']; ?>"><?php echo $rol['rol'] ?></option>

                                <?php


                            }
                        }

                        ?>

                    </select>
                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" value="Actualizar Usuario" class="btn btn-success">Actualizar Usuario</button>

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