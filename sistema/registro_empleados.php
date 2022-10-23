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

  //Inicio funcion guardar datos

  if (!empty($_POST)) {
    $alert = '';
   // print_r($_POST);
    $i = 21;
    switch ($i) {

      case (empty($_POST['nombres'])):
        $nmb = "Nombres";
        $alert = '<p class="msg_error">El campo:</p>'."-".$nmb."- esta vacio";
        break;
      case (empty($_POST['apellidos'])):
        $ape = "Apellidos";
        $alert = '<p class="msg_error">El campo</p>'."-". $ape."- esta vacio";
        break;
      case (empty($_POST['telefono'])):
        $tel = "Telefono";
        $alert = '<p class="msg_error">El campo</p>'."-". $tel."- esta vacio";
        break;
      case (empty($_POST['dpi'])):
        $cui = "DPI";
        $alert = '<p class="msg_error">El campo</p>'."-". $cui."- esta vacio";
        break;
      case (empty($_POST['fechanacimeinto'])):
        $fnac = "Fecha de Nacimiento";
        $alert = '<p class="msg_error">El campo</p>'."-". $fnac."- esta vacio";
        break;
      case (empty($_POST['niveleducativo'])):
        $niveled = "Nivel Educativo";
        $alert = '<p class="msg_error">El campo</p>'."-". $niveled."- esta vacio";
        break;
      case (empty($_POST['idservicio'])):
        $idserv = "Seleccione Servicio";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $idserv."- esta vacio";
        break;
      case (empty($_POST['idpuesto'])):
        $idp = "Seleccionar Puesto";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $idp."- esta vacio";
        break;
      case (empty($_POST['iddepto'])):
        $iddep = "Seleccione Departamento";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $iddep."- esta vacio";
        break;
      case (empty($_POST['correo'])):
        $mail = "Correo Electronico";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $mail."- esta vacio";
        break;
      case (empty($_POST['fotografia'])):
        $foto = "Fotografia";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $foto."- esta vacio";
        break;
      case (empty($_POST['numerocontrato'])):
        $numcon = "Numero de Contrato";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $numcon."- esta vacio";
        break;
      case (empty($_POST['nombrecontrato'])):
        $nombcon = "Descripcion de Contrato";
        $alert = '<p class="msg_error">UEl campo</p>'."-". $nombcon."- esta vacio";
        break;
      case (empty($_POST['fechainiciocontrato'])):
        $finicont = "Fecha de inicio de contrato";
        $alert = '<p class="msg_error">El campo</p>'."-". $finic."- esta vacio";
        break;
      case (empty($_POST['fechafincontrato'])):
        $ffincontra = "Fecha fin de contrato";
        $alert = '<p class="msg_error">El campo</p>'."-". $ffinc."- esta vacio";
        break;
      case (empty($_POST['finiquito'])):
        $fini = "Finiquito";
        $alert = '<p class="msg_error">El campo</p>'."-". $fini."- esta vacio";
        break;
      case (empty($_POST['honorariomensual'])):
        $hnmensual = "Honorarios Mensuales";
        $alert = '<p class="msg_error">El campo</p>'."-". $hnmen."- esta vacio";
        break;
      case (empty($_POST['fechaprimerpago'])):
        $fprimer = "Fecha Primer pago";
        $alert = '<p class="msg_error">El campo</p>'."-". $fprim."- esta vacio";
        break;
      case (empty($_POST['totalcontrato'])):
        $totcontrato = "Total de Contrato";
        $alert = '<p class="msg_error">El campo</p>'."-". $totcontrato."- esta vacio";
        break;
    }
    
  }else{
    echo "Se pueden guardar datos";
  }




  //Fin funcion guardar datos


  ?>
  <title>Registro de Personal</title>

</head>

