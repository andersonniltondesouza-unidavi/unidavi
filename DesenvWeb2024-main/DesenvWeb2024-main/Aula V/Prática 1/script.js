    let barra = document.getElementById("barra");
    let currentInput = "";

    function SelectNumber (num) {
      currentInput += num;
      barra.value = currentInput;
    }

    function SelectOperator (operator) {
      currentInput += operator;
      barra.value = currentInput;
    }

    function igual() {
      try {
        barra.value = eval(currentInput);
        currentInput = barra.value;
      } catch (error) 
      {
        barra.value = "Erro";
      }

      if (barra.value < 0){
        document.getElementById('barra').style.backgroundColor="#FF0000";
      }
      
      if (barra.value > 0){
        document.getElementById('barra').style.backgroundColor="#00FF00";
      }

      if (barra.value == 0){
        document.getElementById('barra').style.backgroundColor="#F5DEB3";
      }
    }

    function limpar() {
      currentInput = "";
      barra.value = "";
      document.getElementById('barra').style.backgroundColor="";
    }

    