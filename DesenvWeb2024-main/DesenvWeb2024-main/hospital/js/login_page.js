document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form');
    loginForm.addEventListener('submit', function(event) {
        const usuario = document.getElementById('usuario').value;
        const senha = document.getElementById('senha').value;

        if (!usuario || !senha) {
            alert('Por favor, preencha todos os campos antes de entrar.');
            event.preventDefault();
        }
    });
});
