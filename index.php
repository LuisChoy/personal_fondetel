<?php
$alert='';
session_start();
if(!empty($_SESSION['active'])){

    header('location:sistema/');
}else{

if(!empty($_POST))
{
if(empty($_POST['usuario']) || empty($_POST['clave'])){

    $alert = 'Ingrese su Usuario o Contraseña';
}else{

    require_once('conexion.php');
    $user = mysqli_real_escape_string($conection,$_POST['usuario']);
    $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

    $query = mysqli_query($conection, "SELECT * FROM usuarios WHERE 
                                usuario='$user' AND clave='$pass' ");
    mysqli_close($conection);
    $result = mysqli_num_rows($query);
    if($result>0){

        $data = mysqli_fetch_array($query);
        session_start();
        $_SESSION['active']=true;
        $_SESSION['idUser']=$data['idusuario'];
        $_SESSION['nombre']=$data['nombre'];
        $_SESSION['email'] =$data['correo'];
        $_SESSION['user']  =$data['usuario'];
        $_SESSION['rol']   =$data['rol'];

        header('location:sistema/');
    }else{
        $alert = 'El usuario o contraseña son incorrectos';
        session_destroy();
    }
}
 
}
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Personal -FONDETEL-</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    

        <section id="container" >
            <form action="" method="POST">
                <h3>Iniciar Sesión</h3>
                <img src="img/logindos.png" alt="Login">
                <input type="text" name="usuario" placeholder="usuairo@correo.com">
                <input type="password" name="clave" placeholder="contraseña">
                <div class="alert"><?php echo (isset($alert)? $alert: ''); ?></div>
                <input type="submit" value="Ingresar">

            </form>
        </section>


<script src="js/bootstrap.min.js"></script>
</body>
</html>