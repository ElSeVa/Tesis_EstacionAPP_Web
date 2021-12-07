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
        case 'emailEnviado':
            $alerta = "Se envio a su correo el link correspondiente";
            $mensaje = "";
            $modo = "alert-success";
          break;
        case 'contrasenaActualizada':
            $alerta = "Su contraseña fue actualizada";
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
        case 'mismaContrasena':
            $alerta = "Esta usando la misma contrasena";
            $mensaje = "Se recomienda cambiarla";
            $modo = "alert-warning";
          break;
        case 'noHacking':
            $alerta = "No puedes hacer eso";
            $mensaje = "";
            $modo = "alert-danger";
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