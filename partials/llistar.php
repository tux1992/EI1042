<main>
    <h1>Llistat de Cursos</h1>
    <?php
        $dic = carregar_dades("./recursos/cursos.json");
    ?>
    <table>
        <tr>
            <th>Imatge</th>
            <th>Codi</th>
            <th>Descripció</th>
            <th>Nombre Màxim d'Alumnes</th>
            <th>Places Vacants</th>
            <th>Preu Trimestre</th>            
        </tr>
    <?php
        foreach ($dic as $codi => $curs) 
        {
            echo '<tr>';
            if(isset($curs["nom_imagen"]))
            {
                $ruta = "./media/fotos/".$curs["nom_imagen"];
                echo "<td><img src=$ruta alt='logo' border=3 height=50 width=50></img></td>";
            } 
            else
            {
                echo "<td></td>";
            }           
            echo '<td>' . $codi . '</td>';
            echo '<td>' . $curs[0] . '</td>';
            echo '<td>' . $curs[1] . '</td>';
            echo '<td>' . $curs[2] . '</td>';
            echo '<td>' . $curs[3] . '</td>';
            echo '</tr>';
        }
    ?>
    </table>
</main>
