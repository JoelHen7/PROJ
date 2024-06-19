<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $tipo_quarto = $_POST["tipo_quarto"];

    // Conexão com o banco de dados (substitua pelos seus dados)
    $host = "localhost";
    $usuario = "seu_usuario";
    $senha = "sua_senha";
    $banco = "nome_do_banco";

    $conexao = mysqli_connect($host, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Insere os dados na tabela (substitua pelos seus nomes de tabela e colunas)
    $sql = "INSERT INTO reservas (nome, email, telefone, checkin, checkout, tipo_quarto)
            VALUES ('$nome', '$email', '$telefone', '$checkin', '$checkout', '$tipo_quarto')";

    if (mysqli_query($conexao, $sql)) {
        echo "Reserva realizada com sucesso!";
    } else {
        echo "Erro ao inserir os dados: " . mysqli_error($conexao);
    }

    // Fecha a conexão
    mysqli_close($conexao);
}
?>
