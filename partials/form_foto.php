<main>
    <h1>Afegir Foto</h1>
    <form class="fom_usuario" action="?action=foto_upload" method="POST" enctype="multipart/form-data">
        <input type="text" name="name_foto" id="name" class="item_requerid" size="20" maxlength="25" value="Nom">
        <input type="file" accept="image/*" name="foto_cliente" id="upload">
        <input type="submit" value="Enviar">
        <input type="reset" value="Desfer">
    </form>
</main>    
