<?php

namespace App\Interfaces\Web;

interface CartInterface
{
    public function index();

    public function store($request);

    public function update($request, $product);

    public function destroy($product);

    public function empty($product);

    public function total();
}
