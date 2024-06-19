<?php
// Conecta ao banco de dados (substitua pelos seus dados de conexão)
$mysqli = new mysqli('127.0.0.1', 'root', '', 'login');

// Obtém o ID da reserva a ser editada ou removida (você pode passar o ID via GET ou POST)
$reserva_id = $_GET['id'];

// Consulta os dados da reserva
$sql = "SELECT * FROM reservas WHERE id = $reserva_id";
$query = $mysqli->query($sql);
$reserva = $query->fetch_assoc();

// Verifica se o formulário foi enviado para edição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualiza os dados da reserva com base nos campos enviados
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $tipo_quarto = $_POST['tipo_quarto'];

    $update_sql = "UPDATE reservas SET
        nome = '$nome',
        email = '$email',
        telefone = '$telefone',
        checkin = '$checkin',
        checkout = '$checkout',
        tipo_quarto = '$tipo_quarto'
        WHERE id = $reserva_id";

    if ($mysqli->query($update_sql)) {
        echo "Reserva atualizada com sucesso!";
    } else {
        echo "Erro ao atualizar a reserva: " . $mysqli->error;
    }
}

// Verifica se o formulário foi enviado para remoção
if (isset($_POST['remover'])) {
    $delete_sql = "DELETE FROM reservas WHERE id = $reserva_id";
    if ($mysqli->query($delete_sql)) {
        echo "Reserva removida com sucesso!";
    } else {
        echo "Erro ao remover a reserva: " . $mysqli->error;
    }
}

// Exibe o formulário de edição e remoção
echo '<form method="post">';
echo '<input type="hidden" name="id" value="' . $reserva['id'] . '">';
echo 'Nome: <input type="text" name="nome" value="' . $reserva['nome'] . '"><br>';
echo 'E-mail: <input type="email" name="email" value="' . $reserva['email'] . '"><br>';
echo 'Telefone: <input type="tel" name="telefone" value="' . $reserva['telefone'] . '"><br>';
echo 'Data de Check-in: <input type="date" name="checkin" value="' . $reserva['checkin'] . '"><br>';
echo 'Data de Check-out: <input type="date" name="checkout" value="' . $reserva['checkout'] . '"><br>';
echo 'Tipo de Quarto:
    <select name="tipo_quarto">
        <option value="standard" ' . ($reserva['tipo_quarto'] === 'standard' ? 'selected' : '') . '>Standard</option>
        <option value="luxo" ' . ($reserva['tipo_quarto'] === 'luxo' ? 'selected' : '') . '>Luxo</option>
        <option value="suíte" ' . ($reserva['tipo_quarto'] === 'suíte' ? 'selected' : '') . '>Suíte</option>
    </select><br>';
echo '<input type="submit" value="Salvar">';
echo '</form>';

// Botão para remover a reserva
echo '<form method="post">';
echo '<input type="hidden" name="id" value="' . $reserva['id'] . '">';
echo '<input type="submit" name="remover" value="Remover">';
echo '</form>';

// Fecha a conexão com o banco de dados
$mysqli->close();
?>
