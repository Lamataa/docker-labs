<?php
require 'db.php';

$conn->query("CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {
    $nome  = $conn->real_escape_string($_POST['nome']);
    $preco = $conn->real_escape_string($_POST['preco']);
    $conn->query("INSERT INTO produtos (nome, preco) VALUES ('$nome', '$preco')");
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM produtos WHERE id=$id");
}

$result = $conn->query("SELECT * FROM produtos");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>CRUD - Lab 2</title>
  <style>
    body { font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; background: #f5f5f5; }
    h1 { color: #2c3e50; }
    input, button { padding: 8px; margin: 4px; border-radius: 4px; border: 1px solid #ccc; }
    button { background: #3498db; color: white; border: none; cursor: pointer; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    th { background: #3498db; color: white; }
    a { color: red; text-decoration: none; }
  </style>
</head>
<body>
  <h1>Cadastro de Produtos</h1>

  <form method="POST">
    <input type="text"   name="nome"  placeholder="Nome do produto" required>
    <input type="number" name="preco" placeholder="Preço" step="0.01" required>
    <button type="submit">Adicionar</button>
  </form>

  <table>
    <tr><th>ID</th><th>Nome</th><th>Preço</th><th>Ação</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['nome'] ?></td>
      <td>R$ <?= number_format($row['preco'], 2, ',', '.') ?></td>
      <td><a href="?delete=<?= $row['id'] ?>">Excluir</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>