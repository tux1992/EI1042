<main>
    <h1>Matrícula en Curs</h1>
    <form id="curs-form" method="post" enctype="multipart/form-data">
        <label for="codiCurs">Curs:</label>
        <select name="id_curs" id="codiCurs"></select>
        <label for="vacants">Vacants:</label>
        <input type="text" name="vacants" id="vacants" readonly></select>
        <label for="preu">Preu:</label>
        <input type="text" name="preu" id="preu" readonly></select>
        <button type="submit">Matricularme al Curs</button>
    </form>
    <script>
        async function llistarCursos()
        {
            const response = await fetch('http://localhost/EI1042/portal/portal.php?action=cursosDisponibles&pet=partial', {method: 'GET', credentials: 'include'});
            const cursos = await response.json();
            console.log(cursos);
            var select = document.getElementById("codiCurs");

            for(var cursoKey in cursos)
            {
                datosCurso = cursos[cursoKey];
                var option = document.createElement("option");
                option.value = cursoKey;
                option.text = datosCurso[0];
                select.add(option);
            }
            var vacants = document.getElementById("vacants");
            vacants.value = Object.values(cursos)[0][2];
            var preu = document.getElementById("preu");
            preu.value = Object.values(cursos)[0][3];
            return cursos;
        }
        llistarCursos();
        
        var curs_select = document.getElementById("codiCurs");
        curs_select.addEventListener
        ('change',async function()
            {                
                const response = await fetch('http://localhost/EI1042/portal/portal.php?action=cursosDisponibles&pet=partial', {method: 'GET', credentials: 'include'});
                const cursos = await response.json();
                
                var vacants = document.getElementById("vacants");
                vacants.value = cursos[this.value][2];
                var preu = document.getElementById("preu");
                preu.value = cursos[this.value][3];
            },
            false
        );
        
        var matriculaCurs = document.getElementById("curs-form");
        matriculaCurs.addEventListener
        ('submit',async function()
            {                
                var curs_select = document.getElementById("codiCurs");
                var codi = curs_select.value;
                const response = await fetch('http://localhost/EI1042/portal/portal.php?action=matriculaCursos&pet=partial&curso='+codi, {method: 'POST', credentials: 'include'});
                const res_matricula = await response.json();
                
                if(res_matricula.matricula == 'correcta')
                {
                    alert("Matrícula correcta!\n" + "Usuari: " + res_matricula.usuari + " Curs: " + res_matricula.curs);
                }
                else
                {
                    alert("Matrícula incorrecta!\n" + "Usuari: " + res_matricula.usuari + " Curs: " + res_matricula.curs);
                }
            },
            false
        );
        
        
    </script>
</main>
