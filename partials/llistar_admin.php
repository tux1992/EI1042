<main>
    <h1>Llistat de Cursos</h1>
    <?php
        $dic = carregar_dades("./recursos/cursos.json");
    ?>
    <table>
        <tr>
            <th>Codi</th>
            <th>Descripció</th>
            <th>Nombre Màxim d'Alumnes</th>
            <th>Places Vacants</th>
            <th>Preu Trimestre</th>
            <th>Nom Imatge</th>
            <th>Ruta Imatge</th>    
            <th></th>
            <th></th>
            <th></th>
        </tr>
    <?php
        foreach ($dic as $codi => $curs) 
        {
            $desc = $curs[0];
            $max_al = $curs[1];
            $vac = $curs[2];
            $preu = $curs[3];
            if(isset($curs["nom_imagen"]))
            {
                $nom_imatge = $curs["nom_imagen"];
                $ruta = $curs["foto_cliente"];
            }
            echo '<tr>';
            echo '<form method="post" action="?action=modificar">';
            echo "<td> <input type='text' id='codi' name='codi' required value='$codi' readonly> </td>";
            echo "<td> <input type='text' id='descripcio' name='descripcio' required value='$desc'> </td>";
            echo "<td> <input type='text' id='max_alumnes' name='max_alumnes' required value='$max_al'> </td>";
            echo "<td> <input type='text' id='vacants' name='vacants' required value='$vac'> </td>";
            echo "<td> <input type='text' id='preu' name='preu' required value='$preu'> </td>";
            if(isset($curs["nom_imagen"]))
            {
                echo "<td> <input type='text' id='nom_imagen' name='nom_imagen' required value='$nom_imatge' readonly> </td>";
                echo "<td> <input type='text' id='foto_cliente' name='foto_cliente' required value='$ruta' readonly> </td>";
            }
            else
            {
                echo "<td></td>";
                echo "<td></td>";
            }
            echo "<td> <button type='submit'>Modificar</button> </td>";
            echo '</form>';
            echo "<td> <a href='?action=borrar&curso=$codi' class='button'> <button>Borrar</button> </a> </td>";
            echo "<td> <button class='alumnes' value=$codi>Alumnes</button> </td>";
            echo '</tr>';
        }
    ?>
    </table>
    
    <table id="tabAlumnes">
    </table>
    
    <script>
        let elementArray = document.querySelectorAll(".alumnes");
        elementArray.forEach(function(elem)
        {
            elem.addEventListener('click', 
            async function(event)
            {   
                event.preventDefault();
                
                const response = await fetch('http://localhost/EI1042/portal/portal.php?action=llistarAlumnes&pet=partial&curso='+elem.value, {method: 'GET', credentials: 'include'});
                const res_llistat = await response.json();
                console.log(res_llistat);
                var taulaAlumnes = document.getElementById("tabAlumnes");
                taulaAlumnes.innerHTML="";
                for(var alumne in res_llistat)
                {
                    var codi = res_llistat[alumne][0];
                    var nom = res_llistat[alumne][1];
                    
                    var fila = taulaAlumnes.insertRow(-1);
                    var cell1 = fila.insertCell(0);
                    var cell2 = fila.insertCell(1);
                    
                    cell1.innerHTML = codi;
                    cell2.innerHTML = nom;
                } 
                console.log("")         
            }); 
        });
    </script>
</main>
