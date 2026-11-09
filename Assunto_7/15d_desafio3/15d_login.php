<?php
session_start();


$erro = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $cor = $_POST['cor'];


    // Conexão ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "Senai@118";
    $dbname = "exercicio";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }


    // Consulta na tabela usuarios
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // Guarda na sessão e redireciona
        $_SESSION['usuario'] = $usuario;
        $_SESSION['cor'] = $cor;


        header("Location: 15d_perfil.php");
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }


    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login - Perfil de Usuário</title>
</head>
<body>
    <h2>Login</h2>


    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>


    <form method="post" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" required><br><br>


        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br><br>


        <label for="cor">Cor de Fundo da Página:</label>
        <input type="color" name="cor" value="#ffffff"><br><br>


        <button type="submit">Entrar</button>
    </form>
</body>
</html>