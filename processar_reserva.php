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
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$check_in = $_POST['check_in'];
$check_out = $_POST['check_out'];
$tipo_quarto = $_POST['tipo_quarto'];

// Validação básica dos dados (você pode implementar validações mais complexas)
if (empty($nome) || empty($email) || empty($telefone) || empty($check_in) || empty($check_out) || empty($tipo_quarto)) {
    echo "Preencha todos os campos obrigatórios!";
    die();
}

// Verificação de disponibilidade (implemente sua lógica de acordo com seu banco de dados)
$sql_disponibilidade = "SELECT * FROM reservas WHERE tipo_quarto = '$tipo_quarto' AND (check_in BETWEEN '$check_in' AND '$check_out') OR (check_out BETWEEN '$check_in' AND '$check_out')";
$result_disponibilidade = mysqli_query($conn, $sql_disponibilidade);

if (mysqli_num_rows($result_disponibilidade) > 0) {
    echo "Quarto indisponível para as datas selecionadas. Tente outra data ou tipo de quarto.";
    die();
}

// Inserção da reserva no banco de dados
$sql_insert = "INSERT INTO reservas (nome, email, telefone, check_in, check_out, tipo_quarto) VALUES ('$nome', '$email', '$telefone', '$check_in', '$check_out', '$tipo_quarto')";
$insert_result = mysqli_query($conn, $sql_insert);

if ($insert_result) {
    echo "Reserva realizada com sucesso!";

    // Envio de e-mail de confirmação (implemente sua lógica de envio de e-mail)
    // ...

} else {
    echo "Falha ao registrar a reserva: " . mysqli_error($conn);
}

mysqli_close($conn);
