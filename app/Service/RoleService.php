<?php

namespace App\Service;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\roleRepository;
use App\Results\ErrorCollection;
use App\Results\GeneralResult;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleService
{
    private $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAll($limit = null)
    {
        $result = new GeneralResult();
        $result->setData($this->roleRepository->getAll($limit));
        return $result;
    }

    /**
     * @param \App\Http\Requests\RoleRequest $request
     *
     * @return \App\Results\GeneralResult
     */
    public function create(RoleRequest $request): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            // create data
            $data = $this->roleRepository->create([
                'name' => $request->get('name')
            ]);

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
     * @param \App\Http\Requests\RoleRequest $request
     *
     * @return \App\Results\GeneralResult
     */
    public function createBySpatie(RoleRequest $request): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            // create data
            $data = $this->roleRepository->createBySpatie([
                'name' => $request->get('name')
            ]);

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
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function find(int $id): GeneralResult
    {
        $result = new GeneralResult();

        try {
            $data = $this->roleRepository->find($id);
            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    /**
     * @param \App\Http\Requests\RoleRequest $request
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function update(RoleRequest $request, int $id): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $existingData = $this->roleRepository->findByName($request->get('name'));
            if ($existingData && $existingData->id !== $id) {
                $result->addError(new ErrorCollection(400, sprintf('Permission with name %s already exists', $request->get('name'))));
            }

            $data = $this->roleRepository->update([
                'name' => $request->get('name'),
            ], $id);

            DB::commit();

            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    public function findBySpatieModel(int $id)
    {
        $result = new GeneralResult();

        try {
            $data = $this->roleRepository->findBySpatieModel($id);

            $result->setData($data);

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
     * @return GeneralResult
     */
    public function delete(int $id): GeneralResult
    {
        $result = new GeneralResult();

        try {
            $data = $this->roleRepository->delete($id);

            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }
}
