<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\Contract as ServiceInterface;
use App\Repositories\Repository;

abstract class Service implements ServiceInterface
{
    protected Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function make(array $data): ServiceInterface
    {
        return $this->repository->make($data);
    }

    public function update(array $data): ServiceInterface
    {
        return $this->repository->update($data);
    }

    public function get($id): ServiceInterface
    {
        return $this->repository->get($id);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }
}
