<head>
    <title>Categorias</title>
    <link rel="stylesheet" href="..//public/css/listar.css"/>
</head>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>nome</th>
    </tr>
    </thead>

    <tbody>
    <?php
    if ($_REQUEST) {
        if ($_REQUEST["categorias"]) {
            foreach ($_REQUEST["categorias"] as $categoria) {
                echo "<tr>";
                echo "<td>" . $categoria["id"] . "</td>";
                echo "<td>" . $categoria["nome"] . "</td>";
                echo "</tr>";
            }
        }
    }
    ?>
    </tbody>
</table>