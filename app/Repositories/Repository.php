<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Contract as RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function make(array $data): RepositoryInterface
    {
        $data = array_filter($data, function ($key) {
            return in_array($key, $this->model->getFillable());
        }, ARRAY_FILTER_USE_KEY);

        $this->model->fill($data);

        $this->model->save();

        return $this;
    }

    public function update(array $newData): RepositoryInterface
    {
        $this->model->update($newData);

        return $this;
    }

    public function get($id, $withTrashed = false): RepositoryInterface
    {
        $this->withTrashed = $withTrashed;

        $modelFound = $this->findById($id);

        if (!$modelFound) {
            abort(404, 'Resource Not Found');
        }

        $this->model = $modelFound;

        return $this;
    }

    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
