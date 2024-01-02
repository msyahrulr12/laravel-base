<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Models\MenuHeader;
use App\Models\Role;

class MenuRepository
{
    /**
     * @var \App\Models\Menu
     */
    private $model;
    private $menuHeaderModel;

    public function __construct(
        Menu $model,
        MenuHeader $menuHeaderModel
    )
    {
        $this->model = $model;
        $this->menuHeaderModel = $menuHeaderModel;
    }

    /**
     * @param null|int $perPage
     *
     * @return object
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
     * @return object
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

    /**
     * @return array
     */
    public function getGrantedPermission($roles)
    {
        return $this->model
                    ->whereHas('role', function($q) use($roles) {
                        $q->whereIn('role_id', $roles);
                    })
                    ->with(['permissions', 'role' => function($q) use ($roles) {
                        $q->whereIn('role_id', $roles);
                    }])
                    ->get()
                    ->toArray();
    }

    /**
     * @return array
     */
    public function getMenuFromHeader($roles): array
    {
        return $this->menuHeaderModel
                    ->whereHas('menus.role', function($q) use($roles) {
                        $q->whereIn('role_id', $roles);
                    })->with(['menus' => function($q) use ($roles) {
                        $q->whereHas('role', function($q1) use ($roles) {
                            $q1->whereIn('role_id', $roles);
                        });
                    }])->get()
                    ->toArray();
    }

    /**
     * @return object
     */
    public function getParentMenu()
    {
        return $this->model
                ->where('parent_id', null)
                ->get();
    }
}
