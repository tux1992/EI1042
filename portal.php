<?php
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Lola <dllido@uji.es> <fulanito@example.com>
 * * @copyright 2018 Lola
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 3
 * * Si la URL tiene este esquema http://xxxx/portal?action=fregistro
 * * mostrara el formulario de registro. Si no hay nada la página principal.
 **/
    require_once(dirname(__FILE__)."/partials/sessio.php");
    require_once(dirname(__FILE__)."/partials/sessio.php");
    require_once(dirname(__FILE__)."/partials/header.php");
    require_once(dirname(__FILE__)."/partials/menu.php");
    
    $referer = $_SERVER["HTTP_REFERER"];
    if(isset($_REQUEST["action"]) and (!isset($_SERVER["HTTP_REFERER"]) or substr($referer, 0, 16) != "http://localhost"))
    {
        echo "referer no valido";
        $error_msg = "Accés directe no permés";
        $central = "/partials/home.php";
    }

    else
    {
        echo "referer valido";
        $action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST["action"] : "home";
        
        switch ($action) 
        {
            case "home":
                $central = "/partials/home.php";
                break;
            case "qui_som":
                $central = "/partials/qui_som.php";
                break;
            case "form_register":
                $central = "/partials/form_register.php";
                break;
            case "privacitat":
                $central = "/partials/privacitat.php";
                break;
            case "galeria":
                $central = "/partials/galeria.php";
                break;
            case "tablas":
                $central = "/partials/tablas.php";
                break;
            case "afegirCurs":
                $central = "/partials/form_cursos.php";
                break;
            default:
                $error_msg = "Acció no permesa";
                $central = "/partials/home.php";
                break;
        }
    }
    if(isset($error_msg))
        {
            require_once(dirname(__FILE__)."/partials/error.php");
        }
    require_once(dirname(__FILE__).$central);
    require_once(dirname(__FILE__)."/partials/aside_content.php");
    //echo "<br />",$action,"<br />",dirname(__FILE__),"<br />";
    require_once(dirname(__FILE__)."/partials/footer.php");
?>
