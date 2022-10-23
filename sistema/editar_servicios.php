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
        if(empty($_POST['idservicios'])|| empty($_POST['tiposervicios']) )
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';

        }else
            $idservice = $_POST['idservicios'];
            $nameservice = $_POST['tiposervicios'];
        

        $query = mysqli_query($conection,"SELECT * FROM  servicios WHERE idservicios ='$idservice' ");


        $result = mysqli_fetch_array($query);


            if(!empty($_POST['tiposervicios']))
            {
                $sql_update = mysqli_query($conection," UPDATE servicios
                                                                    SET  tiposervicios ='$nameservice'
                                                                     WHERE idservicios = '$idservice'");
               if($sql_update){
                $alert='<p class="msg_save">Servicio Actualizado Correctamente</p>';
                // header("Location: listado_usuarios.php");
                //exit(0);
            }else{
                $alert='<p class="msg_error">Error al actualizar el servicio.</p>';
            }

            }else{

                $alert='<p class="msg_error">Campo de nomre del Servicio está vacio.</p>';
            }



            
        

    }

    //fin funcion guardar
    //inicio funcion traer datos
    if(empty($_GET['idservicios']))
    {
        header('Location:listado_usuarios.php');
    }
    $idservice = $_GET['idservicios'];
    $servicioObtenido = mysqli_query($conection,"SELECT * FROM servicios WHERE idservicios= $idservice AND estatus=1");

    $result_sql = mysqli_num_rows($servicioObtenido);
    if ($result_sql ==0){

        header('Location:registro_servicios.php');

    }else{
        $option='';
        while ($data = mysqli_fetch_array($servicioObtenido)){
            $idservicio = $data['idservicios'];
            $nombreservicio = $data['tiposervicios'];

        }
    }

    //fin funcion traer datos

    ?>
    <title>Actualizar Servicios</title>

</head>

<body>
<div class="container py-3">
    <div class="row ">
        <div class="col align-self-center">
            <div class="form_register">
                <h4>Actualizar Servicios</h4>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>

                <form action="" method="POST">
                    <input type="hidden" name="idservicios" value="<?php echo $idservicio; ?>">
                    <label for="Nombre">Nombre del Servicio</label>
                    <input type="text" name="tiposervicios" id="tiposervicios" placeholder="Descripción del Servicio" value="<?php echo $nombreservicio;?>">
                    
                   

                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" value="Actualizar Usuario" class="btn btn-success">Actualizar Servicio</button>

                        <a href="registro_servicios.php" class="btn btn-danger float-end">Servicios Registrados</a>
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