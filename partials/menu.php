<nav>
	<ul>
		<li>
			<a href="?action=home">Home</a>
		</li>
		<?php
                if(autorizacion() == "admin")
                {
                    echo '<li><a href="?action=list_admin">Llistar</a></li>';
                }
                else
                {
                    echo '<li><a href="?action=list">Llistar</a></li>';
                }          
		?>  
		<!--
		<li>
			<a href="?action=modify">Modificar</a>
		</li>
		<li>
			<a href="../B_1/holaMundo.php">HolaMundo</a>
		</li>
		-->
		<li>
			<a href="?action=qui_som">Qui som?</a>
		</li>
		<li>
			<a href="?action=afegirCurs">Afegir Curs</a>
		</li>
		<?php
                if(autorizacion() == "client")
                {
                    echo '<li><a href="?action=matricula">Matricula Curs</a></li>';
                }          
		?>  
		<li>
			<a href="?action=galeria">Galeria</a>
		</li>
		<li>
		    <a href="?action=afegirFoto">FormFoto</a>
		</li>
		<li>
			<a href="?action=ahorcado">JocAhorcado</a>
		</li>
		<li>
			<a href="?action=quadrats">JocQuadrats</a>
		</li>
		<li>
			<a href="?action=firmar">Firmar</a>
		</li>
		<li>
			<a href="?action=privacitat">Privacitat</a>
		</li>
	</ul>
</nav>
