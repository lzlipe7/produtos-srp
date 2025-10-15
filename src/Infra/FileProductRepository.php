<?php
declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        if (!file_exists($this->filePath)) {
            touch($this->filePath);
        }
    }

    public function save(array $product): void
    {
        file_put_contents($this->filePath, json_encode($product, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);
    }

    public function findAll(): array
    {
        $out = [];
        if (!file_exists($this->filePath) || !is_readable($this->filePath)) {
            return $out;
        }
        $fh = fopen($this->filePath, 'r');
        if ($fh === false) {
            return $out;
        }
        while (($line = fgets($fh)) !== false) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }
            $decoded = json_decode($line, true);
            if (!is_array($decoded)) {
                continue;
            }
            $out[] = [
                'id' => isset($decoded['id']) ? (int)$decoded['id'] : 0,
                'name' => isset($decoded['name']) ? (string)$decoded['name'] : '',
                'price' => isset($decoded['price']) ? (float)$decoded['price'] : 0.0,
            ];
        }
        fclose($fh);
        return $out;
    }
}
