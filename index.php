<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: rgb(95, 0, 0);
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: rgb(66, 0, 0);
            padding: 20px;
            border-radius: 8px;
        }
        h1 {
            color: rgb(255, 153, 0);
            text-align: center;
            margin-bottom: 30px;
        }
        p {
            color: white;
            font-size: 15;
            text-align: center;
            margin-top: 40px;
            font-weight: bold;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        nav ul li {
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            background-color: rgb(255, 153, 0);
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistema de Cadastro de Livros</h1>
        <nav>
            <ul>
                <li><a href="cadastrar_livro.php">Cadastrar Livro</a></li>
                <li><a href="listar_livros.php">Vizualizar Biblioteca</a></li>
            </ul>
        </nav>

        <p>Selecione uma das opções acima para começar.</p>
    </div>
</body>
</html>