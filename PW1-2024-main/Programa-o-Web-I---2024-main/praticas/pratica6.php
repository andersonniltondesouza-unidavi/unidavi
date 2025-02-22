<?php

$mat = array(
    array("Matematica", 5, 8.5),
    array("Portugues", 2, 9),
    array("Geografia", 10, 6),
    array("Educação Física", 2, 8)
);


echo "<table border='1'>";
echo "<tr><th>Disciplina</th><th>Faltas</th><th>Média</th></tr>";


foreach ($mat as $linha) {
    echo "<tr>";
    echo "<td>" . $linha[0] . "</td>";
    echo "<td>" . $linha[1] . "</td>";
    echo "<td>" . $linha[2] . "</td>";
    echo "</tr>";
}

echo "</table>";

?>
