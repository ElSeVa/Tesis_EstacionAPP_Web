<?php session_start();
    setcookie("COOKIE_INDEFINED_SESSION", false, time()-31622400);
    setcookie("COOKIE_DATA_INDEFINED_SESSION[email]",false, time()-31622400);
    setcookie("COOKIE_DATA_INDEFINED_SESSION[contrasena]",false, time()-31622400);
    setcookie("COOKIE_CLOSE_NAVEGADOR", false, 0);
session_unset();  
session_destroy();
session_regenerate_id(true);
header('Location: pageIndex');

?>