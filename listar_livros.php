<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Cadastradost</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: rgb(95, 0, 0);
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: rgb(66, 0, 0);
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
            color: rgb(255, 153, 0);
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 2px solid rgb(255, 153, 0);
        }
        th, td {
            padding: 12px;
            text-align: left;
            color: white;
        }
        th {
            background-color: rgb(255, 153, 0);
            color: white;
        }
        tr:nth-child(even) {
            background-color: rgb(95, 0, 0);
        }
        .actions button {
            padding: 6px 10px;
            margin-left: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9em;
        }
        .actions .editar-botão {
            background-color: rgb(0, 132, 255);
            color: white;
        }
        .actions .editar-botão:hover {
            background-color: white;
            color: rgb(0, 132, 255);
            transition: background-color 0.3s ease;
        }
        .actions .excluir-botão {
            background-color: rgb(255, 0, 0);
            color: white;
        }
        .actions .excluir-botão:hover {
            background-color: white;
            color: rgb(255, 0, 0);
            transition: background-color 0.3s ease;
        }
        .sem-livros {
            text-align: center;
            color: white;
            font-style: italic;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            color: white;
            text-decoration: none;
        }
        .back-link:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Livros Cadastrados</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Ano de publicação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexao.php';

                $sql = "SELECT * FROM livros ORDER BY id ASC";
                $resultado = $conexao->query($sql);

                if($resultado->num_rows > 0) {
                    while($linha = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $linha["id"] . "</td>";
                        echo "<td>" . $linha["titulo"] . "</td>";
                        echo "<td>" . $linha["autor"] . "</td>";
                        echo "<td>" . $linha["genero"] . "</td>";
                        echo "<td>" . $linha["ano_publicacao"] . "</td>";
                        echo "<td class='actions'>";
                        echo "<a href='editar_livro.php?id=" . $linha["id"] . "'><button class='editar-botão'>Editar</button></a>";
                        echo "<form action='excluir_livro.php' method='POST' style='display: inline-block;'>";
                        echo "<input type='hidden' name='id' value='" . $linha["id"] . "'>";
                        echo "<button type='submit' class='excluir-botão' onclick='return confirm(\"Tem certeza que deseja excluir este livro?\");'>Excluir</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }else {
                    // Caso não haja livros...
                    echo "<tr><td colspan='6' class='sem-livros'>Nenhum livro cadastrado ainda.</td></tr>";
                }

                $conexao->close();
                ?>
            </tbody>
        </table>

        <a href="index.php" class="back-link">Voltar para a Página Inicial</a>
    </div>
</body>
</html>