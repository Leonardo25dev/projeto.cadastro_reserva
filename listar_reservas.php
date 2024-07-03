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

// Consulta para recuperar todas as reservas
$sql = "SELECT * FROM reservas";
$result = mysqli_query($conn, $sql);

// Verificação se há reservas cadastradas
if (mysqli_num_rows($result) > 0) {
    echo "<h1>Lista de Reservas</h1>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Check-in</th><th>Check-out</th><th>Tipo Quarto</th><th>Ações</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telefone'] . "</td>";
        echo "<td>" . $row['check_in'] . "</td>";
        echo "<td>" . $row['check_out'] . "</td>";
        echo "<td>" . $row['tipo_quarto'] . "</td>";
        echo "<td>";
        echo "<a href='editar_reserva.php?id=" . $row['id'] . "'>Editar</a>";
        echo " | ";
        echo "<a href='excluir_reserva.php?id=" . $row['id'] . "'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<h1>Não há reservas cadastradas.</h1>";
}

mysqli_close($conn);
