<?php

namespace App\Service;

use App\Http\Requests\MenuRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\MenuRepository;
use App\Results\ErrorCollection;
use App\Results\GeneralResult;
use Illuminate\Support\Facades\DB;

class MenuService
{
    private $menuRepository;

    public function __construct(
        MenuRepository $menuRepository
    )
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * @return object
     */
    public function getAll()
    {
        $result = new GeneralResult();
        $result->setData($this->menuRepository->getAll());
        return $result;
    }

    /**
     * @param int $id
     */
    public function find(int $id)
    {
        $result = new GeneralResult();
        $result->setData($this->menuRepository->find($id));
        return $result;
    }

    /**
     * @param \App\Http\Requests\MenuRequest $request
     *
     * @return \App\Results\GeneralResult
     */
    public function create(MenuRequest $request)
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuRepository->create($request->all());

            DB::commit();

            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    /**
     * @param \App\Http\Requests\MenuRequest $request
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function update(MenuRequest $request, int $id): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuRepository->find($id);
            if (!$data) {
                $result->addError(new ErrorCollection(400, __('message.menu_header.id.not_found', [
                    'id' => $id
                ], 'id')));

                return $result;
            }

            $update = $data->update($request->all());

            DB::commit();

            $result->setData($update);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    /**
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function delete(int $id): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuRepository->find($id);
            $delete = $data->delete();

            DB::commit();

            $result->setData($delete);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    /**
     * @param User $user
     *
     * @return GeneralResult
     */
    public function getMyMenu(User $user): GeneralResult
    {
        $result = new GeneralResult();
        $result->setData($this->menuRepository->getGrantedPermission($user->roles->pluck('id')));
        return $result;
    }

    /**
     * @param User $user
     *
     * @return GeneralResult
     */
    public function getMyMenuByRole($role): GeneralResult
    {
        $result = new GeneralResult();
        $result->setData($this->menuRepository->getGrantedPermission($role));
        return $result;
    }

    /**
     * @param User $user
     *
     * @return GeneralResult
     */
    public function getMyAllMenu(User $user): GeneralResult
    {
        $result = new GeneralResult();
        $result->setData($this->menuRepository->getMenuFromHeader($user->roles->pluck('id')));
        return $result;
    }

    /**
     * @return object
     */
    public function getParentMenu()
    {
        $result = new GeneralResult();
        $data = $this->menuRepository->getParentMenu();
        $result->setData($data);
        return $result;
    }
}
