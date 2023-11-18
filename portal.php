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
    require_once(dirname(__FILE__)."/partials/lib_utilidades.php");
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
            case "privacitat":
                $central = "/partials/privacitat.php";
                break;
            case "galeria":
                $central = "/partials/galeria.php";
                break;
            case "afegirCurs":
                if(autorizacion() == "admin")
                {
                    $central = "/partials/form_cursos.php";
                }
                else
                {
                    $error_msg = "Accés no permés. Sols els administradors poden afegir cursos.";
                    $central = "/partials/home.php";
                }
                break;
            case "login":
                $central = "/partials/form_login.php";
                break;
            case "auten":
                if(autentificacion_ok("./recursos/users.csv", $_REQUEST["user"], $_REQUEST["passwd"]))
                {                
                    header("Location: portal.php");    
                }
                else
                {
                    $error_msg = "Usuari incorrecte";
                    $central = "/partials/form_login.php";
                }
                break;
            case "logout":
                session_destroy();
                header("Location: portal.php");    
                break;
            case "registrar":
                $dic = carregar_dades("./recursos/cursos.json");
                $curs_nom = $_REQUEST["codi"];
                $curs_descripcio = $_REQUEST["descripcio"];
                $curs_alumnes = $_REQUEST["max_alumnes"];
                $curs_vacants = $_REQUEST["vacants"];
                $curs_preu = $_REQUEST["preu"];
                $nou_curs = [$curs_descripcio, $curs_alumnes, $curs_vacants, $curs_preu];
                
                if(!isset($dic[$curs_nom]))
                {
                    echo "curs ".$curs_nom." no existeix";
                    $dic[$curs_nom] = $nou_curs;
                    guarda_dades($dic, "./recursos/cursos.json");
                }
                else
                {
                    $error_msg = "El curs ".$curs_nom." ja existeix";
                }
                $central = "/partials/home.php";
                break;
            case "list":
                $central = "/partials/llistar.php";
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
