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
            echo '<tr>';
            echo '<form method="post" action="?action=modificar">';
            echo "<td> <input type='text' id='codi' name='codi' required value='$codi' readonly> </td>";
            echo "<td> <input type='text' id='descripcio' name='descripcio' required value='$desc'> </td>";
            echo "<td> <input type='text' id='max_alumnes' name='max_alumnes' required value='$max_al'> </td>";
            echo "<td> <input type='text' id='vacants' name='vacants' required value='$vac'> </td>";
            echo "<td> <input type='text' id='preu' name='preu' required value='$preu'> </td>";
            echo "<td> <button type='submit'>Modificar</button> </td>";
            echo '</form>';
            echo "<td> <a href='?action=borrar&curso=$codi' class='button'> <button>Borrar</button> </a> </td>";
            echo '</tr>';
        }
    ?>
    </table>
</main>
