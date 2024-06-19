<?php
// Conexão com o banco de dados (substitua pelos seus dados)
$host = "localhost";
$usuario = "seu_usuario";
$senha = "sua_senha";
$banco = "nome_do_banco";

$conexao = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Consulta para buscar todas as reservas
$sql = "SELECT * FROM reservas";
$resultado = mysqli_query($conexao, $sql);

if ($resultado) {
    // Exibe os resultados em uma tabela
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Tipo de Quarto</th>
            </tr>";

    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['email']}</td>
                <td>{$row['checkin']}</td>
                <td>{$row['checkout']}</td>
                <td>{$row['tipo_quarto']}</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "Erro na consulta: " . mysqli_error($conexao);
}

// Fecha a conexão
mysqli_close($conexao);
?>
