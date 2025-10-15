<?php
declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

final class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create(array $input): bool
    {
        $errors = $this->validator->validate($input);
        if (!empty($errors)) {
            return false;
        }
        $products = $this->repository->findAll();
        $max = 0;
        foreach ($products as $p) {
            if ($p['id'] > $max) {
                $max = $p['id'];
            }
        }
        $id = $max + 1;
        $product = [
            'id' => $id,
            'name' => (string) ($input['name'] ?? ''),
            'price' => (float) ($input['price'] ?? 0),
        ];
        $this->repository->save($product);
        return true;
    }

    public function list(): array
    {
        return $this->repository->findAll();
    }
}
