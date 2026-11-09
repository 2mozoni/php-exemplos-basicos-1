<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UpLoad de Imagem</title>
</head>
<body>

    <h2>Formulário de Upload</h2>
    <!-- O enctype="multipart/form-data" é OBRIGATÓRIO para envio de arquivos -->
    <form action="14_upload.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="imagem">Selecione uma imagem:</label><br>
            <input type="file" name="imagem" id="imagem" required>
        </p>
        <button type="submit">Fazer Upload</button>
    </form>

    <div class="mensagem">
<?php
        // Toda a lógica de upload só executa SE o formulário for enviado via POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Definição da pasta de destino
    $diretorio_destino = 'uploads/';

            // Cria a pasta apenas se ela não existir
            if (!is_dir($diretorio_destino)) {
        mkdir($diretorio_destino, 0777, true);
    }

            // Verifica se a chave "imagem" existe e se não houve erro no envio do arquivo
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                
                // Armazena apenas o nome base do arquivo (Ex: foto.jpg)
        $nome_arquivo = basename($_FILES['imagem']['name']);

        // Constroi o caminho completo (Ex. uploads/foto.jpg)
        $caminho_completo = $diretorio_destino . $nome_arquivo;

// Move o arquivo (da imagem) para a pasta onde será armazenada (uploads)
if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_completo)) {
    echo"<p>Upload realizado com sucesso!</p>";
    echo"<img src='$caminho_completo' alt='Imagem enviada' style='max-width: 300px;'>";
} else {
    echo"<p>Erro ao fazer upload do arquivo!</p>";
}
            } else {
                echo "<p style='color: red;'>Nenhum arquivo enviado ou erro no upload do arquivo!</p>";
            }
        }
?>
    
</body>
</html>