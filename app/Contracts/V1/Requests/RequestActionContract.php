<?php

namespace App\Contracts\V1\Requests;

interface RequestActionContract{
    public function __invoke(int $request_id);
} 