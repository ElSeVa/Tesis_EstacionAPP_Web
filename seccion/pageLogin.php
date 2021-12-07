<main class="form-signin">
  <form action="login.php" method="POST">
    <img class="mb-4" src="img/loginUsuario.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 fw-normal">Please log in</h1>
    <label for="inputEmail" class="visually-hidden">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" required="" autofocus="">
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input type="password" name="contrasena" id="inputPassword" class="form-control mb-2" placeholder="Password" required="">
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox"  id="checkMantener" name="mantener_sesion_abierta" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary mb-2" type="submit" value="Ingresar">Log in</button>
    <div class="or-container">
        <div class="line-separator"></div>
        <div class="or-label">or</div>
        <div class="line-separator"></div>
    </div>
    <label class="mb-3">
        <img id="btnGoogleLogin" src="img/btnGoogle.png" alt="">
    </label>
    <label class="mb-3">
        <a href="pageIndex?seccion=register">No estas registrado?</a> 
    </label>  
    <label>
        <a href="pageIndex?seccion=recuperar">Ha olvido su contraseña?</a> 
    </label>    
  </form>
</main>