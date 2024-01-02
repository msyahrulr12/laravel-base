<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Role as ModelsRole;

class UserRepository
{
    /**
     * @var \App\Models\Role
     */
    private $model;

    /**
     * @var \App\Models\Role
     */
    private $roleSpatieModel;

    public function __construct(
        Role $model,
        ModelsRole $roleSpatieModel
    )
    {
        $this->model = $model;
        $this->roleSpatieModel = $roleSpatieModel;
    }

    /**
     * @param null|int $perPage
     *
     * @return object|array
     */
    public function getAll($perPage = null)
    {
        if ($perPage) {
            return $this->model->paginate($perPage);
        }

        return $this->model->orderBy('id', 'desc')->get();
    }

    /**
     * @param int $id
     *
     * @return object
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param int $id
     *
     * @return object
     */
    public function findBySpatieModel(int $id)
    {
        return $this->roleSpatieModel->findOrFail($id);
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
     * @return object
     */
    public function createBySpatie(array $data)
    {
        return $this->roleSpatieModel->create($data);
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
        return $this->model->findOrFail($id)->delete($id);
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

    /**
     * @param \App\Models\User $user
     * @param string $roleName
     */
    public function assignRole(User $user, string $roleName)
    {
        return $user->assignRole($roleName);
    }
}
