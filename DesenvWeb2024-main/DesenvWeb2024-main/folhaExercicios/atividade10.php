<!-- 10.Dado o Array abaixo, pede-se para recursivamente criar a árvore ao lado: -->
<?php
$pastas = array (
         "bsn" => array(
        "3a Fase" => array("desenvWeb", "bancoDados 1", "engSoft 1"), 
        "4a Fase" => array("Intro Web", "bancoDados 2", "engSoft")
    )
);
$x = 0;
    foreach ($pastas as $unidavi => $arvore_fase) {
        echo "-", $unidavi,"<br>";
            foreach ($arvore_fase as $fase => $arvore_disciplina){
                echo "- -",$fase,"<br>";
                    foreach ($arvore_disciplina as $disciplina){
                        echo "- - -",$disciplina,"<br>";
                    }
            }
    }
?>