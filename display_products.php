<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Conectar ao banco de dados
$servername = "localhost";
$username = "Railson";
$password = "1234";
$database = "login_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consultar produtos
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Lista de Produtos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome do Produto</th>
            <th>Valor</th>
            <th>Quantidade</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["nome_produto"]."</td>";
                echo "<td>".$row["valor"]."</td>";
                echo "<td>".$row["quantidade"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum produto encontrado.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="logout.php">Sair</a>
</body>
</html>

<?php
$conn->close();
?>
