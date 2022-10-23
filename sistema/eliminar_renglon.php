<?php
 include ("../conexion.php");

 
    if(!empty($_POST)){
        if($_POST['estado']==0){
            header("location: registro_renglones.php");
            exit;
        }else{
            $idrenglon = $_POST['idrenglon'];
            $query_delete = mysqli_query($conection, "UPDATE renglones SET estatus=0 WHERE idrenglon = $idrenglon");

            if($query_delete){
                header("location: registro_renglones.php");

            }else{

                echo("Error al eliminar el renglon #: "." ".$idrenglon);
            }

    }
}


    if (empty($_REQUEST['idrenglon'])){

            header("location: registar_renglon.php");

    }else{
        
        $idrenglon = $_REQUEST['idrenglon'];
        $renglonObtenido = mysqli_query($conection,"SELECT * FROM renglones 
        WHERE idrenglon= $idrenglon"); 

        $result = mysqli_num_rows($renglonObtenido);
        if($result>0){

                while($data = mysqli_fetch_array($renglonObtenido)){
                    $idrgnl = $data['idrenglon'];
                    $numrenglon = $data['numerorenglon'];
                    $descrenglon= $data['descripcion'];
                    $estado= $data['estatus'];
                }

        }else{

            header("location: registro_renglones.php");
        }



    }



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Renglon</title>
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
            <h1>¿Esta seguro de eliminar el siguiente renglon?</h1>
          <h5>
           <p>Codigo: <span><?php echo $idrgnl; ?></span></p>
           <p>#: <span><?php echo $numrenglon; ?></span></p>
           <p>Descripcion: <span><?php echo $descrenglon; ?></span></p>
            </h5> 
            <form method="POST" action="">
                <input type="hidden" name="idrenglon" value="<?php echo $idrgnl; ?>">
                <input type="hidden" name="numerorenglon" value="<?php echo $numrenglon; ?>">
                <input type="hidden" name="descripcion" value="<?php echo $descrenglon; ?>">
                <input type="hidden" name="estado" value="<?php echo $estado; ?>">
                <a href="registro_renglones.php" class="btn_cancelar">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_aceptar">
                    
            </form>


        </div>

    </section>



<?php 

require_once('../sistema/Templates/footer.php');

?>
</body>
</html>
