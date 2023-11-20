<aside class="gallery-section">
    <?php
        $carpetaImagenes = './media/fotos/';
        $archivos = scandir($carpetaImagenes);
        $archivos = array_diff($archivos, array('..', '.'));
        $imagenAleatoria = $carpetaImagenes . $archivos[array_rand($archivos)];
    ?>

    <!-- Llista on es mostren les 9 imatges  seleccionades aleatoriament de la llista-->
    <ul class="gallery-list">
        <li class="gallery-list">
            <?php
                $imagenAleatoria1 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria1; ?>" alt="Imagen Aleatoria1">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria2 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria2; ?>" alt="Imagen Aleatoria2">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria3 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria3; ?>" alt="Imagen Aleatoria3">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria4 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria4; ?>" alt="Imagen Aleatoria4">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria5 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria5; ?>" alt="Imagen Aleatoria5">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria6 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria6; ?>" alt="Imagen Aleatoria6">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria7 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria7; ?>" alt="Imagen Aleatoria7">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria8 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria8; ?>" alt="Imagen Aleatoria8">
        </li>
        
        <li class="gallery-list">
            <?php
                $imagenAleatoria9 = $carpetaImagenes . $archivos[array_rand($archivos)];
            ?>
            <img src="<?php echo $imagenAleatoria9; ?>" alt="Imagen Aleatoria9">
        </li>
    </ul>
                                                                
    <!-- 
    <ul class="gallery-list">
        <li class="gallery-list">
            <img src="media/galeria/esgrima.jpg" alt="esgrima"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/biblioteca.jpg" alt="biblioteca"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/basket.jpg" alt="basket"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/futbol.jpg" alt="futbol"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/golf.jpg" alt="golf"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/invernadero.png" alt="invernadero"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/labrobotica.jpg" alt="labrobotica"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/padel.jpg" alt="padel"/>
        </li>
        <li class="gallery-list">
            <img src="media/galeria/piscina.jpg" alt="piscina"/>
        </li>
    </ul>
    -->
</aside>
