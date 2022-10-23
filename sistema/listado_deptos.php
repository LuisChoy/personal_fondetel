<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos Registrados</title>
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
                <h4> Departamentos Registrados
                <a href="registro_departamentos.php" class="btn btn-success">Registrar Departamento</a>
                </h4>
                
                <table class="table table-striped table-ligth table-bordered ">
                    <thead class="fs-6">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE DEPARTAMENTO</th>
                            <th>ENTIDAD</th>


                        </tr>
                    </thead>
                    <tbody>
                       
                         <?php 
                            $NombreEntidad = mysqli_query($conection,"SELECT
                            d.iddepartamento,
                            d.nombredepto,
                            e.nombre
                        FROM
                            departamentos d
                            INNER JOIN entidades e ON d.identidad = e.id_entidad");
                            $result = mysqli_num_rows($NombreEntidad);
                            
                            if($result>0){

                                while($data = mysqli_fetch_array($NombreEntidad) ){

                        ?>
                                <tr class="fw-normal">
                                    <td><?php echo $data['iddepartamento']; ?></td>
                                    <td><?php echo $data['nombredepto']; ?></td>
                                    <td><?php echo $data['nombre']; ?></td>

                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic">
                                            
                                            <a href="editar.php?id_entidad=<?= $entidad['id_entidad']; ?>" class="btn btn-success btn-sm">Editar</a>
                                            <a href="" class="btn btn-danger btn-sm">Eliminar</a>

                                        </div>

                                    </td>
                                </tr>  
                        <?php
                            }

                        }else {


                            echo "<h5>No hay datos registrados</h5>";
                        }
                        ?>
                      
                    </tbody>
                </table>
            </div>
        </div>


    </div>
<?php

?>    



<div class="container-fluid">

<?php

require_once('./Templates/footer.php');

?>

</div>


</body>
</html>
