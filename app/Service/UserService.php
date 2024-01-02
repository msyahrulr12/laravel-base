<?php

namespace App\Service;

use App\Http\Requests\RoleRequest;
use App\Repositories\UserRepository;
use App\Results\ErrorCollection;
use App\Results\GeneralResult;
use Illuminate\Support\Facades\DB;

class UserService
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param null|int $perPage
     */
    public function getAll($perPage = null)
    {
        $result = new GeneralResult();
        $result->setData($this->userRepository->getAll($perPage));
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
            $user = $this->userRepository->create($request->all());
            $user->assignRole($request->get('role_name'));

            DB::commit();

            $result->setData($user);

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
            $data = $this->userRepository->createBySpatie([
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
            $data = $this->userRepository->find($id);
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
            $existingData = $this->userRepository->findByName($request->get('name'));
            if ($existingData && $existingData->id !== $id) {
                $result->addError(new ErrorCollection(400, sprintf('Permission with name %s already exists', $request->get('name'))));
            }

            $data = $this->userRepository->update([
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
            $data = $this->userRepository->findBySpatieModel($id);

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
            $data = $this->userRepository->delete($id);

            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();

            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }
}
