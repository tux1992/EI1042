<main>
    <h1>Afegir Curs</h1>
    <form id="curs-form" method="post" action="?action=registrar" enctype="multipart/form-data">
        <label for="codi">Codi:</label>
        <input type="text" id="codi" name="codi" required><br>

        <label for="descripcio">Descripció:</label>
        <input type="text" id="descripcio" name="descripcio" required><br>

        <label for="max_alumnes">Nombre Màxim d'Alumnes:</label>
        <input type="number" id="max_alumnes" name="max_alumnes" required min="1"><br>

        <label for="vacants">Places Vacants:</label>
        <input type="number" id="vacants" name="vacants" required min="1"><br>

        <label for="preu">Preu:</label>
        <input type="text" id="preu" name="preu" required><br>
        
        <label for="preu">Imatge del curs:</label>
        <input type="text" name="name_foto" id="name" class="item_requerid" size="20" maxlength="25" value="Nom">
        <input type="file" accept="image/*" name="foto_cliente" id="upload">

        <button type="submit">Afegir Curs</button>
    </form>
</main>
