function mostrarFoto(nodo, imagen) {
  var reader = new FileReader();
  reader.addEventListener("load", function () {
    imagen.src = reader.result;
  });
  reader.readAsDataURL(nodo.files[0]);
}

function getMousePos(canvas, evt) {
  var rect = canvas.getBoundingClientRect();
  return {
    x: evt.clientX - rect.left,
    y: evt.clientY - rect.top,
  };
}

function limpiar(context, canvas) {
  context.clearRect(0, 0, canvas.width, canvas.height);
}


function activarCanvas(imagen){
   var canvas = document.querySelector("#sketchpad");
   var context = canvas.getContext("2d");
   
   var drawer = {
				isDrawing: false,
				mousedown: function (coors) {
					context.beginPath();
					context.moveTo(coors.x, coors.y);
					this.isDrawing = true;
				},
				mousemove: function (coors) {
					if (this.isDrawing) {
						context.lineTo(coors.x, coors.y);
						context.stroke();
					}
				},
				mouseup: function (coors) {
					if (this.isDrawing) {
						this.mousemove(coors);
						this.isDrawing = false;
					}
				}
			}
   canvas.addEventListener('mousedown', function (evt) {
				drawer[evt.type](getMousePos(canvas, evt));
			}, false);
			canvas.addEventListener('mousemove', function (evt) {
				drawer[evt.type](getMousePos(canvas, evt));
			}, false);
			canvas.addEventListener('mouseup', function (evt) {
				drawer[evt.type](getMousePos(canvas, evt));
			}, false); 
			  
   document.querySelector("#copiar").addEventListener("click", function () {
     context.drawImage(imagen, 0, 0, 200, 100);
   });
   document.querySelector("#limpiar").addEventListener("click", function () {
     limpiar(context, canvas);
   });
   document.querySelector("#guardar").addEventListener("click", function () {
     imagen.src = canvas.toDataURL("image/png");
   });
}

function ready() {
  var imagen = null;
  var fichero = document.querySelector("#foto");
  var child = document.createElement("img");
  child.setAttribute("width", "400px");
  child.setAttribute("hight", "200px");
  child.setAttribute("background-color", "lightblue");
  child.setAttribute("id", "imagen");
  imagen = fichero.parentNode.appendChild(child);
  fichero.addEventListener("change", function (event) {
    if (fichero.files[0]["type"] == "image/png") 
      {mostrarFoto(this, imagen);
      }
    else alert("Seleccione una imagen PNG");
  });
  
  activarCanvas(imagen);


}

ready();
