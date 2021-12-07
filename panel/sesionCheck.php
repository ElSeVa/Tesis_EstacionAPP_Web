<?php
session_start();
if(isset($_COOKIE["COOKIE_INDEFINED_SESSION"]) && $_COOKIE["COOKIE_INDEFINED_SESSION"] != ''){
    echo true;
}else {
    echo false;
}
if(isset($_COOKIE["COOKIE_CLOSE_NAVEGADOR"]) && $_COOKIE["COOKIE_CLOSE_NAVEGADOR"] != ''){
    echo true;
}else{
    echo false;
}



?>