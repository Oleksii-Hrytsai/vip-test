<?php

namespace App\Command;

class CreateProductCommand
{
    private $code;
    private $name;
    private $type;
    private $price;

    public function __construct(int $code, string $name, string $type, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
