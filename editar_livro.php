<?php
    include 'conexao.php';

    $livro = null;

    // Carregar dados do livro para edição //
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_livro = intval($_GET['id']);

        $stmt = $conexao->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->bind_param("i", $id_livro);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows == 1) {
            $livro = $resultado->fetch_assoc();
        } else {
            header("Location: listar_livros.php?status=livro_nao_encontrado");
            exit();
        }

        $stmt->close();
    }

    //Processamento de atualização do livro quando o formulário é submetido //
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_livro_post = htmlspecialchars(trim($_POST['id']));
        $titulo = htmlspecialchars(trim($_POST['titulo']));
        $autor = htmlspecialchars(trim($_POST['autor']));
        $genero = htmlspecialchars(trim($_POST['genero']));
        $ano_publicacao = htmlspecialchars(trim($_POST['ano_publicacao']));

        if (empty($titulo) || empty($autor) || empty($id_livro_post)) {
            $mensagem_erro = "Título, Autor e ID do livro são campos obrigatórios.";
        } else {
            $stmt_update = $conexao->prepare("UPDATE livros SET titulo = ?, autor = ?, genero = ?, ano_publicacao = ? WHERE id = ?");
            $stmt_update->bind_param("sssii", $titulo, $autor, $genero, $ano_publicacao, $id_livro_post);

            if ($stmt_update->execute()) {
                $mensagem_sucesso = "Livro atualizado com sucesso!";

                $id_livro = intval($id_livro_post);
                $stmt = $conexao->prepare("SELECT * FROM livros WHERE id = ?");
                $stmt->bind_param("i", $id_livro);
                $stmt->execute();
                $resultado = $stmt->get_result();
                $livro = $resultado->fetch_assoc();

                $stmt->close();
            } else {
                $mensagem_erro = "Erro ao atualzar o livro: " . $stmt_update->error;
            }

            $stmt_update->close();
        }
    }

    $conexao->close();

    if ($livro === null && !isset($mensagem_erro)) {
        header("Location: listar_livros.php?status=id_ausente");
        exit();
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
            background-color:rgb(95, 0, 0);
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
            color: rgb(255, 153, 0)
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
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Livro</h1>

        <?php
        if (isset($mensagem_sucesso)) {
            echo "<p class='mensagem-sucesso'>" . $mensagem_sucesso . "</p>";
        }
        if (isset($mensagem_erro)) {
            echo "<p class='mensagem-erro'>" . $mensagem_erro . "</p>";
        }
        ?>

        <?php
        if ($livro): ?>
        <form action="editar_livro.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($livro['id']); ?>">
            <div>
                <label for="titulo"Título do livro:>Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>
            </div>
            <div>
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required>
            </div>
            <div>
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($livro['genero']); ?>">
            </div>
            <div>
                <label for="ano_publicacao">Ano de publicação:</label>
                <input type="number" id="ano_publicacao" name="ano_publicacao" value="<?php echo htmlspecialchars($livro['ano_publicacao']); ?>" min="1000" max="9999">
            </div>
            <button type="submit">Atualizar Livro</button>
        </form>
        <?php else: ?>
            <p class="sem-livro">Livro não encontrado para edição ou ID não fornecido.</p>
        <?php endif; ?>
        <a href="index.php" class="back-link">Voltar para a página inicial</a>
    </div>
</body>
</html>