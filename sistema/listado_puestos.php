<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Puestos Registrados</title>
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
                <h4> Puestos Registrados
                <a href="registro_puestos.php" class="btn btn-success">Registrar Puesto</a>
                </h4>
                
                <table class="table table-striped table-ligth table-bordered ">
                    <thead class="fs-6">
                        <tr>
                            <th>ID</th>
                            <th>PUESTO</th>
                            <th>TIPO PUESTO</th>
                            <th>DEPARTAMENTO</th>
                            <th>ENTIDAD</th>
                            <th>ACCION</th>


                        </tr>
                    </thead>
                    <tbody>
                       
                         <?php 
                            $puestos = mysqli_query($conection,"SELECT puestos.idpuesto,
                            puestos.nombre AS nombrePuesto,
                            departamentos.nombredepto,
                            tipopuestos.nombre AS nombreTipoP,
                            entidades.nombre AS nombreEntidad
                            FROM puestos INNER JOIN departamentos

                            ON puestos.iddepartamento = departamentos.iddepartamento
                            INNER JOIN tipopuestos ON puestos.idtipopuesto = tipopuestos.id
                            INNER JOIN entidades ON puestos.identidad = entidades.id_entidad");
                            $result = mysqli_num_rows($puestos);
                            
                            if($result>0){

                                while($data = mysqli_fetch_array($puestos) ){
                                     
                        ?>
                                <tr class="fw-normal">
                                    <td><?php echo $data['idpuesto']; ?></td>
                                    <td><?php echo $data['nombrePuesto']; ?></td>
                                    <td><?php echo $data['nombreTipoP']; ?></td>
                                    <td><?php echo $data['nombredepto']; ?></td>
                                    <td><?php echo $data['nombreEntidad']; ?></td>

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
