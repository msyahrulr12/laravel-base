<?php

namespace App\Repositories;

use App\Models\MenuHeader;

class MenuHeaderRepository
{
    /**
     * @var \App\Models\MenuHeader
     */
    private $model;

    public function __construct(
        MenuHeader $model
    )
    {
        $this->model = $model;
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

        return $this->model->all();
    }

    /**
     * @param int $id
     *
     * @return object|null
     */
    public function find(int $id)
    {
        return $this->model->find($id);
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
        return $this->model->find($id)->update($data);
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
