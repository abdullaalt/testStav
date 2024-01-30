<?php

namespace App\Contracts\V1\Requests;

interface RequestsActionContract{
    public function __invoke($request);
} 