<body>

  <div class="container">
    <div class="card">
      <div class="card-header bg-info">
        <h4 class="text-white">Gestion de Contratos FONDETEL</h4>
      </div>
      <div class="card-body">
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
        <div class="row">
          <div class="col-md-6">
            <h4>Datos del empleado</h4>
            <form action="" method="POST">
              <div class="form-row">
                <label for="nombres">Nombres </label>
                <input type="text" name="nombres" placeholder="Ejemplo: Juan Pedro " class="form-control" autofocus>
                <label for="apellidos">Apellidos </label>
                <input type="text" name="apellidos" placeholder="Ejemplo: Perez Perez " class="form-control">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" placeholder="Ejemplo: 17-77, Guatemala, 8 Av, Ciudad de Guatemala" class="form-control">
                <label for="telefono">Telefono</label>
                <input type="phone" name="telefono" placeholder="Ejemplo: +50245903125 " class="form-control">
                <label for="dpi">Documento Personal de Identificacion (DPI)</label>
                <input type="number" name="dpi" placeholder="Ejemplo: 1111 11111 0101 " class="form-control">
                <label for="fechanacimiento">Fecha de Nacimiento</label>
                <input type="date" name="fechanacimeinto" placeholder="Ejemplo: Ingrese usuario " class="form-control">
                <label for="niveleducativo">Nivel Eductativo</label>
                <input type="text" name="niveleducativo" placeholder="Ejemplo: Licenciatura en Administracion " class="form-control">
                <!-- option seleccion de servicio -->
                <label for="tiposervicio">Seleccione el tipo de Servicio</label>
                <div class="input-group">
                  <?php
                  $query_servicio = mysqli_query($conection, "SELECT * FROM servicios WHERE estatus=1");
                  $resultado_servicio = mysqli_num_rows($query_servicio);
                  ?>
                  <select name="idservicio" name="servicios" class="custom-select" id="inputGroupSelect04">
                    <option selected>Seleccionar Servicio</option>
                    <?php
                    if ($resultado_servicio > 0) {

                      while ($servicio = mysqli_fetch_array($query_servicio)) {
                    ?>
                        <option value="<?php echo $servicio['idservicios']; ?>"><?php echo $servicio['tiposervicios'] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Servicio</button>
                  </div>
                </div>
                <!-- option seleccion de puesto -->
                <label for="puesto">Seleccione el puesto</label>
                <div class="input-group">
                  <?php
                  $query_puestos = mysqli_query($conection, "SELECT * FROM puestos");
                  $resultado_puestos = mysqli_num_rows($query_puestos);
                  ?>
                  <select name="idpuesto" class="custom-select" id="inputGroupSelect04">
                    <option selected>Seleccionar Puesto</option>
                    <?php
                    if ($resultado_puestos > 0) {

                      while ($puesto = mysqli_fetch_array($query_puestos)) {
                    ?>
                        <option value="<?php echo $puesto['idpuesto']; ?>"><?php echo $puesto['nombre'] ?></option>
                    <?php
                      }
                    }
                    ?>

                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Puesto</button>
                  </div>
                </div>

                <!-- option seleccion de departamento -->
                <label for="departamento">Seleccione el departamento</label>
                <div class="input-group">
                  <?php
                  $query_deptos = mysqli_query($conection, "SELECT * FROM departamentos");
                  mysqli_close($conection);
                  $resultado_deptos = mysqli_num_rows($query_deptos);
                  ?>
                  <select name="iddepto" class="custom-select" id="inputGroupSelect04">
                    <option selected>Seleccionar departamento</option>
                    <?php
                    if ($resultado_deptos > 0) {

                      while ($depto = mysqli_fetch_array($query_deptos)) {
                    ?>
                        <option value="<?php echo $depto['iddepartamento']; ?>"><?php echo $depto['nombredepto'] ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button">Departamento</button>
                  </div>
                </div>
                <label for="email">Correo Electronico</label>
                <input type="email" name="correo" placeholder="Ejemplo: juanperez@correo.com " class="form-control">
                <label for="fotografiaempleado">Fotografia</label>
                <input accept="image/png,image/jpeg" type="file" name="fotografia" placeholder="Ejemplo: Subir fotografia " class="form-control">

              </div>

          </div>
          <div class="col-md-6">
            <h4>Datos de Contrato</h4>

            <div class="form-row">
              <label for="contrato">Numero de Contrato </label>
              <input type="text" name="numerocontrato" placeholder="Ejemplo: 00-0000-029-FONDETEL " class="form-control">
              <label for="descripcioncontrato">Descripcion de contrato</label>
              <textarea name="nombrecontrato" placeholder="Ejemplo: Contrato administrativo... " class="form-control"></textarea>
              <label for="contrato">Fecha de inicio de labores </label>
              <input type="date" name="fechainiciolabores" placeholder="dd/mm/aaaa" class="form-control">
              <label for="contrato">Fecha de inicio de contrato </label>
              <input type="date" name="fechainiciocontrato" placeholder="dd/mm/aaaa" class="form-control">
              <label for="contrato">Fecha de fin de contrato </label>
              <input type="date" name="fechafincontrato" placeholder="dd/mm/aaaa" class="form-control">
              <label for="contrato">Datos de Finiquito </label>
              <textarea name="finiquito" placeholder="Ejemplo: Datos de finiquito" class="form-control"></textarea>
              <label for="contrato">Honorarios Mensuales </label>
              <input data-type="honorariosmensual" name="honorariosmensual" placeholder="Q 0,000.00" class="form-control">
              <label for="contrato">Fecha de primer pago</label>
              <input type="date" name="fechaprimerpago" placeholder="dd/mm/aaaa" class="form-control">
              <label for="contrato">Total del Contrato </label>
              <input data-type="totalcontrato" name="totalcontrato" placeholder="Q 0,000.00" class="form-control" value=""  id="currency-field">
              <br>

            </div>
            <br>

            <button type="submit" name="guardardatos" class="btn btn-success btn-lg btn-block">Guardar Datos</button>
            <button type="button" class="btn btn-warning btn-lg btn-block">Listado de Colaboradores</button>



          </div>
          </form>
        </div>

      </div>

    </div>

  </div>
  <script src="./plugins/sweetalert2.all.min.js"></script>
  <script src="js/codigo.js"></script>
  <script>
    //conversion a moneda de primer pago 
    // Jquery Dependency

    $("input[data-type='honorariosmensual']").on({
      keyup: function() {
        formatCurrency($(this));
      },
      blur: function() {
        formatCurrency($(this), "blur");
      }
    });


    function formatNumber(n) {
      // format number 1000000 to 1,234,567
      return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
      // appends $ to value, validates decimal side
      // and puts cursor back in right position.

      // get input value
      var input_val = input.val();

      // don't validate empty input
      if (input_val === "") {
        return;
      }

      // original length
      var original_len = input_val.length;

      // initial caret position 
      var caret_pos = input.prop("selectionStart");

      // check for decimal
      if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
          right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "Q" + left_side + "." + right_side;

      } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "Q" + input_val;

        // final formatting
        if (blur === "blur") {
          input_val += ".00";
        }
      }

      // send updated string to input
      input.val(input_val);

      // put caret back in the right position
      var updated_len = input_val.length;
      caret_pos = updated_len - original_len + caret_pos;
      input[0].setSelectionRange(caret_pos, caret_pos);
    }

    //fin conversion honorariomensual
    //inicio conversion totalcontrato
    $("input[data-type='totalcontrato']").on({
      keyup: function() {
        formatCurrency($(this));
      },
      blur: function() {
        formatCurrency($(this), "blur");
      }
    });


    function formatNumber(n) {
      // format number 1000000 to 1,234,567
      return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }


    function formatCurrency(input, blur) {
      // appends $ to value, validates decimal side
      // and puts cursor back in right position.

      // get input value
      var input_val = input.val();

      // don't validate empty input
      if (input_val === "") {
        return;
      }

      // original length
      var original_len = input_val.length;

      // initial caret position 
      var caret_pos = input.prop("selectionStart");

      // check for decimal
      if (input_val.indexOf(".") >= 0) {

        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");

        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        // add commas to left side of number
        left_side = formatNumber(left_side);

        // validate right side
        right_side = formatNumber(right_side);

        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
          right_side += "00";
        }

        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);

        // join number by .
        input_val = "Q" + left_side + "." + right_side;

      } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = "Q" + input_val;

        // final formatting
        if (blur === "blur") {
          input_val += ".00";
        }
      }

      // send updated string to input
      input.val(input_val);

      // put caret back in the right position
      var updated_len = input_val.length;
      caret_pos = updated_len - original_len + caret_pos;
      input[0].setSelectionRange(caret_pos, caret_pos);
    }

    //fin conversion total contrato
  </script>


</body>
<div class="container-fluid">

  <?php

  require_once('./Templates/footer.php');

  ?>

</div>

</html>