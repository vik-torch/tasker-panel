<?php

namespace App\Models;

class Task
{
    public function __construct(
        public int $id,
        public string $text,
        public bool $status
    ) {}
}