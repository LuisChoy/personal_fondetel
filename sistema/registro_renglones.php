
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

   
    if (!empty($_POST['numerorenglon'])){ 
        
        $patron = '/^[a-zA-Z, ]*$/';
        $namerenglon = trim($_POST['descripcion']);
        $numrenglon  = $_POST['numerorenglon'];
        if (preg_match($patron,$namerenglon)){
                $alert ='';
                $busquedaRegistro = mysqli_query($conection,"SELECT * FROM renglones WHERE descripcion ='$namerenglon' AND estatus =1");
                $resultado = mysqli_fetch_array($busquedaRegistro);
               
                if ($resultado>0) {
                    
                    $alert = '<p class="msg_error">El tipo de Servicio ya existe.</p>';
                    $nameservice='';
                } else {
                    $queryInsert = mysqli_query($conection,"INSERT INTO  renglones(numerorenglon,descripcion,estatus) VALUES ('$numrenglon','$namerenglon',1)");
                    if ($queryInsert) {
                            $alert='<p class="msg_save">Renglon Creado Correctamente</p>';
                            
                        // header("Location: listado_usuarios.php");
                        //exit(0);
                    } else {
                        $alert = '<p class="msg_error">Error al crear el Renglon.</p>';
                    }
                   
                }
            
        }

    } else{
        $alert = '<p class="msg_error">¡Faltan campos por llenar!.</p>';    
        unset($alert);    
    }
        
   
    ?>


    <title>Registro de Renglones</title>

</head>
<body>

<div class="container">
    
        <div class="row py-3">
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 py-4">
            <div class="card ">
                <div class="card-header">
                    <h4>Agregar Renglon</h4>
                </div>
                <div class="card-body">
                <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>
                        <form action="" method="POST">
                            <div class="mb-3">
                                 <label for="numerorenglon" >Numero de Renglon</label>
                                 <input type="text" name="numerorenglon" placeholder="Numero de renglon" autofocus>
                            </div>
                            <div class="mb-3">
                                 <label for="descripcion" >Descrpcion del renglon</label>
                                 <input type="text" name="descripcion" placeholder="Descripcion">
                            </div>
                           <div class="d-grid gap-2">
                             <button type="submit" name="guardar_renglon" class="btn btn-success" >Guardar</button>
                             
                            </div>

                        </form>


                </div>
            </div>

            </div>

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-8 py-4">
            <h4> Renglones Registrados</h4>
                    <table class="table table-striped table-ligth">
                        <thead class="fs-6">
                        <tr>
                                            <th>ID</th>
                                            <th># DE RENGLON</th>
                                            <th>DESCRIPCION</th>
                                            <th>ACCIONES</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                                $query= "SELECT * FROM renglones where estatus = 1";
                                $query_run= mysqli_query($conection,$query);

                                if(mysqli_num_rows($query_run) >0){

                                    foreach ($query_run as $renglon){


                                        //echo $estudiante['nombre'];
                                    ?>
                                    <tr class="fw-normal">
                                    <td><?= $renglon['idrenglon']; ?></td>
                                    <td><?= $renglon['numerorenglon']; ?></td>
                                    <td><?= $renglon['descripcion']; ?></td>

                                    <td>
                                    <div class="btn-group" role="group" aria-label="Basic">
                                        <a href="editar_renglon.php?idrenglon=<?=$renglon['idrenglon'];?>" class="btn btn-success btn-sm">Editar</a>
                                        <a href="eliminar_renglon.php?idrenglon=<?=$renglon['idrenglon'];?>" class="btn btn-danger btn-sm">Eliminar</a>

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