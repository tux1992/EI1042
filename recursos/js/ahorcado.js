const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');
const letrasIncorrectasElement = document.getElementById('letrasIncorrectas');
const resultadoElement = document.getElementById('resultado');
const reiniciarButton = document.getElementById('reiniciar');

const palabras = ['javascript', 'html', 'css', 'web', 'promesa', 'dom', 'programacion', 'php', 'lola'];
const palabraSeleccionada = palabras[Math.floor(Math.random() * palabras.length)];
const palabraActual = new Array(palabraSeleccionada.length).fill('_');
let intentosFallidos = 0;
const letrasIncorrectas = [];
const maxIntentos = 6;

function dibujarAhorcado() 
{
    ctx.beginPath();
    if (intentosFallidos >= 1) 
    {
        ctx.arc(125, 50, 20, 0, Math.PI * 2);
    }
    if (intentosFallidos >= 2) 
    {
        ctx.moveTo(125, 70);
        ctx.lineTo(125, 150);
    }
    if (intentosFallidos >= 3) 
    {
        ctx.moveTo(125, 90);
        ctx.lineTo(150, 120);
    }
    if (intentosFallidos >= 4) 
    {
        ctx.moveTo(125, 90);
        ctx.lineTo(100, 120);
    }
    if (intentosFallidos >= 5) 
    {
        ctx.moveTo(125, 150);
        ctx.lineTo(150, 200);
    }
    if (intentosFallidos >= 6) 
    {
        ctx.moveTo(125, 150);
        ctx.lineTo(100, 200);
    }
    ctx.stroke();
}

function dibujarPalabra() 
{
    ctx.font = '30px Arial';
    ctx.fillText(palabraActual.join(' '), 10, 230);
}

function dibujar() 
{
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    dibujarAhorcado();
    dibujarPalabra();
    letrasIncorrectasElement.textContent = letrasIncorrectas.join(', ');
}

function actualizarPalabra(letra) 
{
    for (let i = 0; i < palabraSeleccionada.length; i++) 
    {
        if (palabraSeleccionada[i] === letra) 
        {
            palabraActual[i] = letra;
        }
    }
}

function verificarFinJuego() 
{
    if (intentosFallidos === maxIntentos) 
    {
        resultadoElement.textContent = '¡Perdiste! La palabra era: ' + palabraSeleccionada;
        mostrarReiniciarButton();
    } 
    else if (!palabraActual.includes('_'))
    {
        resultadoElement.textContent = '¡Ganaste!';
        mostrarReiniciarButton();
    }
}

function reiniciarJuego() 
{
    location.reload();
}

function mostrarReiniciarButton() 
{
    reiniciarButton.style.display = 'block';
}

document.addEventListener('keydown', function (event) 
{
    const letra = event.key.toLowerCase();
    if (/^[a-z]$/.test(letra)) 
    {
        if (palabraSeleccionada.includes(letra)) 
        {
          actualizarPalabra(letra);
        } 
        else 
        {
          intentosFallidos++;
          letrasIncorrectas.push(letra);
        }
        dibujar();
        verificarFinJuego();
    }
});

reiniciarButton.addEventListener('click', function () 
{
    reiniciarJuego();
});

dibujar();

