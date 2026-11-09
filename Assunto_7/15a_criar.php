<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <form method="post" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <button type="submit">Cadastrar</button>
    </form>

<?php
// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os valores enviados pelo formulário
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    // Conecta ao MySQL
    $conn = new mysqli($servername, $username, $password);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Cria o banco de dados se não existir
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->query($sql);

    // Seleciona o banco de dados
    $conn->select_db($dbname);

    // Cria a tabela se não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(100) NOT NULL,
        senha VARCHAR(100) NOT NULL
    )";
    $conn->query($sql);

    // Insere o registro no BD
    $sql = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario','$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: Darkgreen;'>Usuário cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao cadastrar</p>";
    }

    // Fecha a conexão
    $conn->close();
}
?>
</body>
</html>