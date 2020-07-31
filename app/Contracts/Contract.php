<?php
declare(strict_types=1);

namespace App\Contracts;

interface Contract
{
    public function make(array $data) : self;

    public function update(array $data) : self;

    public function get(int $id) : self;

    public function findById(int $id);
}
