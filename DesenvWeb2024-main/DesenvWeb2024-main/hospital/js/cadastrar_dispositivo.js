document.addEventListener('DOMContentLoaded', function() {
    const voltarButton = document.querySelector('.voltar-button');
    voltarButton.addEventListener('click', function() {
        window.location.href = 'admin_dashboard.html';
    });
});

function desativarDispositivo(id) {
    if (confirm('Tem certeza que deseja desativar este dispositivo?')) {
        fetch('cadastrar_dispositivo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'desativar_id=' + id
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Dispositivo desativado com sucesso!');
                location.reload();
            } else {
                alert('Erro ao desativar o dispositivo. Tente novamente.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao desativar o dispositivo. Tente novamente.');
        });
    }
}

function ativarDispositivo(id) {
    if (confirm('Tem certeza que deseja ativar este dispositivo?')) {
        fetch('cadastrar_dispositivo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'ativar_id=' + id
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Dispositivo ativado com sucesso!');
                location.reload();
            } else {
                alert('Erro ao ativar o dispositivo. Tente novamente.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao ativar o dispositivo. Tente novamente.');
        });
    }
}