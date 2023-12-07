var canvas = document.getElementById("gameCanvas");
var ctx = canvas.getContext("2d");
var greenCount = 0;
const resultadoElement = document.getElementById('resultat');

function getRandomNumber(min, max) 
{
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getRandomColor() 
{
    var letters = "0123456789ABCDEF";
    var color = "#";
    for (var i = 0; i < 6; i++) 
    {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return "#11FF11";
}

function drawRandomSquare(x, y, size, color) 
{
    ctx.fillStyle = color;
    ctx.fillRect(x, y, size, size);
}

function checkCollision(x, y, size) 
{
    var pixels = ctx.getImageData(x, y, size, size).data;
    console.log(pixels);
    for (var i = 0; i < pixels.length; i += 4) 
    {
        if (pixels[i] !== 0) 
        {
            return true; // Hay una colisión
        }
    }
    return false; // No hay colisión
}

canvas.addEventListener("click", function(event) 
{
    var rect = canvas.getBoundingClientRect();
    var mouseX = event.clientX - rect.left;
    var mouseY = event.clientY - rect.top;

    var size = getRandomNumber(20, 50);
    var color = getRandomColor();

    if (greenCount < 10) 
    {
        if (!checkCollision(mouseX, mouseY, size)) 
        {
            drawRandomSquare(mouseX, mouseY, size, color);
            if (color === "#11FF11") 
            {
                greenCount++;
                if (greenCount === 10) 
                {
                    resultadoElement.textContext = "Has guanyat! Has dibuixat 10 quadrats verds.";
                    alert("Has guanyat! Has dibuixat 10 quadrats verds.");
                }
            }
        } 
        else 
        {
            drawRandomSquare(mouseX, mouseY, size, "red");
        }
    } 
    else 
    {
        resultadoElement.textContent = "Ja has guanyat! Has dibuixat 10 quadrats verds.";
        alert("Ja has guanyat! Has dibuixat 10 quadrats verds.");
    }
});
