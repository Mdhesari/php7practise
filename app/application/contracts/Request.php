<?php

namespace App\Application\Contracts;

interface Request
{
    public function input(string $field, bool $post = true);

    public function all(bool $post = true): array;

    public function isPost(): bool;

    public function getTypeArr(): array;
}
