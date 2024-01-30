<?php

namespace App\Contracts\V1\Requests;

interface DeleteActionContract{
    public function __invoke(int $request_id);
} 