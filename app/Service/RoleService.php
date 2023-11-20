<?php

namespace App\Service;

use App\Http\Requests\PermissionRequest;
use App\Repositories\roleRepository;
use App\Results\ErrorCollection;
use App\Results\GeneralResult;
use Illuminate\Support\Facades\DB;

class RoleService
{
    private $roleRepository;

    public function __construct(
        RoleRepository $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param \App\Http\Requests\PermissionRequest $request
     *
     * @return \App\Results\GeneralResult
     */
    public function create(PermissionRequest $request): GeneralResult
    {
        $result = new GeneralResult();

        $data = [];

        DB::beginTransaction();
        try {
            if ($request->get('access') && count($request->get('access')) > 0) {
                foreach ($request->get('access') as $key => $value) {
                    if ($value == 'on') {
                        $permissionName = sprintf('%s %s', $key, $request->get('name'));

                        // find existing data
                        $existingData = $this->roleRepository->findByName($permissionName);
                        if ($existingData) {
                            $result->addError(new ErrorCollection(400, sprintf('Permission with name %s already exists', $permissionName)));
                            continue;
                        }

                        $data[] = $this->roleRepository->create([
                            'name' => $permissionName,
                        ]);
                    }
                }
            } else {
                // find existing data
                $existingData = $this->roleRepository->findByName($request->get('name'));
                if ($existingData) {
                    $result->addError(new ErrorCollection(400, sprintf('Permission with name %s already exists', $request->get('name'))));
                }

                $data[] = $this->roleRepository->create([
                    'name' => $request->get('name'),
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }

        $result->setData($data);

        return $result;
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
     * @param \App\Http\Requests\PermissionRequest $request
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function update(PermissionRequest $request, int $id): GeneralResult
    {
        $result = new GeneralResult();

        $data = [];

        DB::beginTransaction();
        try {
            $existingData = $this->roleRepository->findByName($request->get('name'));
            if ($existingData) {
                $result->addError(new ErrorCollection(400, sprintf('Permission with name %s already exists', $request->get('name'))));
            }

            $data[] = $this->roleRepository->update([
                'name' => $request->get('name'),
            ], $id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }

        $result->setData($data);

        return $result;
    }
}
