<?php
    
    if(!empty($_GET["seccion"])){
      
      $seccion = $_GET["seccion"];
      switch ($seccion) {
        case 'login':
          # code...
          break;
        
        default:
            $modo = "alert-danger";
            $alerta = "Error pagina";
            $mensaje = "No exite la pagina";
          break;
      }
      if($seccion == "login"){
          
      } else if ($seccion == "register"){
          
      } else if($seccion == "home"){
          
      } else {
          $modo = "alert-danger";
          $alerta = "Error pagina";
          $mensaje = "No exite la pagina";
      }
    }

    if(!empty($_GET["accion"])){
      $accion = $_GET["accion"];
      switch ($accion) {
        case 'exitosoConductor':
            $alerta = "Existoso registro del conductor";
            $mensaje = "";
            $modo = "alert-success";
          break;
        case 'exitosoGarage':
            $alerta = "Existoso registro del garage";
            $mensaje = "";
            $modo = "alert-success";
          break;
        case 'errorLogin':
            $alerta = "Error al Loguearse";
            $mensaje = "El email y contraseña que ingreso no estan registrados en el sistema.";
            $modo = "alert-warning";
          break;
        case 'errorCompletar':
            $alerta = "Error al completar";
            $mensaje = "Falta completar los campos para registerte como propietario";
            $modo = "alert-warning";
          break;
        case 'errorDireccionOcupado':
            $alerta = "Error direccion ocupada";
            $mensaje = "La direccion ingresada ya esta ocupada";
            $modo = "alert-danger";
          break;
        default:
          # code...
          break;
      }

    }


?>

<div class="alert <?= $modo ?> alert-dismissible fade show" role="alert">
  <strong> <?= $alerta ?> </strong>. <?= $mensaje ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>