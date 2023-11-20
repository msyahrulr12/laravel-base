<?php

namespace App\Repositories;

use App\Models\Role;
use Spatie\Permission\Models\Permission as SpatiePermission;

class RoleRepository
{
    /**
     * @var \App\Models\Role
     */
    private $model;

    public function __construct(
        Role $model
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
     * @return object
     */
    public function find(int $id): object
    {
        return $this->model->findOrFail($id);
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
     * @param int $id
     *
     * @return array
     */
    public function update(array $data, int $id)
    {
        return $this->model->findOrFail($id)->update($data);
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

    /**
     * @param $name
     *
     * @return object
     */
    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
