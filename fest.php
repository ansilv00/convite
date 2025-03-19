<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convite</title>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = htmlspecialchars($_POST['titulo']);
    $telefone = htmlspecialchars($_POST['telefone']);
    $descricao = htmlspecialchars($_POST['descricao']);
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['arquivo']['tmp_name'];
        $fileName = $_FILES['arquivo']['name'];
        $fileSize = $_FILES['arquivo']['size'];
        $fileType = $_FILES['arquivo']['type'];

        $uploadDir = 'uploads/';
        $filePath = $uploadDir . basename($fileName);

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (in_array($fileType, $allowedTypes)) {
              if (move_uploaded_file($fileTmpPath, $filePath)) {
                echo "Imagem enviada com sucesso: " . $filePath . "<br>";
            } else {
                echo "Erro ao mover a imagem para o diretório de upload.<br>";
            }
        } else {
            echo "Tipo de arquivo não permitido. Envie uma imagem JPEG ou PNG.<br>";
        }
    } else {
        echo "Nenhuma imagem foi enviada ou houve erro no envio da imagem.<br>";
    }

    echo "<h2>Resumo do convite criado:</h2>";
    echo "título: " . $titulo . "<br>";
    echo "telefone para contato: " . $telefone . "<br>";
    echo "descrição: " . nl2br($descricao) . "<br>";
    echo "data de início: " . $inicio . "<br>";
    echo "data de término: " . $fim . "<br>";

    if (isset($filePath)) {
        echo "<h3>Imagem do convite:</h3>";
        echo "<img src='" . $filePath . "' alt='imagem do convite' style='max-width: 300px;'><br>";
    }
} else {
    echo "Por favor, envie o formulário primeiro.";
}
?>
</body>
</html>

