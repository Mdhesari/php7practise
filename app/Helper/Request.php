<?php

namespace App\Helper;

use App\Application\Contracts\Request as RequestInteface;

class Request implements RequestInteface
{

    public function input(string $field, bool $post = true)
    {

        $arr = $this->getTypeArr($post);

        return isset($arr[$field]) ? htmlspecialchars($arr[$field]) : "";
    }

    public function all(bool $post = true): array
    {
        $arr = $this->getTypeArr($post);

        return array_map('htmlspecialchars', $arr);
    }

    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    private function getTypeArr(bool $post = true): array
    {
        $arr = [];

        if ($this->isPost() && $post)
            $arr = $_POST;
        else
            $arr = $_GET;

        return $arr;
    }
}
