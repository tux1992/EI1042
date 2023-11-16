<main>
    <h1>Afegir Curs</h1>
    <form id="curs-form">
        <label for="codi">Codi:</label>
        <input type="text" id="codi" name="codi" required><br>

        <label for="descripcio">Descripció:</label>
        <input type="text" id="descripcio" name="descripcin" required><br>

        <label for="max_alumnes">Nombre Màxim d'Alumnes:</label>
        <input type="number" id="max_alumnes" name="max_alumnes" required min="1"><br>

        <label for="vacants">Places Vacants:</label>
        <input type="number" id="vacants" name="vacants" required min="1"><br>

        <label for="preu">Preu:</label>
        <input type="text" id="preu" name="preu" required><br>

        <button type="submit">Afegir Curs</button>
    </form>
</main>
