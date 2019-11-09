<?php

namespace App\Helper;

use App\Application\Contracts\Request as RequestInteface;

class Request implements RequestInteface
{

    /**
     * input
     *
     * @param  mixed $field
     * @param  mixed $post
     *
     * @return void
     */
    public function input(string $field, bool $post = true)
    {

        $arr = $this->getTypeArr($post);

        return isset($arr[$field]) ? htmlspecialchars($arr[$field]) : "";
    }

    /**
     * all
     *
     * @param  mixed $post
     *
     * @return array
     */
    public function all(bool $post = true): array
    {
        $arr = $this->getTypeArr($post);

        return array_map('htmlspecialchars', $arr);
    }

    /**
     * isPost
     *
     * @return bool
     */
    public function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    /**
     * getTypeArr
     *
     * @param  mixed $post
     *
     * @return array
     */
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
