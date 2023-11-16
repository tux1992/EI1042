<?php
   
    require_once(dirname(__FILE__)."/sessio.php");
    require_once(dirname(__FILE__)."/lib_utilidades.php");
    $action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST["action"] : "default";
    switch ($action) 
        {
            case "login":
                if(isset($_SESSION["user"]))
                {
                    session_destroy();
                }
                $central = "/form_login.php";
                require_once(dirname(__FILE__).$central);
                break;
            case "auten":
                if(autentificacion_ok("../recursos/users.csv", $_REQUEST["user"], $_REQUEST["passwd"]))
                {
                
                    print_r($_SESSION);
                }
                else
                {
                    $error_msg = "Usuari incorrecte";
                    echo $error_msg;
                    $central = "/form_login.php";
                }
                break;
            default:
                $central = "/form_login.php";
                require_once(dirname(__FILE__).$central);
                break;
        }
?>
