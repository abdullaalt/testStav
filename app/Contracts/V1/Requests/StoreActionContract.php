<?php

namespace App\Contracts\V1\Requests;

interface StoreActionContract{
    public function __invoke(object $request);
} 