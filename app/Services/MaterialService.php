<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Enums\QuestionTypeEnum;
use App\Http\Requests\MaterialRequest;
use App\Repositories\MaterialRepository;

class MaterialService
{
    private MaterialRepository $repository;

    public function __construct(MaterialRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleGetAll()
    {
        return $this->repository->getAll();
    }

    public function handleByClassroom(mixed $classroom, $request)
    {
        return $this->repository->get_by_classroom($classroom, $request->search ,6);
    }

    public function handleGetMaterialByDevision(string $devisionId)
    {
        return $this->repository->getByDevision($devisionId);
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
        return $this->repository->search_paginate($search->search,$search->generation_id,$search->filter, $year ,6);
    }

    /**
     * handle store
     *
     * @param MaterialRequest $request
     * @return void
     */
    public function handleCreate(MaterialRequest $request): mixed
    {
        $validate = $request->validated();
        $data = [
            'generation_id' => $validate['generation_id'],
            'title' => $validate['title'],
            'description' => $validate['description'],
            'devision_id' => $validate['devision_id'],
        ];
        return $this->repository->store($data);
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

    public function handleCountMaterialStudent(int $schoolYearId) : mixed
    {
        return $this->repository->get_count_material_student($schoolYearId);
    }

    public function handleCountMaterialUser()
    {
        return $this->repository->get_count_material_user();
    }

    public function handleCountMaterialAdmin()
    {
        return $this->repository->get_count_material_admin();
    }

    public function sortDailyExamQuestion(mixed $questionBank): mixed
    {
        return $questionBank->sortBy(function ($item) {
            return $item->subMaterialExamQuestions[0]->question_number;
        })->where('type', QuestionTypeEnum::MULTIPLECHOICE->value)->values()->all();
    }
}
