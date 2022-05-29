<h2>Lista de roupas</h2>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>nome</th>
        <th>preço</th>
        <th>descrição</th>
        <th>número</th>
        <th>quantidade</th>
    </tr>
    </thead>

    <tbody>
    <?php
    if ($_REQUEST) {
        if ($_REQUEST["roupas"]) {
            foreach ($_REQUEST["roupas"] as $roupa) {
                echo "<tr>";
                echo "<td>" . $roupa["id"] . "</td>";
                echo "<td>" . $roupa["nome"] . "</td>";
                echo "<td>" . $roupa["preco"] . "</td>";
                echo "<td>" . $roupa["descricao"] . "</td>";
                echo "<td>" . $roupa["numero"] . "</td>";
                echo "<td>" . $roupa["quantidade"] . "</td>";
                echo "</tr>";
            }
        }
    }
    ?>
    </tbody>
</table>