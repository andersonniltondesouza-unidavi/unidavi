function adicionaColuna() {
    var tabela = document.querySelector('table');
  
    var novoCabecalho = document.createElement('th');
    novoCabecalho.textContent = 'Soma das Notas';
  
    tabela.rows[1].insertCell();
    tabela.rows[1].cells[tabela.rows[1].cells.length - 1].appendChild(novoCabecalho);
  
    var novoCabecalhoMedia = document.createElement('th');
    novoCabecalhoMedia.textContent = 'Média';
  
    tabela.rows[1].insertCell(-1);
    tabela.rows[1].cells[tabela.rows[1].cells.length - 1].appendChild(novoCabecalhoMedia);
  
    for (var i = 2; i < tabela.rows.length; i++) {
      var novaCelulaSoma = document.createElement('td');
      var novaCelulaMedia = document.createElement('td');
      var somaNotas = 0;
  
      for (var j = 1; j < tabela.rows[i].cells.length; j++) { 
          somaNotas += parseFloat(tabela.rows[i].cells[j].textContent);
        
      }
  
      novaCelulaSoma.textContent = somaNotas;
  
      var media = somaNotas / 9;
  
      novaCelulaMedia.textContent = media.toFixed(2);
  
      tabela.rows[i].insertCell();
      tabela.rows[i].cells[tabela.rows[i].cells.length - 1].appendChild(novaCelulaSoma);
  
      tabela.rows[i].insertCell();
      tabela.rows[i].cells[tabela.rows[i].cells.length - 1].appendChild(novaCelulaMedia);
    }
  }


function adicionaLinha() {
  const table = document.querySelector('table');
  const colCount = 9;
  const sums = Array(colCount).fill(0);

  for (let i = 2; i < table.rows.length; i++) {
      const row = table.rows[i];
      for (let j = 1; j <= colCount; j++) {
          const cell = row.cells[j];
          const value = parseFloat(cell.textContent);
          sums[j - 1] += value;
      }
  }
  let sumRow = table.insertRow();
  sumRow.insertCell(0).textContent = 'Total';
  for (let i = 0; i < colCount; i++) {
      sumRow.insertCell(i + 1).textContent = sums[i].toFixed(2);
  }


    let mediaRow = table.insertRow();
    mediaRow.insertCell(0).textContent = 'Média';
    for (let i = 0; i < colCount; i++) {
      mediaRow.insertCell(i + 1).textContent = (sums[i] / 6).toFixed(2);
}
}






