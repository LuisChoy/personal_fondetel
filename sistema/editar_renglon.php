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
    if (empty($_POST['numerorenglon']) || empty($_POST['descripcion']))
    {
        $alert='<p class="msg_error">Uno de los campos esta vacio.</p>';

    }else{
        $alert = '';
        $patron = '/^[a-zA-Z, ]*$/';
        $nombredelrenglon = trim($_POST['descripcion']);
        if(empty($_POST['numerorenglon']) || preg_match($patron,empty($nombredelrenglon)))
        {
            $alert='<p class="msg_error">Todos los campos son obligatorios</p>';

        }else
        $idrngl = '';
        $idrngl = $_POST['idrenglon'];
        $numrenglon = $_POST['numerorenglon'];
        $desc = $_POST['descripcion'];
        
        $query = mysqli_query($conection,"SELECT * FROM  renglones WHERE idrenglon ='$idrngl' ");

        $result = mysqli_fetch_array($query);


            if(!empty($_POST['numerorenglon']) || !empty($_POST['descripcion']))
            {
                $sql_update = mysqli_query($conection," UPDATE renglones
                                          SET  numerorenglon ='$numrenglon',
                                               descripcion ='$desc'   
                                               WHERE idrenglon = '$idrngl'");
               if($sql_update){
                $alert='<p class="msg_save">Renglon Actualizado Correctamente</p>';
                // header("Location: listado_usuarios.php");
                //exit(0);
            }else{
                $alert='<p class="msg_error">Error al actualizar el renglon.</p>';
            }

            }else{

                $alert='<p class="msg_error">Uno de los campos esta vacio.</p>';
            }
   
    }

    //fin funcion guardar
    //inicio funcion traer datos
    if(empty($_GET['idrenglon']))
    {
        header('Location:registro_renglones.php');
    }
    $idrenglon = $_GET['idrenglon'];
    $renglonObtenido = mysqli_query($conection,"SELECT * FROM renglones WHERE idrenglon= $idrenglon AND estatus=1");

    $result_sql = mysqli_num_rows($renglonObtenido);
    if ($result_sql ==0){

        header('Location:registro_renglones.php');

    }else{
        $option='';
        while ($data = mysqli_fetch_array($renglonObtenido)){
            $idrenglon = $data['idrenglon'];
            $numerorenglon = $data['numerorenglon'];
            $descripcion = $data['descripcion'];

        }
    }

    //fin funcion traer datos

    ?>
    <title>Actualizacion de Renglon</title>

</head>

<body>
<div class="container py-3">
    <div class="row ">
        <div class="col align-self-center">
            <div class="form_register">
                <h4>Actualizar Renglones</h4>
                <hr>
                <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>

                <form action="" method="POST">
                    <input type="hidden" name="idrenglon" value="<?php echo $idrenglon; ?>">
                    <label for="Nombre">Numero de Renglon</label>
                    <input type="text" name="numerorenglon" id="numerorenglon" placeholder="Numero del renglon" value="<?php echo $numerorenglon;?>">
                    <label for="Nombre">Descripcion del Renglon</label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Descripción del renglon" value="<?php echo $descripcion;?>">
                    
                   

                    <hr>

                    <div class="d-grid gap-2">
                        <button type="submit" value="Actualizar Renglon" class="btn btn-success">Actualizar Renglon</button>

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