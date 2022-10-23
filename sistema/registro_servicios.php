
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('../sistema/Templates/header.php');
    require_once('../sistema/scripts.php');
    include('../conexion.php');

   
    if (!empty($_POST['tiposervicio'])){ 
        
        $patron = '/^[a-zA-Z, ]*$/';
        $nameservice = trim($_POST['tiposervicio']);
        if (preg_match($patron,$nameservice)){
                $alert ='';
                $busquedaRegistro = mysqli_query($conection,"SELECT * FROM servicios WHERE tiposervicios ='$nameservice' AND estatus =1");
                $resultado = mysqli_fetch_array($busquedaRegistro);
               
                if ($resultado>0) {
                    
                    $alert = '<p class="msg_error">El tipo de Servicio ya existe.</p>';
                    $nameservice='';
                } else {
                    $queryInsert = mysqli_query($conection, "INSERT INTO  servicios(tiposervicios,estatus) VALUES ('$nameservice',1)");
                    if ($queryInsert) {
                            $alert='<p class="msg_save">Servicio Registrado Correctamente</p>';
                            
                        // header("Location: listado_usuarios.php");
                        //exit(0);
                    } else {
                        $alert = '<p class="msg_error">Error al crear el Servicio.</p>';
                    }
                   
                }
            
        }

    } else{
        $alert = '<p class="msg_error">El campo de rol de usuario esta vacio!.</p>';    
        unset($alert);    
    }
        
   
    ?>


    <title>Registro de Tipo de Servicios</title>

</head>
<body>

<div class="container">
    
        <div class="row py-3">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4">
            <div class="card ">
                <div class="card-header">
                    <h4>Agregar Servicio</h4>
                </div>
                <div class="card-body">
                <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                 <label for="tiposervicio" >Tipo de Servicios</label>
                                 <input type="text" name="tiposervicio" placeholder="Descripcion del Servicio">
                            </div>

                           <div class="d-grid gap-2">
                             <button type="submit" name="guardar_servicio" class="btn btn-success" >Guardar</button>
                             
                            </div>

                        </form>


                </div>
            </div>

            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-8 py-4">
            <h4> Servicios Registrados</h4>
                    <table class="table table-striped table-ligth">
                        <thead class="fs-6">
                        <tr>
                                            <th>ID</th>
                                            <th>TIPO</th>
                                            <th>ACCIONES</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                                $query= "SELECT * FROM servicios where estatus = 1";
                                $query_run= mysqli_query($conection,$query);

                                if(mysqli_num_rows($query_run) >0){

                                    foreach ($query_run as $servicio){


                                        //echo $estudiante['nombre'];
                                    ?>
                                    <tr class="fw-normal">
                                    <td><?= $servicio['idservicios']; ?></td>
                                    <td><?= $servicio['tiposervicios']; ?></td>

                                    <td>
                                    <div class="btn-group" role="group" aria-label="Basic">
                                        <a href="editar_servicios.php?idservicios=<?=$servicio['idservicios'];?>" class="btn btn-success btn-sm">Editar</a>
                                        <a href="eliminar_servicios.php?idservicios=<?=$servicio['idservicios'];?>" class="btn btn-danger btn-sm">Eliminar</a>

                                   </div>

                                    </td>
                                    </tr>
                                    <?php

                                    }

                                }else{


                                        echo "<h5>No hay datos registrados</h5>";

                                }

                             ?>

                        </tbody>
                    </table>


            </div>

        </div>
</div>
<script src="./plugins/sweetalert2.all.min.js"></script>
<script src="./js/codigo.js"></script>
</body>
<div class="container-fluid">

        <?php

        require_once('./Templates/footer.php');

        ?>

    </div>

</html>