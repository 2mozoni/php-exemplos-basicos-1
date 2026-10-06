<!-- Digite sua solução para o desafio (AQUI) --><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos com Validação</title>
</head>
<body>
    <form action="" method="post">
        <label for="nome">Nome do produto:</label>
        <input type="text" name="nome" required><br>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" step="0.01" required><br>
        <button type="submit">Validar</button>
    </form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    // Conecta com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "Senai@118";
    $dbname = "exercicios";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }
    // Validação do nome
    if ($nome == "") {
        echo "<p style='color: red;'>Erro: O nome do produto não pode estar vazio.</p>";
    // Validação do preço
    } elseif ($preco <= 0) {
        echo "<p style='color: red;'>Erro: O preço deve ser um número positivo.</p>";
    } else {
        $sql = "INSERT INTO produtos (nome, preco) VALUES ('$nome', '$preco')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: darkgreen;'>Produto cadastrado com sucesso!</p>";
        } else {
            echo "<p style='color: red;'>Erro ao cadastrar o produto.</p>";
        }
    }
    $conn->close();
}
?>
</body>
</html>