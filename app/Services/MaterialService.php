<?php

namespace App\Services;

use App\Http\Requests\MaterialRequest;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;

class MaterialService
{
    private MaterialRepository $repository;

    public function __construct(MaterialRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleByClassroom(string $classroomId){
        return $this->repository->get_by_classroom($classroomId, 6);
    }

    /**
     * handle get paginated
     *
     * @param int $schoolYearId
     * @return mixed
     */
    public function handleGetPaginate($request, int $schoolYearId): mixed
    {
        return $this->repository->get_paginate_by_school_year($request, $schoolYearId, 6);
    }

    public function handleSearch(Request $search,$year): mixed
    {
        return $this->repository->search_paginate($search->search,$year, 1);
    }   

    /**
     * handle store
     *
     * @param MaterialRequest $request
     * @return void
     */
    public function handleCreate(MaterialRequest $request): void
    {
        $this->repository->store($request->validated());
    }

    /**
     * handle update
     *
     * @param MaterialRequest $request
     * @param string $id
     * @return void
     */
    public function handleUpdate(MaterialRequest $request, string $id): void
    {
        $this->repository->update($id, $request->validated());
    }

    /**
     * handle delete
     *
     * @param string $id
     * @return bool
     */
    public function handleDelete(string $id): bool
    {
        return $this->repository->destroy($id);
    }
}
