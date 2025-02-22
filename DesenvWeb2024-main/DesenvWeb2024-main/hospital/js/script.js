function selecionarNota(perguntaId, nota) {
    // Remove a seleção de todos os botões da pergunta
    const botoes = document.querySelectorAll(`.notas-container[data-pergunta-id="${perguntaId}"] .botao-nota`);
    botoes.forEach(botao => {
        botao.classList.remove("botao-selecionado");
    });

    const botaoSelecionado = document.querySelector(`.botao-nota[data-pergunta-id="${perguntaId}"][data-nota="${nota}"]`);
    botaoSelecionado.classList.add("botao-selecionado");

    document.getElementById(`nota-${perguntaId}`).value = nota;
    document.getElementById(`nota-${perguntaId}`).setAttribute("data-selecionado", "true"); // Marca como selecionado
}

let perguntaAtual = 0;

function mostrarProximaPergunta() {
    const totalPerguntas = document.querySelectorAll(".pergunta").length;

    // Oculta a pergunta atual
    document.getElementById(`pergunta-${perguntaAtual}`).style.display = 'none';

    // Incrementa para a próxima pergunta
    perguntaAtual++;

    // Exibe a próxima pergunta
    document.getElementById(`pergunta-${perguntaAtual}`).style.display = 'block';

    // Controla a visibilidade dos botões
    ajustarBotoes(totalPerguntas);
}

function mostrarPerguntaAnterior() {
    // Oculta a pergunta atual
    document.getElementById(`pergunta-${perguntaAtual}`).style.display = 'none';

    // Decrementa para a pergunta anterior
    perguntaAtual--;

    // Exibe a pergunta anterior
    document.getElementById(`pergunta-${perguntaAtual}`).style.display = 'block';

    // Controla a visibilidade dos botões
    ajustarBotoes(document.querySelectorAll(".pergunta").length);
}

//Função para ajustar os botões conforme passam as perguntas
function ajustarBotoes(totalPerguntas) {
    document.querySelector(".anterior-pergunta").style.display = perguntaAtual > 0 ? 'inline-block' : 'none';
    document.querySelector(".proxima-pergunta").style.display = perguntaAtual < totalPerguntas - 1 ? 'inline-block' : 'none';
    document.querySelector(".enviar").style.display = perguntaAtual === totalPerguntas - 1 ? 'inline-block' : 'none';
}

function validarFormulario() {
    const camposNotas = document.querySelectorAll("input[name^='notas']");
    let todasRespondidas = true;

    // Verifica se cada campo de nota foi preenchido
    camposNotas.forEach((notaInput) => {
        if (!notaInput.value) {
            todasRespondidas = false;
        }
    });

    if (!todasRespondidas) {
        alert("Por favor, responda todas as perguntas antes de enviar a avaliação.");
        return false;
    }

    return true; 
}
   





