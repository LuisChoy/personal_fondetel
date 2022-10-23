<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios Registrados</title>
    
<?php
    require_once('../sistema/scripts.php');
    require_once('../sistema/Templates/header.php');
    include('../conexion.php');
 

    ?>
</head>
<body>
<div class="container-fluid py-3 ">
        <div class="row">
            <div class="col align-self-center">
                <h4> Usuarios Registrados
                <a href="registro_usuario.php" class="btn btn-success">Registrar Usuarios</a>
                </h4>
                <table class="table table-striped table-ligth table-bordered ">
                    <thead class="fs-6">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>CORREO</th>
                            <th>USUARIO</th>
                            <th>ROL</th>
                            <th>ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $todosUsuarios =mysqli_query($conection, "SELECT usuarios.idusuario,
                        usuarios.nombre,
                        usuarios.correo,
                        usuarios.usuario,
                        usuarios.rol AS idRol,
                        roles.rol
                        FROM usuarios INNER JOIN roles ON usuarios.rol = roles.idrol AND estatus = 1"  );
                             mysqli_close($conection);
                        $result = mysqli_num_rows($todosUsuarios);
                        if($result>0){

                            while($data = mysqli_fetch_array($todosUsuarios)){
                               
                        ?>
                                <tr class="fw-normal">
                                    <td><?= $data['idusuario']; ?></td>
                                    <td><?= $data['nombre']; ?></td>
                                    <td><?= $data['correo']; ?></td>
                                    <td><?= $data['usuario']; ?></td>
                                    <td><?= $data['rol']; ?></td>
                                    

                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic">
                                           
                                            <a href="editar_usuarios.php?idusuario=<?= $data['idusuario']; ?>" class="btn btn-primary bi bi-pencil-square">Editar</a>
                                            <br>
                                            <?php 
                                            if($data['idRol']!=1){
                                            
                                            ?>
                                            <a href="eliminar_usuario.php?idusuario=<?= $data['idusuario']; ?>" class="btn btn-danger bi bi-trash ">Eliminar</a>
                                             <?php 
                                             }
                                             ?>       
                                        </div>

                                    </td>
                                </tr>
                        <?php
           
                            }

                        } else {


                            echo "<h5>No hay datos registrados</h5>";
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>


    </div>
<?php


 


 
 
   /* if (!isset($_POST['guardar_usuario'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';    
    }else{
        $nombre = mysqli_real_escape_string($conection, $_POST['nombre']);
        $correo = mysqli_real_escape_string($conection, $_POST['correo']);
        $usuario = mysqli_real_escape_string($conection, $_POST['usuario']);
        $clave = md5(mysqli_real_escape_string($conection, $_POST['clave']));
        $rol = mysqli_real_escape_string($conection, $_POST['rol']);


        $query = "INSERT INTO usuarios (nombre,correo,usuario,clave,rol) VALUES ('$nombre','$correo','$usuario','$clave','$rol')";
        $query_run = mysqli_query($conection, $query);

        if ($query_run) {
            $_SESSION['message'] = "Estudiante creado correctamente";
            header("Location:registro_usuario.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Estudiante no fue creado";
            header("Location: registro_usuario.php");
            exit(0);
        }

    }*/
?>    


<div class="container-fluid">

<?php

require_once('./Templates/footer.php');

?>

</div>


</body>
</html>
