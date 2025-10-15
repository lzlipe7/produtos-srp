<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Cadastro de Produtos</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;padding:20px}
    form{max-width:420px}
    label{display:block;margin:8px 0 4px}
    input{width:100%;padding:8px;box-sizing:border-box}
    button{margin-top:12px;padding:8px 12px}
  </style>
</head>
<body>
  <h1>Cadastrar Produto</h1>
  <form action="create.php" method="post">
    <label for="name">Nome</label>
    <input id="name" name="name" required minlength="2" maxlength="100">
    <label for="price">Preço</label>
    <input id="price" name="price" required pattern="^\d+(\.\d{1,2})?$" inputmode="decimal">
    <button type="submit">Criar</button>
  </form>
  <p><a href="products.php">Ver produtos</a></p>
</body>
</html>
