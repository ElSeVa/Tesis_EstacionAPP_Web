<main class="form-signin">
  <form class="was-validated" action="register.php" method="POST" >
    <img class="mb-4" src="img/registerUsuario.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <label for="inputNombre" class="visually-hidden">Ingrese su nombre</label>
    <input type="text" name="nombre" id="inputNombre" class="form-control valid mb-2" placeholder="Ingrese su nombre"  required="" minlength="6" autofocus="">

    <label for="inputPassword" class="visually-hidden">Ingrese su contraseña</label>
    <input type="text" name="contrasena" id="inputPassword" class="form-control" placeholder="Ingrese su contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%*#?&]{8,}$" required="" minlength="8" autofocus="">
    <span id="mensaje"></span>
    <div id="requisitos" class="m-2">
      <span id="mayus">1 Mayuscula -</span>
      <span id="special">1 Caracter Especial -</span>
      <span id="numbers">Digitos -</span>
      <span id="lower">Minusculas -</span>
      <span id="lenght">Minimo 8 Caracter</span>
    </div>
    
    <label for="inputEmail" class="visually-hidden">Ingrese su email</label>
    <input type="email" name="email" id="inputEmail" class="form-control mb-2" placeholder="Ingrese su email" required="" autofocus="">

    <label for="selectTipo" class="visually-hidden">Eliga su tipo de vehiculo</label>
    <select class="form-select mb-2" name="tipoVehiculo">
    <?php include_once("config.php");
        $estadias = Estadia::traerTodoGroupBy("vehiculo_permitido");
        foreach($estadias as $estadia){
        ?>
            <option><?=$estadia->getVehiculoPermitido()?></option>
    <?php
        }
    ?>            
    <!---
        <option>Auto</option>
        <option>Moto</option>
        <option>4x4</option>
        <option>Bicicleta</option>
      -->
    </select>
    <div id="mostrarOcultar">
        <label for="inputGarage" class="visually-hidden">Nombre de Garage</label>
        <input type="text" id="inputGarage" name="nombreGarage" class="form-control mb-2" placeholder="Ingrese el nombre de garage" minlength="8">
        <div class="invalid-feedback">
            Por favor ingrese un nombre de garage
        </div>
        <label for="inputDireccion" class="visually-hidden">Direccion</label>
        <input type="text" id="inputDireccion" name="direccion" class="form-control mb-2" placeholder="Ingrese su direccion" minlength="8">
        <div class="invalid-feedback">
            Por favor ingrese una direccion
        </div>
        <select class="form-select mb-2" id="inputDisponibilidad" name="disponibilidad">
            <option>Abierto</option>
            <option>Cerrado</option>
        </select>

        <label for="inputTelefono" class="visually-hidden">Telefono</label>
        <input type="text" id="inputTelefono" name="telefono" class="form-control mb-2" placeholder="Ingrese un telefono">
        <div class="valid-feedback mb-2">
            No es necesario que ingreses un telefono pero por las dudas tienes la opcion.
        </div>
        <label for="inputLatitud" class="visually-hidden">Latitud-Direccion</label>
        <input type="hidden" id="lat" name="lat">

        <label for="inputLongitud" class="visually-hidden">Longitud-Direccion</label>
        <input type="hidden" id="lng" name="lng">
    </div>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="1" id="checkPropietario" name="propietario"> ¿Eres propietario de un estacionamiento?
      </label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="sendForm" value="Enviar">Sign Up</button>
    <label class="m-3">
        <img id="btnGoogleRegister" src="img/btnGoogle.png" alt="">
    </label>
    <label>
        <a href="pageIndex?seccion=login">Estas registrado?</a> 
    </label>
    <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
  </form>
</main>
