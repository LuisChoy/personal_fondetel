<?php
 include ("../conexion.php");

 
    if(!empty($_POST)){
       
        if($_POST['numrol']==1){
           
            header("location: listado_usuarios.php");
           exit;
           
        }else{
           
            $iduser = $_POST['idusuario'];

            $query_delete = mysqli_query($conection, "UPDATE usuarios SET estatus=0 WHERE idusuario = $iduser");
           
            if($query_delete){
             header("location: listado_usuarios.php");
           
            }else{
    
                echo("Error al eliminar el usuario numero: "." ".$idusuario);
            } 
        }
}


    if (empty($_REQUEST['idusuario'])){

         header("location: listado_usuarios.php");
        

    }else{
        
        $iduser = $_REQUEST['idusuario'];
        $usuarioObtenido = mysqli_query($conection,"SELECT usuarios.idusuario,
        usuarios.nombre,
        usuarios.usuario,
        usuarios.rol AS idRol,
        roles.rol AS nombreRol
        FROM usuarios INNER JOIN roles
        ON usuarios.rol = roles.idrol
        WHERE idusuario= $iduser"); 

        $result = mysqli_num_rows($usuarioObtenido);
        if($result>0){

                while($data = mysqli_fetch_array($usuarioObtenido)){
                    $iduser = $data['idusuario'];
                    $nombre = $data['nombre'];
                    $usuario = $data['usuario'];
                    $rol = $data['nombreRol'];
                    $idrol = $data['idRol'];
                
                }

        }else{

           header("location: listado_usuarios.php");
          
        }



    }



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
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
            <h1>¿Esta seguro de eliminar el siguiente usuario?</h1>
          <h5>
           <p>Codigo: <span><?php echo $iduser; ?></span></p>
            <p>Nombre: <span><?php echo $nombre; ?></span></p>
            <p>Usuario: <span><?php echo $usuario; ?></span></p>
            <p>Rol: <span><?php echo "# ".$idrol."- Tipo: ". $rol; ?></span></p>
            </h5> 
            <form method="POST" action="">
                <input type="hidden" name="idusuario" value="<?php echo $iduser; ?>">
                <input type="hidden" name="numrol" value="<?php echo $idrol; ?>">
                <a href="listado_usuarios.php" class="btn_cancelar">Cancelar</a>
                
                <?php 
            
                  if($idrol!==1){
                                            
                  ?>
                <input type="submit" value="Aceptar" class="btn_aceptar">
                 <?php 
                  }
                 ?>    
            </form>


        </div>

    </section>



<?php 

require_once('../sistema/Templates/footer.php');

?>
</body>
</html>
