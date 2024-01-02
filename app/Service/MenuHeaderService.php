<?php

namespace App\Service;

use App\Http\Requests\MenuHeaderRequest;
use App\Repositories\MenuHeaderRepository;
use App\Results\ErrorCollection;
use App\Results\GeneralResult;
use Illuminate\Support\Facades\DB;

class MenuHeaderService
{
    private $menuHeaderRepository;

    public function __construct(
        MenuHeaderRepository $menuHeaderRepository
    )
    {
        $this->menuHeaderRepository = $menuHeaderRepository;
    }

    /**
     * @param null|int $perPage
     * @return GeneralResult
     */
    public function getAll($perPage = null): GeneralResult
    {
        $result = new GeneralResult();
        $result->setData($this->menuHeaderRepository->getAll($perPage));
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
            $data = $this->menuHeaderRepository->find($id);
            $result->setData($data);

            return $result;
        } catch (\Throwable $th) {
            $result->addError(new ErrorCollection($th->getCode(), $th->getMessage()));

            return $result;
        }
    }

    /**
     * @param \App\Http\Requests\MenuHeaderRequest $request
     *
     * @return \App\Results\GeneralResult
     */
    public function create(MenuHeaderRequest $request): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuHeaderRepository->create([
                'code' => $request->get('code'),
                'name' => $request->get('name'),
                'description' => $request->get('description'),
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
     * @param \App\Http\Requests\MenuHeaderRequest $request
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function update(MenuHeaderRequest $request, int $id): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuHeaderRepository->find($id);
            if (!$data) {
                $result->addError(new ErrorCollection(400, __('message.menu_header.id.not_found', [
                    'id' => $id
                ], 'id')));

                return $result;
            }

            $data->update($request->all());

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
     * @param \App\Http\Requests\MenuHeaderRequest $request
     * @param int $id
     *
     * @return \App\Results\GeneralResult
     */
    public function delete(int $id): GeneralResult
    {
        $result = new GeneralResult();

        DB::beginTransaction();
        try {
            $data = $this->menuHeaderRepository->find($id);
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
}
