<?php
    include 'conexao.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = intval($_POST['id']);

        $stmt = $conexao->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: listar_livros.php?status=excluido");
            exit();
        } else {
            echo "Erro ao excluir livro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        header("Location: listar_livros.php?status=erro_exclusao");
        exit();
    }

    $conexao->close();
?>