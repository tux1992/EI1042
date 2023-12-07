function mostrarFoto(nodo, imagen) 
{
    var reader = new FileReader();
    reader.addEventListener("load", function () 
    {
        imagen.src = reader.result;
    });
    reader.readAsDataURL(nodo.files[0]);
}

function ready() 
{
    var imagen = null;
    var fichero = document.querySelector("#upload");
    var child = document.createElement("img");
    child.setAttribute("width", "600px");
    child.setAttribute("hight", "500px");
    child.setAttribute("background-color", "lightpink");
    child.setAttribute("id", "imagen");
    imagen = fichero.parentNode.appendChild(child);
    
    fichero.addEventListener("change", function (event)
    {
        if (fichero.files[0]["type"] == "image/png") 
        {
            mostrarFoto(this, imagen);
        }
        else 
        {
            alert("Seleccione una imagen PNG");
        }
    });
}

ready();
