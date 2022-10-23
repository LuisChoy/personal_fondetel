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
    if (!empty($_POST))
    {
        $alert = '';
            if(empty($_POST['nombredepartamento'])|| empty($_POST['entidad']))
            {
                $alert='<p class="msg_error">Todos los campos son obligatorios</p>';
                
                }else{

                    $nombre =($_POST['nombredepartamento']);
                    $entidadid = ($_POST['entidad']);
                    
                   /* $nombre = mysqli_real_escape_string($conection, $_POST['nombre']);
                    $correo = mysqli_real_escape_string($conection, $_POST['correo']);
                    $usuario = mysqli_real_escape_string($conection, $_POST['usuario']);
                    $clave = md5(mysqli_real_escape_string($conection, $_POST['clave']));
                    $rol = mysqli_real_escape_string($conection, $_POST['rol']);*/
                
                $query = mysqli_query($conection,"SELECT * FROM  departamentos 
                                                 WHERE nombredepto ='$nombre' AND identidad ='$entidadid'");
                $result = mysqli_fetch_array($query);
                
                if($result>0){

                    $alert='<p class="msg_error">El correo o Usuario ya estan Registrados</p>';
                }else{
                    $query_insert  = mysqli_query($conection,"INSERT INTO departamentos (nombredepto,identidad) 
                                                  VALUES ('$nombre','$entidadid')");
                    //print_r(array($query_insert));
                    if($query_insert){
                      $alert='<p class="msg_save">Departamento Registrado Correctamente</p>';
                     // header("Location: listado_usuarios.php");
                      //exit(0);
                    }else{
                        $alert='<p class="msg_error">Error al crear el Departamento.</p>';
                    }
                }

           }

    }

    //fin funcion guardar


    ?>
    <title>Registrar Direcciones o Unidades</title>
    
</head>

<body>
    <div class="container py-3">
        <div class="row ">
            <div class="col align-self-center">
                <div class="form_register">
                    <h4>Registrar Direcciones o Unidades</h4>
                    <hr>
                    <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>

                    <form action="" method="POST">
                        <label for="Nombre">Nombre de la Direccion o Unidad.</label>
                        <input type="text" name="nombredepartamento" id="nombredepartamento" placeholder="Direccion o Unidad">
                        
                        <label for="rol">Entidad</label>
                        <?php 
                                $query_entidad = mysqli_query($conection,"SELECT * FROM entidades");
                                $result_entidad = mysqli_num_rows($query_entidad);

                                
                        ?>
                        
                        <select name="entidad" id="entidad">
                            <?php 
                            if ($result_entidad>0){

                                while ($entidad=mysqli_fetch_array($query_entidad)){
                                ?>
                                 <option value="<?php echo $entidad['id_entidad']; ?>"><?php echo $entidad['nombre'] ?></option>
                                 
                                 <?php


                                }
                            }       
                            
                            ?>

                        </select>
                        <hr>

                        <div class="d-grid gap-2">
                            <button type="submit"  class="btn btn-success">Guardar</button>
                            <a href="listado_deptos.php" class="btn btn-danger float-end">Unidades - Dir. Registradas</a>
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