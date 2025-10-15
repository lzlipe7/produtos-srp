<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$file = __DIR__ . '/../storage/products.txt';

$repo = new FileProductRepository($file);
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$http = 201;
$ok = $service->create($_POST);
if (!$ok) {
    $http = 422;
}
http_response_code($http);
echo $ok ? 'Criado' : 'Erro';
