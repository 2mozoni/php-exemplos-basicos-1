<?php
session_start();


// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: 15d_login.php");
    exit();
}


$usuario = $_SESSION['usuario'];
$cor_fundo = isset($_SESSION['cor']) ? $_SESSION['cor'] : '#ffffff';
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <style>
        body {
            background-color: <?php echo htmlspecialchars($cor_fundo); ?>;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h2>
    <p>Esta é a sua página de perfil personalizada.</p>
    
    <br>
    <a href="15d_logout.php">Sair do sistema</a>
</body>
</html>