document.addEventListener('DOMContentLoaded', function() {
    const confirmarButton = document.querySelector('.botao-confirmar');
    confirmarButton.addEventListener('click', function() {
        const dispositivoSelecionado = document.getElementById('dispositivo').value;
        if (!dispositivoSelecionado) {
            alert('Por favor, selecione um dispositivo antes de confirmar.');
            event.preventDefault();
        }
    });
});
