// --- I. ESTADO GLOBAL E CONFIGURAÇÕES PADRÃO ---

/**
 * Configurações padrão para NOVAS turmas.
 */
const DEFAULT_CONFIG = Object.freeze({
    baseTuition: 1000.00,
    dueDate: '2025-10-10',
    lateFeeRate: 0.05, // 5%
    maxDiscountCap: 0.30 // 30%
});

/**
 * O único estado mutável da aplicação.
 * Todas as funções de evento irão SUBSTITUIR este objeto, não modificá-lo.
 * appState = {
 * turmas: [ { id, name, config, students, results } ],
 * activeTurmaId: null
 * }
 */
let appState = {
    turmas: [],
    activeTurmaId: null
};

// --- II. FUNÇÕES PURAS - REGRAS DE NEGÓCIO E VALIDAÇÃO ---

/**
 * Valida os dados de entrada do formulário de aluno.
 * Função Pura.
 * @returns {object} - { valid: boolean, message?: string, data?: object }
 */
const validateStudentInput = (name, dateStr, scholarshipStr, familyDiscountStr) => {
    if (!name || name.trim() === '') {
        return { valid: false, message: 'O nome do aluno é obrigatório.' };
    }
    if (!dateStr || isNaN(new Date(dateStr).getTime())) {
        return { valid: false, message: 'A data de pagamento é inválida.' };
    }
    const scholarship = parseFloat(scholarshipStr);
    const familyDiscount = parseFloat(familyDiscountStr);
    if (isNaN(scholarship) || scholarship < 0 || scholarship > 100) {
        return { valid: false, message: 'O valor da bolsa deve ser um número entre 0 e 100.' };
    }
    if (isNaN(familyDiscount) || familyDiscount < 0 || familyDiscount > 100) {
        return { valid: false, message: 'O desconto família deve ser um número entre 0 e 100.' };
    }
    return {
        valid: true,
        data: {
            id: Date.now(),
            name: name.trim(),
            paymentDate: dateStr,
            discounts: [
                { type: 'scholarship', value: scholarship / 100 },
                { type: 'family_discount', value: familyDiscount / 100 }
            ]
        }
    };
};

/**
 * Valida os dados de entrada do formulário de configuração.
 * Função Pura.
 * @returns {object} - { valid: boolean, message?: string, data?: object }
 */
const validateTurmaConfigInput = (baseTuitionStr, dueDateStr, lateFeeRateStr, maxDiscountCapStr) => {
    const baseTuition = parseFloat(baseTuitionStr);
    const lateFeeRate = parseFloat(lateFeeRateStr) / 100; // Converte % para decimal
    const maxDiscountCap = parseFloat(maxDiscountCapStr) / 100; // Converte % para decimal

    if (isNaN(baseTuition) || baseTuition <= 0) {
        return { valid: false, message: 'Mensalidade base deve ser um número positivo.' };
    }
    if (!dueDateStr || isNaN(new Date(dueDateStr).getTime())) {
        return { valid: false, message: 'Data de vencimento inválida.' };
    }
    if (isNaN(lateFeeRate) || lateFeeRate < 0) {
        return { valid: false, message: 'Multa por atraso deve ser um número positivo.' };
    }
    if (isNaN(maxDiscountCap) || maxDiscountCap < 0 || maxDiscountCap > 1) {
        return { valid: false, message: 'Teto de desconto deve ser entre 0 e 100%.' };
    }

    return {
        valid: true,
        data: {
            baseTuition,
            dueDate: dueDateStr,
            lateFeeRate,
            maxDiscountCap
        }
    };
};


// (Funções puras de cálculo)
const isLate = (paymentDateStr, dueDateStr) => {
    // Adiciona 'T00:00:00' para garantir que a comparação seja de datas locais
    const paymentTime = new Date(paymentDateStr + 'T00:00:00').getTime();
    const dueTime = new Date(dueDateStr + 'T00:00:00').getTime();
    return paymentTime > dueTime;
};
const calculateTotalDiscountRate = (discounts) => discounts.reduce((total, discount) => total + discount.value, 0);
const applyDiscountCap = (totalDiscountRate, maxCap) => Math.min(totalDiscountRate, maxCap);
const calculateLateFee = (subtotal, isPaymentLate, lateFeeRate) => isPaymentLate ? subtotal * lateFeeRate : 0;

