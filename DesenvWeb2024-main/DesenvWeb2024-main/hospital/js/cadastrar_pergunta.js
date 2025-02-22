function desativarPergunta(id) {
    if (confirm('Tem certeza que deseja desativar esta pergunta?')) {
        fetch('cadastrar_pergunta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'desativar_id=' + id
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Pergunta desativada com sucesso!');
                location.reload();
            } else {
                alert('Erro ao desativar a pergunta. Tente novamente.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao desativar a pergunta. Tente novamente.');
        });
    }
}

function ativarPergunta(id) {
    if (confirm('Tem certeza que deseja ativar esta pergunta?')) {
        fetch('cadastrar_pergunta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'ativar_id=' + id + '&novo_status=ATIVA'
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'success') {
                alert('Pergunta ativada com sucesso!');
                location.reload();
            } else {
                alert('Erro ao ativar a pergunta. Tente novamente.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao ativar a pergunta. Tente novamente.');
        });
    }
}

