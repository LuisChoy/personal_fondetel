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
    
    ?>
    <title>Registrar Puestos</title>
    
</head>

<body>
    <?php 
    // funcion guardar
    if (!empty($_POST))
    {
        $alert = '';
            if(empty($_POST['nombre'])|| empty($_POST['departamento'])|| empty($_POST['entidad'])|| 
            empty($_POST['tipopuestos']))
            {
                $alert='<p class="msg_error">Todos los campos son obligatorios</p>';
                
                }else{
   

                    $nombre =$_POST['nombre'];
                    $departamento = $_POST['departamento'];
                    $entidad = $_POST['entidad'];
                    $tipopuesto = ($_POST['tipopuestos']);
                   
                    
                
                $query = mysqli_query($conection,"SELECT * FROM  puestos 
                                                 WHERE nombre ='$nombre' AND iddepartamento ='$departamento'");
                $result = mysqli_fetch_array($query);
                
                if($result>0){

                    $alert='<p class="msg_error">El puesto ya estan Registrados</p>';
                }else{
                    $query_insert  = mysqli_query($conection,"INSERT INTO puestos (nombre,iddepartamento,identidad,idtipopuesto) 
                                                  VALUES ('$nombre','$departamento','$entidad','$tipopuesto')");
                    
                    if($query_insert){
                      $alert='<p class="msg_save">Puesto Registrado Correctamente</p>';
                     
                    }else{
                        $alert='<p class="msg_error">Error al crear el puesto.</p>';
                    }
                }

           }

    }

    //fin funcion guardar
    
    
    
    ?>
    <div class="container py-3">
        <div class="row ">
            <div class="col align-self-center">
                <div class="form_register">
                    <h4>Registrar Puestos</h4>
                    <hr>
                    <div class="alert"><?php echo isset($alert) ? $alert : '';?></div>

                    <form action="" method="POST">
                        <label for="Nombre">Nombre del puesto</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Puesto">
                        
                        <?php 
                                $query_depto = mysqli_query($conection,"SELECT * FROM departamentos");
                                $result_depto = mysqli_num_rows($query_depto);

                                $query_entidad = mysqli_query($conection,"SELECT * FROM entidades");
                                $result_entidad = mysqli_num_rows($query_entidad);

                                $query_tpuestos = mysqli_query($conection,"SELECT * FROM tipopuestos");
                                $result_tpuestos = mysqli_num_rows($query_tpuestos);

                                
                        ?>
                        <label for="departamento">Seleccione Departamento o Unidad</label>
                        <select name="departamento" id="departamento">
                            <?php 
                            if ($result_depto>0){

                                while ($depto=mysqli_fetch_array($query_depto)){
                                ?>
                                 <option value="<?php echo $depto['iddepartamento']; ?>"><?php echo $depto['nombredepto'] ?></option>
                                 
                                 <?php


                                }
                            }       
                            
                            ?>

                        </select>
                    
                        <label for="entidad">Seleccione Entidad</label>
                        <select name="entidad" id="entidad">
                            <?php 
                            if ($result_entidad>0){

                                while ($entidades=mysqli_fetch_array($query_entidad)){
                                ?>
                                 <option value="<?php echo $entidades['id_entidad']; ?>"><?php echo $entidades['nombre'] ?></option>
                                 
                                 <?php


                                }
                            }       
                            
                            ?>

                        </select>
                        
                        <label for="tpuesto">Seleccione Tipo Puesto</label>
                        <select name="tipopuestos" id="tipopuestos">
                            <?php 
                            if ($result_tpuestos>0){

                                while ($puestos=mysqli_fetch_array($query_tpuestos)){
                                ?>
                                 <option value="<?php echo $puestos['id']; ?>"><?php echo $puestos['nombre'] ?></option>
                                 
                                 <?php


                                }
                            }       
                            
                            ?>

                        </select>
                        <hr>
                        <div class="d-grid gap-2">
                            <button type="submit" name="guardar_usuario" class="btn btn-success">Registrar Puesto</button>
                            <a href="listado_puestos.php" class="btn btn-danger float-end">Puestos Registrados</a>
                        </div>
                        <hr>

                    </form>
                   <hr>
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