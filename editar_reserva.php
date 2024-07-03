<?php

// Conexão com o banco de dados (ajuste os dados de acordo com sua configuração)
$dbhost = "localhost";
$dbuser = "usuario_banco";
$dbpass = "senha_banco";
$dbname = "nome_banco";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Verificação da conexão com o banco de dados
if (!$conn) {
    echo "Falha na conexão com o banco de dados: " . mysqli_connect_error();
    die();
}

// Recebimento dos dados do formulário
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$tipo_quarto = $_POST['tipo_quarto'];

// Validação básica dos dados (você pode implementar validações mais complexas)
if (empty($nome) || empty($email) || empty($telefone) || empty($check_in) || empty($check_out) || empty($tipo_quarto)) {
    echo "<h1>Preencha todos os campos obrigatórios!</h1>";
    die();
}

// Consulta para atualizar a reserva no banco de dados
$sql = "UPDATE reservas SET nome='$nome', email='$email', telefone='$telefone', check_in='$check_in', check_out='$check_out', tipo_quarto='$tipo_quarto' WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "<h1>Reserva atualizada com sucesso!</h1>";
} else {
    echo "<h1>Erro ao atualizar a reserva: " . mysqli_error($conn) . "</h1>";
}

mysqli_close($conn);
