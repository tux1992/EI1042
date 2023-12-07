<!DOCTYPE html>
<html lang="es">

    <head>
	    <meta charset="UTF-8">
	    <title>Col·legiSensal</title>
	    <meta name="Author" content="AlumnoXXX">
	    <link rel="stylesheet" href="./css/estilo.css" type="text/css">
	    <link rel="icon" type="image/ico" href="./media/icon.png">
    </head>


    <body>
	    <header>
		    <img src="./media/logoo.png" id="logo" alt="logo" />
		    <h1 id="eslogan"> Col·legi Sensal</h1>
		    <div id="loguear">
		        <?php
		            if(!autorizacion())
		            {
		        ?>    
		                <a href="?action=login" class="button">
		                    <button>Login</button>
		                </a>
	           <?php
		            }
		            else
		            {
		        ?>
		                <a href="?action=logout" class="button">
	                        <button>Logout</button>
		                </a>
		        <?php  
		            }
                ?>
		    </div>
	    </header>
