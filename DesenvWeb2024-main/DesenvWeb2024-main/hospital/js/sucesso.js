document.addEventListener('DOMContentLoaded', function() {
    // Contador de 5 segundos
    let contador = 5;
    const elementoContador = document.getElementById('contador');
    const intervalo = setInterval(function() {
        if (contador > 1) {
            contador--;
            elementoContador.textContent = contador;
        } else {
            clearInterval(intervalo);
            redirecionar();
        }
    }, 1000);
});

function redirecionar() {
    window.location.href = '../Hospital/index.php';
}
