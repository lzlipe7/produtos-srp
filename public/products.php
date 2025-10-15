<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Application\ProductService;
use App\Domain\SimpleProductValidator;

$file = __DIR__ . '/../storage/products.txt';

$repo = new FileProductRepository($file);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->list();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Produtos</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;padding:20px}
    table{border-collapse:collapse;width:100%;max-width:800px}
    th,td{border:1px solid #ddd;padding:8px;text-align:left}
    th{background:#f4f4f4}
  </style>
</head>
<body>
  <h1>Produtos</h1>
  <?php if (empty($products)): ?>
    <p>Nenhum produto cadastrado.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr><th>#</th><th>Nome</th><th>Preço</th></tr>
      </thead>
      <tbody>
        <?php foreach ($products as $p): ?>
          <tr>
            <td><?= (int)$p['id'] ?></td>
            <td><?= htmlentities($p['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= number_format((float)$p['price'], 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
  <p><a href="index.php">Novo produto</a></p>
</body>
</html>