const processStudent = (student, config) => {
    const totalDiscountRate = calculateTotalDiscountRate(student.discounts);
    const effectiveDiscountRate = applyDiscountCap(totalDiscountRate, config.maxDiscountCap);
    const appliedDiscountValue = config.baseTuition * effectiveDiscountRate;
    const subtotal = config.baseTuition - appliedDiscountValue;
    const isPaymentLate = isLate(student.paymentDate, config.dueDate);
    const lateFeeValue = calculateLateFee(subtotal, isPaymentLate, config.lateFeeRate);
    const finalTuition = subtotal + lateFeeValue;
    return { ...student, baseTuition: config.baseTuition, appliedDiscount: appliedDiscountValue, lateFee: lateFeeValue, finalTuition: finalTuition, isLate: isPaymentLate };
};

// --- III. FUNÇÕES DE ORDEM SUPERIOR (HOF) - PROCESSAMENTO DE LOTE ---

const processClass = (studentList, config) => studentList.map(student => processStudent(student, config));

const calculateClassTotals = (processedStudents) => {
    const sumByProperty = (property) => (total, student) => total + student[property];
    const totalRevenue = processedStudents.reduce(sumByProperty('finalTuition'), 0);
    const totalDiscounts = processedStudents.reduce(sumByProperty('appliedDiscount'), 0);
    const totalLateFees = processedStudents.reduce(sumByProperty('lateFee'), 0);
    return { totalRevenue, totalDiscounts, totalLateFees };
};

// --- IV. FUNÇÕES IMPURAS - MANIPULAÇÃO DO DOM (RENDERIZAÇÃO) ---

const formatCurrency = (value) => value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

// Seletores do DOM
const createTurmaForm = document.getElementById('create-turma-form');
const newTurmaNameInput = document.getElementById('new-turma-name');
const turmaSelector = document.getElementById('turma-selector');
const turmaDetailsContainer = document.getElementById('turma-details-container');
const activeTurmaTitle = document.getElementById('active-turma-title');
const configForm = document.getElementById('config-form');
const configErrorDiv = document.getElementById('config-validation-error');
const studentForm = document.getElementById('student-form');
const studentErrorDiv = document.getElementById('validation-error');
const studentListUL = document.getElementById('student-list');
const processButton = document.getElementById('process-button');
const resultsDiv = document.getElementById('results');
const totalsDiv = document.getElementById('totals');

/**
 * Função de renderização principal.
 * Lê o 'appState' e atualiza o DOM inteiro.
 */
const render = () => {
    // 1. Renderiza o Seletor de Turmas
    turmaSelector.innerHTML = '<option value="">-- Nenhuma turma selecionada --</option>';
    appState.turmas.forEach(turma => {
        const option = document.createElement('option');
        option.value = turma.id;
        option.textContent = turma.name;
        if (turma.id === appState.activeTurmaId) {
            option.selected = true;
        }
        turmaSelector.appendChild(option);
    });

    // 2. Encontra a turma ativa
    const activeTurma = appState.turmas.find(t => t.id === appState.activeTurmaId);

    // 3. Renderiza o painel de detalhes da turma (ou oculta)
    if (activeTurma) {
        turmaDetailsContainer.style.display = 'grid';
        activeTurmaTitle.textContent = `Detalhes da Turma: ${activeTurma.name}`;
        
        // Renderiza o formulário de config
        document.getElementById('config-base').value = activeTurma.config.baseTuition;
        document.getElementById('config-due-date').value = activeTurma.config.dueDate;
        document.getElementById('config-late-fee').value = activeTurma.config.lateFeeRate * 100; // Converte para %
        document.getElementById('config-cap').value = activeTurma.config.maxDiscountCap * 100; // Converte para %
        
        // Renderiza a lista de alunos
        renderStudentList(activeTurma.students);
        
        // Renderiza os resultados (se existirem)
        renderResults(activeTurma.results);
    } else {
        turmaDetailsContainer.style.display = 'none';
        activeTurmaTitle.textContent = '';
    }
};

