<?php
$servername = "localhost";
$username = "Railson";
$password = "1234";
$database = "login_system";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$produtos = [
    ['nome' => 'Manteiga', 'valor' => 4.50, 'quantidade' => 10],
    ['nome' => 'Mac Instantaneo', 'valor' => 2.00, 'quantidade' => 20],
    ['nome' => 'Batata', 'valor' => 2.99, 'quantidade' => 15],
    ['nome' => 'vinagre', 'valor' => 6.00, 'quantidade' => 5],
    ['nome' => 'oléo', 'valor' => 12.00, 'quantidade' => 25],
    ['nome' => 'limão', 'valor' => 1.00, 'quantidade' => 60]
];

foreach ($produtos as $produto) {
    $stmt = $conn->prepare("INSERT INTO products (nome_produto, valor, quantidade) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $produto['nome'], $produto['valor'], $produto['quantidade']);
    $stmt->execute();
}

echo "Produtos inseridos com sucesso!";

$stmt->close();
$conn->close();
?>
