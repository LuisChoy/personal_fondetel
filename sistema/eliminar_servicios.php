<?php
 include ("../conexion.php");

 
    if(!empty($_POST)){
        if($_POST['estado']==0){
            header("location: registro_servicios.php");
            exit;
        }else{
            $idservicio = $_POST['idservicios'];
            $query_delete = mysqli_query($conection, "UPDATE servicios SET estatus=0 WHERE idservicios = $idservicio");

            if($query_delete){
                header("location: registro_servicios.php");

            }else{

                echo("Error al eliminar el servicio numero: "." ".$idservicio);
            }

    }
}


    if (empty($_REQUEST['idservicios'])){

            header("location: registar_servicios.php");

    }else{
        
        $idservice = $_REQUEST['idservicios'];
        $servicioObtenido = mysqli_query($conection,"SELECT * FROM servicios 
        WHERE idservicios= $idservice"); 

        $result = mysqli_num_rows($servicioObtenido);
        if($result>0){

                while($data = mysqli_fetch_array($servicioObtenido)){
                    $idservicios = $data['idservicios'];
                    $nombreservicios = $data['tiposervicios'];
                    $estado= $data['estatus'];
                
                }

        }else{

            header("location: registrar_servicios.php");
        }



    }



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Servicio</title>
    <link rel="stylesheet" href="css/estilos.css">
    <?php 
        require_once('../sistema/scripts.php');
        require_once('../sistema/Templates/header.php');
    ?>

</head>
<body>
    <section id="container_del">
        <div class="data_delete">
            <br>
            <h1>¿Esta seguro de eliminar el siguiente servicio?</h1>
          <h5>
           <p>Codigo: <span><?php echo $idservicios; ?></span></p>
            <p>Servicio: <span><?php echo $nombreservicios; ?></span></p>
        
            </h5> 
            <form method="POST" action="">
                <input type="hidden" name="idservicios" value="<?php echo $idservicios; ?>">
                <input type="hidden" name="tiposervicios" value="<?php echo $nombreservicios; ?>">
                <input type="hidden" name="estado" value="<?php echo $estado; ?>">
                <a href="registro_servicios.php" class="btn_cancelar">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_aceptar">
                    
            </form>


        </div>

    </section>



<?php 

require_once('../sistema/Templates/footer.php');

?>
</body>
</html>
