<aside id="weather-aside" class="temps">
    <p>Temps en Castellón de la Plana</p>
    <table border="1">
        <tr  id="tmax">
            <th>Temp Max (ºC)</th>      
        </tr>
        <tr id="tmin">
            <th>Temp Min (ºC)</th>
        </tr>
        <tr id="hmax">
            <th>Humitat Max (%)</th>
        </tr>
        <tr id="hmin">
            <th>Humitat Min (%)</th>
        </tr>
        <tr id="precip">
            <th>Pob precipitació (mm)</th>
        </tr>
    </table>
    
    <div>
        <img id="catImg"></img>
    </div>
    
    <script>
        // Utiliza JavaScript para obtener y mostrar los datos de la API
        async function loadTiempo()
        {
            const response = await fetch('https://www.el-tiempo.net/api/json/v1/provincias/12/municipios/12040/weather');
            const names = await response.json();
            //console.log(names);
            //console.log(names.prediccion.dia[0]);
            const dia = names.prediccion.dia[0];

            var row = document.getElementById("tmax");
            const tmaxCell = row.insertCell(-1);
            tmaxCell.textContent = dia.temperatura.maxima;
            
            row = document.getElementById("tmin");
            const tminCell = row.insertCell(-1);
            tminCell.textContent = dia.temperatura.minima;
            
            row = document.getElementById("hmax");
            const hmaxCell = row.insertCell(-1);
            hmaxCell.textContent = dia.humedad_relativa.maxima;
            
            row = document.getElementById("hmin");
            const hminCell = row.insertCell(-1);
            hminCell.textContent = dia.humedad_relativa.minima;
            
            row = document.getElementById("precip");
            const precipitacionCell = row.insertCell(-1);
            precipitacionCell.textContent = dia.prob_precipitacion[6];
        }
        loadTiempo();
        
        async function loadCat()
        {
            const response = await fetch('https://api.thecatapi.com/v1/images/search');
            const names = await response.json();
            //console.log(names[0]);
            var imagen = document.getElementById("catImg");
            imagen.src = names[0].url;
        }
        loadCat();
    </script>
</aside>
