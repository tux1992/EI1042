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
            echo '</tr>';
        }
    ?>
    </table>
    
    <table id="tabAlumnes">
    </table>
</main>
