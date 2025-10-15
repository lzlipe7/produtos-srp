<?php
declare(strict_types=1);

namespace App\Domain;

use App\Contracts\ProductValidator;

final class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];
        $name = $input['name'] ?? '';
        $price = $input['price'] ?? null;
        if (!is_string($name) || strlen(trim($name)) < 2 || strlen($name) > 100) {
            $errors[] = 'name';
        }
        if (!is_numeric($price) || (float)$price < 0) {
            $errors[] = 'price';
        }
        return $errors;
    }
}
