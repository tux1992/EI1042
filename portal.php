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
    //Si s'indica que és una petició 'partial' tornem un json, en cas contrari carreguem tot el HTML
    if(isset($_REQUEST["pet"]) and $_REQUEST["pet"] == "partial")
    {                
        $action = $_REQUEST["action"];
        switch($action)
        {
            case "cursosDisponibles":
                $dic = carregar_dades("./recursos/cursos.json");
                foreach ($dic as $codi => $curs) 
                {
                    if($curs[2] == "0")
                    {
                        unset($dic[$codi]);
                    } 
                }
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($dic);
                break;
            case "matriculaCursos":
                header('Content-Type: application/json; charset=utf-8');
                $dic = carregar_dades("./recursos/matriculats.json");
                $dic_cursos = carregar_dades("./recursos/cursos.json");
                $matriculats = $dic[$_REQUEST["curso"]];
                $encontrado = false;
                foreach($matriculats as $alumne)
                {
                    if($alumne[0] == $_SESSION["user"])
                    {
                        $encontrado = true;                                
                    }
                }
                if(!$encontrado)
                {
                    array_push($matriculats, array($_SESSION["user"], $_SESSION["user_name"]));
                    $dic[$_REQUEST["curso"]] = $matriculats;
                    
                    $curs = $dic_cursos[$_REQUEST["curso"]];
                    $vacants = intval($curs[2]);
                    $vacants = strval($vacants-1);
                    $curs[2] = $vacants;                    
                    $dic_cursos[$_REQUEST["curso"]] = $curs;
                    guarda_dades($dic, "./recursos/matriculats.json");
                    guarda_dades($dic_cursos, "./recursos/cursos.json");
                    $mensaje = "Alumne ".$_SESSION["user"]." matriculat al curs ".$_REQUEST["curso"];
                    echo json_encode(array('matricula'=>'correcta', 'mensaje' => $mensaje));                                        
                }
                else
                {
                    $mensaje = "L'alumne ".$_SESSION["user"]." ja està matricular al curs ".$_REQUEST["curso"];
                    echo json_encode(array('matricula'=>'incorrecta', 'mensaje' => $mensaje));    
                }
                break;
            default:
                echo json_encode(array('mensaje'=>'error'));
                break;
        }
    }
    else
    {
        require_once(dirname(__FILE__)."/partials/header.php");
        require_once(dirname(__FILE__)."/partials/menu.php");      
        
        $referer = $_SERVER["HTTP_REFERER"];
        if(isset($_REQUEST["action"]) and (!isset($_SERVER["HTTP_REFERER"]) or substr($referer, 0, 16) != "http://localhost"))
        {
            //echo "referer no valido";
            $error_msg = "Accés directe no permés";
            $central = "/partials/home.php";
        }

        else
        {
            //echo "referer valido";
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
                case "matricula":
                    if(autorizacion() == "client")
                    {
                        $central = "/partials/form_matricula.php";
                    }
                    else
                    {
                        $error_msg = "Accés no permés. Sols els usuaris client poden matricularse als cursos.";
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
                                  
                    $foto = "foto_cliente";
                    $nomFoto = "tmp_name";
                    $fileName = $_FILES[$foto]["name"];
                    $destino = "./media/fotos/$fileName";
                                    
                    $nou_curs = [$curs_descripcio, $curs_alumnes, $curs_vacants, $curs_preu];
                                                    
                    if(!isset($dic[$curs_nom]))
                    {
                        $dic[$curs_nom] = $nou_curs;
                        $dic[$curs_nom]["nom_imagen"] = $fileName;
                        $dic[$curs_nom]["foto_cliente"] = $destino;
                        move_uploaded_file($_FILES[$foto][$nomFoto], $destino);
                        guarda_dades($dic, "./recursos/cursos.json");
                        
                        $dic = carregar_dades("./recursos/matriculats.json");
                        $dic[$curs_nom] = array();
                        guarda_dades($dic, "./recursos/matriculats.json");
                    }
                    else
                    {
                        $error_msg = "El curs ".$curs_nom." ja existeix";
                    }
                    $central = "/partials/home.php";
                    break;
                case "modificar":
                    $dic = carregar_dades("./recursos/cursos.json");
                    $curs_nom = $_REQUEST["codi"];
                    $curs_descripcio = $_REQUEST["descripcio"];
                    $curs_alumnes = $_REQUEST["max_alumnes"];
                    $curs_vacants = $_REQUEST["vacants"];
                    $curs_preu = $_REQUEST["preu"];
                    $nou_curs = [$curs_descripcio, $curs_alumnes, $curs_vacants, $curs_preu];
                    
                    if(isset($curs_nom["nom_imagen"]))
                    {                    
                        $nou_curs["nom_imagen"] = $curs_nom["nom_imagen"];
                        $nou_curs["foto_cliente"] = $curs_nom["foto_cliente"];
                    }
                 
                    $dic[$curs_nom] = $nou_curs;
                    guarda_dades($dic, "./recursos/cursos.json");
                    
                    $central = "/partials/llistar_admin.php";
                    break;
                case "list":
                    $central = "/partials/llistar.php";
                    break;  
                case 'list_admin':
                    $central = "/partials/llistar_admin.php";
                    break;              
                case "borrar":
                    $dic = carregar_dades("./recursos/cursos.json");
                    unset($dic[$_REQUEST["curso"]]);
                    guarda_dades($dic, "./recursos/cursos.json");
                    $central = "/partials/llistar_admin.php";
                    break;
                case "afegirFoto":                
                    $central="/partials/form_foto.php";
                    break;
                case "foto_upload":                
                    $foto = "foto_cliente";
                    $nomFoto = "tmp_name";
                    $fileName = $_FILES[$foto]["name"];
                    $destino = "./media/fotos/$fileName";
                    move_uploaded_file($_FILES[$foto][$nomFoto], $destino);
                    //print_r($_FILES);
                    $central="/partials/form_foto.php";
                    break;
                case "firma_upload":                
                    $foto = "foto";
                    $nomFoto = "tmp_name";
                    $fileName = $_FILES[$foto]["name"];
                    $destino = "./media/firmas/$fileName";
                    move_uploaded_file($_FILES[$foto][$nomFoto], $destino);
                    //print_r($_FILES);
                    $central="/partials/firma_online.php";
                    break;
                case "ahorcado":
                    $central="/partials/ahorcado.php";
                    break;
                case "quadrats":
                    $central="/partials/quadrats.php";
                    break;
                case "firmar":
                    $central="/partials/firma_online.php";
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
        require_once(dirname(__FILE__)."/partials/tempsSensal.php");
        //echo "<br />",$action,"<br />",dirname(__FILE__),"<br />";
        require_once(dirname(__FILE__)."/partials/aside_footer.php");
        require_once(dirname(__FILE__)."/partials/footer.php");
    }
?>
