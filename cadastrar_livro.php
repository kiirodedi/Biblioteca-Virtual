<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = htmlspecialchars(trim($_POST['titulo']));
    $autor = htmlspecialchars(trim($_POST['autor']));
    $genero = htmlspecialchars(trim($_POST['genero']));
    $ano_publicacao = htmlspecialchars(trim($_POST['ano_publicacao']));

    if(empty($titulo) || empty($autor)){
        echo "<p style='color> red; text-align: center;'>Título e Autor são capos obrigatórios.</p>";
    }else {
        $stmt = $conexao->prepare("INSERT INTO livros (titulo, autor, genero, ano_publicacao) VALUES(?, ?, ?, ?)");
        $stmt->bind_param("sssi", $titulo, $autor, $genero, $ano_publicacao);
    } if ($stmt->execute()) {
        echo "<p style='color: green; text-align: center;'>Livro cadastrado com sucesso</p>";
    } else {
        echo "<p style='color: red; text-align: center;'>erro ao cadastrar livro: " . $stmt->error . "</p>";

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Livro</title>
    <style>
        body {
            background-color: rgb(95, 0, 0);
            color: white;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            background-color: rgb(66, 0, 0);
            max-width: 600px;
            padding: 15px;
            border-radius: 10px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: rgb(255, 153, 0);
        }

        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: calc(100% - 22px);  /* Ajusta a largura considerando o padding e o border */
            padding: 1px solid #ddd;
            border-radius: 50px;
            border-color: white;
        }
        button {
            background-color: rgb(255, 153, 0);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px auto 0;
        }
        button:hover {
            background-color: white;
            color: black;
            transition: background-color 0.3s ease;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: white;
            text-decoration: none;
        }
        .back-link:hover{
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastrar Novo Livro</h1>

        <form action="cadastrar_livro.php" method="POST">
            <div>
                <label for="titulo"Título do livro:>Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div>
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>
            </div>
            <div>
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero">
            </div>
            <div>
                <label for="ano_publicacao">Ano de publicação:</label>
                <input type="number" id="ano_publicacao" name="ano_publicacao" min="1000" max="9999">
            </div>
            <button type="submit">Cadastrar Livro</button>
        </form>
        
        <a href="index.php" class="back-link">Voltar para a página inicial</a>
    </div>
</body>
</html>