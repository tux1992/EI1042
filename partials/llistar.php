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
        </tr>
    <?php
        foreach ($dic as $codi => $curs) 
        {
            echo '<tr>';
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
