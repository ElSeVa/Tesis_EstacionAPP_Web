<?php

    if(isset($_GET["codigo"]) && !empty($_GET["codigo"])){
        $codigo = $_GET["codigo"];
        if(strlen($codigo) == 32 && ctype_xdigit($codigo)){
        //if(strlen($codigo) == 60 && ctype_xdigit($codigo)){
?>
<main class="form-signin">
    <form class="was-validated" action="recuperar.php" method="POST">
        <img class="mb-4" src="img/loginUsuario.png" alt="" width="72" height="72">
        <h1 class="h4 mb-3 fw-normal">Ingrese su nueva contraseña</h1>
        <label for="inputContrasena" class="visually-hidden">Nueva contraseña</label>
        <input type="password" name="contrasena" id="inputContrasena" class="form-control mb-2" placeholder="Nueva contraseña" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%*#?&]{8,}$" required="" autofocus="">        
        <label for="inputConfirmarContrasena" class="visually-hidden">Confirmar nueva contraseña</label>
        <input type="password" name="confirmarContrasena" id="inputOtraContrasena" class="form-control mb-2" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%*#?&]{8,}$" placeholder="Ponga de nuevo la contraseña" required="">
        <span id="mensaje"></span>
        <div id="requisitos" class="m-2">
            <span id="mayus">1 Mayuscula -</span>
            <span id="special">1 Caracter Especial -</span>
            <span id="numbers">Digitos -</span>
            <span id="lower">Minusculas -</span>
            <span id="lenght">Minimo 8 Caracter</span>
        </div>
        <input type="hidden" name="codigo" class="form-control mb-2" value="<?= $_GET["codigo"] ?>">
        <button name="cambiarContrasena" class="w-100 btn btn-lg btn-primary" type="submit" value="Ingresar">Cambiar contraseña</button>
    </form>
</main>
<?php
        }else{
            ?>
<main class="form-signin">
    <form action="recuperar.php" method="POST">
        <img class="mb-4" src="img/loginUsuario.png" alt="" width="72" height="72">
        <h1 class="h4 mb-4 fw-normal">Ingrese su correo para recuperar su contraseña</h1>
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control mb-3" placeholder="Correo electronico" required="" autofocus="">    
        <button name="enviarCorreo" class="w-100 btn btn-lg btn-primary" type="submit" value="Ingresar">Enviar correo</button>
    </form>
</main>
            <?php
        }
    }
    if(!isset($_GET["codigo"]) && empty($_GET["codigo"])){
            ?>
<main class="form-signin">
    <form action="recuperar.php" method="POST">
        <img class="mb-4" src="img/loginUsuario.png" alt="" width="72" height="72">
        <h1 class="h4 mb-4 fw-normal">Ingrese su correo para recuperar su contraseña</h1>
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" name="email" id="inputEmail" class="form-control mb-3" placeholder="Correo electronico" required="" autofocus="">    
        <button name="enviarCorreo" class="w-100 btn btn-lg btn-primary" type="submit" value="Ingresar">Enviar correo</button>
    </form>
</main>
            <?php
    }
       ?>