/**
 * Renderiza a lista de alunos da turma ativa.
 * @param {Array<object>} students - A lista de alunos da turma ativa.
 */
const renderStudentList = (students) => {
    studentListUL.innerHTML = '';
    if (!students || students.length === 0) {
        studentListUL.innerHTML = '<li>Nenhum aluno registrado.</li>';
        return;
    }
    students.forEach(student => {
        const li = document.createElement('li');
        const discountText = student.discounts.map(d => `${d.type}: ${d.value * 100}%`).join(', ');
        li.textContent = `${student.name} (Pagto: ${student.paymentDate}, Descontos: ${discountText})`;
        studentListUL.appendChild(li);
    });
};

/**
 * Renderiza os resultados da turma ativa.
 @param {object | null} results - O objeto de resultados da turma ativa.
 */
const renderResults = (results) => {
    resultsDiv.innerHTML = '';
    totalsDiv.innerHTML = '';

    if (!results) {
        resultsDiv.innerHTML = '<p>Processe a turma para ver os resultados.</p>';
        return;
    }

    const { processedStudents, totals } = results;

    processedStudents.forEach(student => {
        const studentCard = document.createElement('div');
        studentCard.className = 'student-result';
        studentCard.innerHTML = `
            <h4>${student.name}</h4>
            <p>Mensalidade Base: ${formatCurrency(student.baseTuition)}</p>
            <p>Descontos Aplicados: ${formatCurrency(student.appliedDiscount * -1)}</p>
            <p>Multa por Atraso: ${formatCurrency(student.lateFee)} (${student.isLate ? 'Sim' : 'Não'})</p>
            <p><strong>Total a Pagar: ${formatCurrency(student.finalTuition)}</strong></p>
        `;
        resultsDiv.appendChild(studentCard);
    });

    totalsDiv.innerHTML = `
        <p><strong>Receita Total (Líquida): ${formatCurrency(totals.totalRevenue)}</strong></p>
        <p>Total Concedido em Descontos: ${formatCurrency(totals.totalDiscounts)}</p>
        <p>Total Recebido em Multas: ${formatCurrency(totals.totalLateFees)}</p>
    `;
};

// --- V. FUNÇÕES IMPURAS - MANIPULADORES DE EVENTOS ---

/**
 * Atualiza o estado de forma IMUTÁVEL e chama a renderização.
 * Esta é a única função que deve REATRIBUIR o 'appState'.
 * @param {object} newState - O novo objeto de estado completo.
 */
const updateStateAndRender = (newState) => {
    appState = newState;
    render();
};

/**
 * Manipulador para criar uma nova turma.
 */
const handleCreateTurma = (e) => {
    e.preventDefault();
    const name = newTurmaNameInput.value.trim();
    if (!name) return;

    const newTurma = {
        id: Date.now(),
        name: name,
        config: { ...DEFAULT_CONFIG }, // Começa com uma CÓPIA da config padrão
        students: [],
        results: null // Sem resultados ainda
    };

    // ATUALIZAÇÃO IMUTÁVEL: Cria um novo array de turmas
    const newTurmas = [...appState.turmas, newTurma];
    
    // Atualiza o estado e define a nova turma como ativa
    updateStateAndRender({
        turmas: newTurmas,
        activeTurmaId: newTurma.id
    });
    
    newTurmaNameInput.value = '';
};

/**
 * Manipulador para selecionar uma turma ativa.
 */
const handleSelectTurma = (e) => {
    const newActiveId = e.target.value ? parseInt(e.target.value, 10) : null;
    
    // ATUALIZAÇÃO IMUTÁVEL: Cria um novo objeto de estado
    updateStateAndRender({
        ...appState,
        activeTurmaId: newActiveId
    });
};

/**
 * Manipulador para ATUALIZAR as configurações da turma ativa.
 */
