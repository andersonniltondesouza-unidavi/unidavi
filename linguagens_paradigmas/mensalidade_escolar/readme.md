# Projeto: Cálculo de Mensalidade Escolar (Abordagem Funcional)

Este projeto é uma aplicação web para calcular os valores de mensalidades escolares de uma turma, aplicando regras de negócio como descontos, multas por atraso e teto de descontos.

O objetivo principal é demonstrar a aplicação de conceitos de Programação Funcional (PF) em JavaScript, como funções puras, imutabilidade e funções de ordem superior (`map`, `reduce`).

**Desenvolvido por:**
* `@[andersonniltondesouza-unidavi]`
* `@[GabrielRenzi]`

---

## Como Executar a Aplicação

A aplicação é 100% front-end e não requer instalação de dependências ou um servidor.

1.  **Clone o repositório:**
    ```bash
    git clone [URL-DO-SEU-REPOSITORIO]
    ```
2.  **Acesse o diretório:**
    ```bash
    cd [NOME-DO-SEU-REPOSITORIO]
    ```
3.  **Abra o arquivo `index.html`:**
    Basta clicar duas vezes no arquivo `index.html` ou abri-lo diretamente em qualquer navegador web (Chrome, Firefox, etc.).

---

## Funcionamento da Aplicação

A interface é dividida em quatro seções principais:

1.  **Configurações da Turma:** Exibe as regras de negócio imutáveis (Mensalidade Base, Vencimento, Multa, Teto de Desconto).
2.  **Registrar Aluno:** Um formulário para adicionar alunos à lista. Os dados de entrada são validados antes de serem adicionados.
3.  **Alunos Registrados (Entrada):** Uma lista dos alunos que serão processados.
4.  **Resultados do Processamento (Saída):** Após clicar em "Processar Turma", esta seção exibe o detalhamento do cálculo para cada aluno (total por aluno) e os valores agregados da turma (total por turma).

---

## Aplicação dos Conceitos de Programação Funcional

Este projeto separa claramente a "lógica de negócio" (funcional e pura) da "lógica de interface" (imperativa e impura). Toda a lógica de cálculo está em `app.js` como funções puras.

### 1. Funções Puras e Imutabilidade

Todas as funções que realizam cálculos ou validações são puras. Elas não modificam variáveis globais, não alteram seus argumentos (imutabilidade) e sempre retornam o mesmo resultado para as mesmas entradas.

**Exemplos de Funções Puras:**

* `validateStudentInput(name, date, ...)`: Recebe os valores do formulário e retorna um objeto `{ valid: boolean, ... }`. Não modifica o DOM.
* `isLate(paymentDate, dueDate)`: Retorna `true` ou `false` com base apenas nas datas de entrada.
* `calculateTotalDiscountRate(discounts)`: Recebe um array e retorna um número, sem alterar o array original.
* `applyDiscountCap(rate, cap)`: Retorna um número.
* `calculateLateFee(subtotal, isLate, rate)`: Retorna o valor da multa.
* `processStudent(student, config)`: Esta é a principal função de composição. Ela recebe o objeto `student` original e retorna um **novo objeto** contendo os resultados, sem jamais modificar o objeto `student` de entrada (princípio da imutabilidade).

### 2. Funções de Ordem Superior (Higher-Order Functions)

Usamos `map` e `reduce` extensivamente para processar as listas de dados, evitando loops `for` imperativos.

* **`map`:**
    A função `processClass(students, config)` usa `map` para transformar a lista de alunos de entrada em uma nova lista de alunos processados.
    ```javascript
    const processClass = (studentList, config) =>
        studentList.map(student => processStudent(student, config));
    ```
    Isso aplica a função pura `processStudent` a cada item da lista, gerando uma nova lista de resultados.

* **`reduce`:**
    Usamos `reduce` para agregar valores:
    1.  Em `calculateTotalDiscountRate(discounts)`: Para somar todas as taxas de desconto de um aluno.
        ```javascript
        discounts.reduce((total, discount) => total + discount.value, 0);
        ```
    2.  Em `calculateClassTotals(processedStudents)`: Para calcular os totais de receita, descontos e multas da turma inteira.
        ```javascript
        processedStudents.reduce((total, student) => total + student.finalTuition, 0);
        ```

### 3. Validação como Função Pura

A validação das entradas do usuário (`validateStudentInput`) é implementada como uma função pura. Ela não exibe o erro diretamente no DOM. Em vez disso, ela retorna um objeto de resultado.

O manipulador de eventos (que é impuro) lê esse objeto e, *ele sim*, decide se deve atualizar o DOM com a mensagem de erro ou adicionar o aluno ao estado. Isso mantém a lógica de validação testável e isolada de efeitos colaterais.

---

## Exemplos de Entrada e Saída

**Cenário de Teste:**

* **Configurações:** Base R$ 1000, Vencimento 10/10/2025, Multa 5%, Teto Desconto 30%.

**1. Aluno 1: Alice (Pagamento em dia, desconto alto)**
* **Entrada:**
    * Nome: Alice
    * Pagamento: 05/10/2025 (em dia)
    * Bolsa: 20%
    * Família: 15%
* **Processamento:**
    * Desconto Total: 20% + 15% = 35%
    * Desconto Efetivo (Teto): 30% (R$ 300)
    * Subtotal: R$ 1000 - R$ 300 = R$ 700
    * Multa: R$ 0 (em dia)
* **Saída (Alice): Total a Pagar: R$ 700,00**

**2. Aluno 2: Bob (Pagamento atrasado, desconto baixo)**
* **Entrada:**
    * Nome: Bob
    * Pagamento: 15/10/2025 (atrasado)
    * Bolsa: 10%
    * Família: 0%
* **Processamento:**
    * Desconto Total: 10%
    * Desconto Efetivo: 10% (R$ 100)
    * Subtotal: R$ 1000 - R$ 100 = R$ 900
    * Multa: 5% de R$ 900 = R$ 45
* **Saída (Bob): Total a Pagar: R$ 945,00**

**3. Saída (Totais da Turma)**
* Receita Total: R$ 700 + R$ 945 = **R$ 1.645,00**
* Total Descontos: R$ 300 + R$ 100 = **R$ 400,00**
* Total Multas: R$ 0 + R$ 45 = **R$ 45,00**