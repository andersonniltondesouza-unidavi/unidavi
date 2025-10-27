# Projeto: Gestão de Mensalidades Escolares (Multi-Turmas)

Este projeto é uma aplicação web para calcular os valores de mensalidades escolares, permitindo o gerenciamento de múltiplas turmas, cada uma com suas próprias configurações de negócio (mensalidade, vencimento, multas, descontos).

O objetivo principal é demonstrar a aplicação de conceitos de Programação Funcional (PF) em JavaScript, como funções puras, imutabilidade e funções de ordem superior (`map`, `reduce`), para gerenciar um estado de aplicação complexo de forma previsível e segura.

**Desenvolvido por:**
* Anderson Nilton de Souza (`@andersonniltondesouza-unidavi`)
* Gabriel Wellington Renzi (`@GabrielRenzi`)

---

## Como Executar a Aplicação

A aplicação é 100% front-end e não requer instalação de dependências ou um servidor.

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/andersonniltondesouza-unidavi/mensalidade_escolar]
    ```
2.  **Acesse o diretório:**
    ```bash
    cd [mensalidade_escolar]
    ```
3.  **Abra o arquivo `index.html`:**
    Basta clicar duas vezes no arquivo `index.html` ou abri-lo diretamente em qualquer navegador web

---

## Funcionamento da Aplicação

A interface é dividida em dois painéis principais:

1.  **Gerenciar Turmas (Painel Esquerdo):**
    * **Criar Turma:** Permite que o usuário crie uma nova turma com um nome
    * **Selecionar Turma Ativa:** Um menu dropdown que lista todas as turmas criadas. Selecionar uma turma neste menu carrega seus dados no painel principal.

2.  **Detalhes da Turma (Painel Principal):**
    Este painel só é exibido quando uma turma está selecionada e contém todas as informações *dessa turma específica*.
    * **Configurações da Turma:** Um formulário para **alterar** as regras de negócio da turma ativa (Mensalidade Base, Vencimento, Multa, Teto de Desconto).
    * **Registrar Aluno:** Adiciona um novo aluno (com seus descontos e data de pagamento) à lista da turma ativa.
    * **Alunos Registrados:** Lista todos os alunos adicionados *apenas* à turma ativa.
    * **Resultados do Processamento:** Após clicar em "Processar Turma", esta seção exibe o detalhamento do cálculo para cada aluno (total por aluno) e os valores agregados (total por turma), com base nas configurações *atuais* da turma.   

---

## Aplicação dos Conceitos de Programação Funcional

Este projeto separa rigorosamente a lógica de negócio (funcional e pura) da lógica de interface (imperativa e impura). O núcleo da aplicação (`app.js`) gira em torno de um único objeto de estado (`appState`) que é tratado como **imutável**.

### 1. Funções Puras e Imutabilidade

Todas as funções de cálculo e validação são puras. Elas não modificam variáveis globais e sempre retornam um novo valor com base em suas entradas.

* `validateStudentInput(...)` e `validateTurmaConfigInput(...)`: Funções puras de validação.
* `isLate(...)`, `calculateLateFee(...)`, `applyDiscountCap(...)`: Funções puras de regras de negócio.
* `processStudent(...)`: Função pura principal que compõe outras funções para calcular o valor final de um aluno, retornando um **novo objeto** sem modificar o aluno original.

**Gerenciamento de Estado Imutável:**
O estado global `appState` nunca é modificado diretamente. Quando o usuário realiza uma ação (como adicionar um aluno ou atualizar uma configuração), nós:
1.  Criamos um **novo objeto** `appState` (usando `...appState`).
2.  Usamos a função de ordem superior `map` para criar um **novo array** de turmas.
3.  Dentro do `map`, substituímos a turma que foi alterada por uma **nova cópia** dela (usando `...turma`).
4.  Substituímos o estado antigo pelo novo (`updateStateAndRender(newState)`).

### 2. Funções de Ordem Superior (Higher-Order Functions)

Usamos `map` e `reduce` extensivamente, não apenas para processar dados, mas principalmente para o **gerenciamento de estado imutável**.

* **`map` (Para Gerenciamento de Estado):**
    Esta é a técnica central da aplicação. Quando precisamos atualizar a configuração de UMA turma dentro do array `appState.turmas`, evitamos mutação usando `map`:

    ```javascript
    // Exemplo de como atualizamos uma configuração de forma imutável
    const newConfig = validationResult.data;
    const newTurmas = appState.turmas.map(turma => {
        if (turma.id === appState.activeTurmaId) {
            // Retorna uma CÓPIA NOVA da turma com a config atualizada
            return { ...turma, config: newConfig, results: null };
        }
        // Retorna a turma original, intocada
        return turma;
    });
    // O novo estado é construído com o novo array
    updateStateAndRender({ ...appState, turmas: newTurmas });
    ```
    O mesmo padrão é usado em `handleAddStudent` e `handleProcessClass`.

* **`map` (Para Processamento de Dados):**
    Usado em `processClass(students, config)` para aplicar a função pura `processStudent` a cada aluno, retornando um novo array de resultados.

* **`reduce`:**
    Usado em `calculateTotalDiscountRate` (para somar os descontos de um aluno) e `calculateClassTotals` (para agregar os totais da turma).

### 3. Validação como Função Pura

As funções `validateStudentInput` e `validateTurmaConfigInput` são puras. Elas recebem os valores (strings) do formulário, verificam se são números positivos (`isNaN`, `> 0`, etc.) e retornam um objeto de resultado (`{ valid: boolean, ... }`). Elas não interagem com o DOM (ex: exibindo um `alert`). A função impura (o manipulador de evento) é quem lê esse objeto e decide o que exibir ao usuário.

---

## Exemplos de Entrada e Saída

O cenário de teste abaixo se aplica a **uma turma** específica. Você pode criar outras turmas com configurações diferentes para ver resultados diferentes.

**Cenário de Teste (Turma A):**

* **Configurações da Turma A:**
    * Mensalidade Base: R$ 1000,00
    * Vencimento: 10/10/2025
    * Multa por Atraso: 5%
    * Teto de Desconto: 30%

**1. Aluno 1: Anderson (Pagamento em dia, desconto alto)**
* **Entrada:**
    * Nome: Anderson
    * Pagamento: 05/10/2025 (em dia)
    * Bolsa: 20%
    * Família: 15%
* **Processamento (Regras da Turma A):**
    * Desconto Total: 20% + 15% = 35%
    * Desconto Efetivo (Teto): 30% (R$ 300)
    * Subtotal: R$ 1000 - R$ 300 = R$ 700
    * Multa: R$ 0 (em dia)
* **Saída (Anderson): Total a Pagar: R$ 700,00**

**2. Aluno 2: Gabriel (Pagamento atrasado, desconto baixo)**
* **Entrada:**
    * Nome: Gabriel
    * Pagamento: 15/10/2025 (atrasado)
    * Bolsa: 10%
    * Família: 0%
* **Processamento (Regras da Turma A):**
    * Desconto Total: 10%
    * Desconto Efetivo: 10% (R$ 100)
    * Subtotal: R$ 1000 - R$ 100 = R$ 900
    * Multa: 5% de R$ 900 = R$ 45
* **Saída (Gabriel): Total a Pagar: R$ 945,00**

**3. Saída (Totais da Turma A)**
* Receita Total: R$ 700 + R$ 945 = **R$ 1.645,00**
* Total Descontos: R$ 300 + R$ 100 = **R$ 400,00**
* Total Multas: R$ 0 + R$ 45 = **R$ 45,00**