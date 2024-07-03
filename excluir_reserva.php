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

// Recebimento do ID da reserva
$id = $_GET['id'];

// Consulta para verificar se a reserva existe
$sql = "SELECT * FROM reservas WHERE id = $id";
$result = mysqli_query($conn, $sql);

// Verificação se a reserva existe
if (mysqli_num_rows($result) == 1) {
    // Deletar a reserva do banco de dados
    $sql = "DELETE FROM reservas WHERE id = $id";
    $delete_result = mysqli_query($conn, $sql);

    if ($delete_result) {
        echo "<h1>Reserva excluída com sucesso!</h1>";
    } else {
        echo "<h1>Erro ao excluir a reserva: " . mysqli_error($conn) . "</h1>";
    }
} else {
    echo "<h1>Reserva não encontrada.</h1>";
}

mysqli_close($conn);
