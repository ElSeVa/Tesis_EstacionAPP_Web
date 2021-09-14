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
        <input type="checkbox" value="1" id="checkMantener" name="mantener_sesion_abierta" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" value="Ingresar">Log in</button>
    <label>
        <a href="index.php?seccion=register">No estas registrado?</a> 
    </label>
  </form>
</main>