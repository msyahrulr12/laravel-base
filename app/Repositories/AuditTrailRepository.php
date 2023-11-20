<?php

namespace App\Repositories;

use App\Models\AuditTrail;

class AuditTrailRepository
{
    /**
     * @var \App\Models\AuditTrail
     */
    private $model;

    public function __construct(
        AuditTrail $model
    )
    {
        $this->model = $model;

    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->model->all()->toArray();
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function find(int $id): array
    {
        return $this->model->find($id)->first();
    }

    /**
     * @param array $data
     *
     * @return object
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function update(array $data): bool
    {
        return $this->model->update($data);
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete($id);
    }
}
