<?php

namespace App\Services;

use App\Http\Requests\MaterialRequest;
use App\Repositories\MaterialExamRepository;

class MaterialExamService
{
    private $repository;

    public function __construct(MaterialExamRepository $repository)
    {
        $this->repository = $repository;
    }
    public function handleCreate(MaterialRequest $request, $material): mixed
    {
        $data = $request->validated();
        if ($data['total_essay'] == 0) {
            if ($data['essay_value'] != 0) {
                return redirect()->back()->with('error', 'Jika total essay nya 0, bobot nilai essay nya harus 0 juga');
            }
        }
        if ($data['multiple_choice_value'] + $data['essay_value'] != 100) {
            return redirect()->back()->with('error', 'Total bobot nilai harus 100');
        }
        $data = [
            'material_id' => $material['id'],
            'total_multiple_choice' => $data['total_multiple_choice'],
            'total_essay' => $data['total_essay'],
            'multiple_choice_value' => $data['multiple_choice_value'],
            'essay_value' => $data['essay_value'],
            'time' => $data['time'],
            'last_submit' => $data['last_submit'],
            'cheating_detector' => $data['cheating_detector'],
        ];
        return $this->repository->store($data);
    }
}