const handleUpdateConfig = (e) => {
    e.preventDefault();
    if (!appState.activeTurmaId) return;

    // 1. Obter valores
    const baseTuitionStr = document.getElementById('config-base').value;
    const dueDateStr = document.getElementById('config-due-date').value;
    const lateFeeRateStr = document.getElementById('config-late-fee').value;
    const maxDiscountCapStr = document.getElementById('config-cap').value;

    // 2. Chamar função Pura de validação
    const validationResult = validateTurmaConfigInput(baseTuitionStr, dueDateStr, lateFeeRateStr, maxDiscountCapStr);

    if (!validationResult.valid) {
        configErrorDiv.textContent = validationResult.message;
        return;
    }
    
    configErrorDiv.textContent = '';
    const newConfig = validationResult.data;

    // 3. ATUALIZAÇÃO IMUTÁVEL com HOF 'map'
    // Criamos um NOVO array de turmas.
    const newTurmas = appState.turmas.map(turma => {
        if (turma.id === appState.activeTurmaId) {
            // Encontrou a turma? Retorna uma NOVA cópia dela com a config atualizada
            // e invalida os resultados antigos.
            return { ...turma, config: newConfig, results: null };
        }
        // Não é a turma ativa? Retorna ela mesma (imutável).
        return turma;
    });

    updateStateAndRender({
        ...appState,
        turmas: newTurmas
    });
    
    alert('Configurações atualizadas! Os resultados anteriores foram invalidados.');
};

/**
 * Manipulador para adicionar um aluno à turma ativa.
 */
const handleAddStudent = (e) => {
    e.preventDefault();
    if (!appState.activeTurmaId) return;

    studentErrorDiv.textContent = '';
    const name = document.getElementById('student-name').value;
    const date = document.getElementById('payment-date').value;
    const scholarship = document.getElementById('scholarship').value;
    const familyDiscount = document.getElementById('family-discount').value;

    const validationResult = validateStudentInput(name, date, scholarship, familyDiscount);

    if (!validationResult.valid) {
        studentErrorDiv.textContent = validationResult.message;
        return;
    }

    const newStudent = validationResult.data;

    // ATUALIZAÇÃO IMUTÁVEL com HOF 'map'
    const newTurmas = appState.turmas.map(turma => {
        if (turma.id === appState.activeTurmaId) {
            // Retorna uma NOVA cópia da turma, com um NOVO array de alunos
            // (contendo o aluno novo) e invalida os resultados.
            return {
                ...turma,
                students: [...turma.students, newStudent],
                results: null
            };
        }
        return turma;
    });

    updateStateAndRender({
        ...appState,
        turmas: newTurmas
    });
    
    studentForm.reset();
};

/**
 * Manipulador para processar a turma ativa.
 */
const handleProcessClass = () => {
    if (!appState.activeTurmaId) return;

    const activeTurma = appState.turmas.find(t => t.id === appState.activeTurmaId);
    if (!activeTurma || activeTurma.students.length === 0) {
        alert('Adicione pelo menos um aluno para processar.');
        return;
    }

    // 1. Chamar funções puras de processamento
    const processedStudents = processClass(activeTurma.students, activeTurma.config);
    const totals = calculateClassTotals(processedStudents);
    const newResults = { processedStudents, totals };

    // 2. ATUALIZAÇÃO IMUTÁVEL com HOF 'map'
    const newTurmas = appState.turmas.map(turma => {
        if (turma.id === appState.activeTurmaId) {
            // Retorna uma NOVA cópia da turma com os resultados atualizados.
            return { ...turma, results: newResults };
        }
        return turma;
    });

    updateStateAndRender({
        ...appState,
        turmas: newTurmas
    });
};

/**
 * Função de inicialização.
 */
const init = () => {
    // Anexa ouvintes de eventos
    createTurmaForm.addEventListener('submit', handleCreateTurma);
    turmaSelector.addEventListener('change', handleSelectTurma);
    configForm.addEventListener('submit', handleUpdateConfig);
    studentForm.addEventListener('submit', handleAddStudent);
    processButton.addEventListener('click', handleProcessClass);
    
    // Renderiza o estado inicial (vazio)
    render();
};

// Inicia a aplicação
init();