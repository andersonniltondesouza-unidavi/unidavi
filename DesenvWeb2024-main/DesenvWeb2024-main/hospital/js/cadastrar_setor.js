document.addEventListener('DOMContentLoaded', function() {
    const voltarButton = document.querySelector('.voltar-button');
    voltarButton.addEventListener('click', function() {
        window.location.href = 'admin_dashboard.html';
    });
});
