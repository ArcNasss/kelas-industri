<?php

namespace App\Services;

use App\Models\User;
use App\Models\Salary;
use App\Services\SalaryService;
use App\Http\Requests\SalaryRequest;
use App\Repositories\SalaryRepository;
use App\Repositories\SchoolRepository;
use Illuminate\Support\Facades\Storage;

class SalaryService
{
    private SalaryRepository $repository;

    public function __construct(SalaryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * handle get all
     *
     * @param array|null $order
     * @return mixed
     */
    public function handleGetAll(array $order = null): mixed
    {
        return $this->repository->getAll($order);
    }

    /**
     * handle get mentor
     *
     * @return mixed
     */
    public function handleGetMentor() :mixed
    {
        return $this->repository->getMentor();
    }

    public function handleGetTeacher() :mixed
    {
        return $this->repository->getTeacher();
    }


    /**
     * handle get paginated
     *
     * @return mixed
     */
    public function handleGetPaginate(): mixed
    {
        return $this->repository->get_paginate(6);
    }

    /**
     * handle search
     *
     * @param string|null $search
     * @return mixed
     */
    public function handleSearch(string|null $search): mixed
    {
        return $this->repository->search_paginate($search, 6);
    }

    public function handleCount(){
        return $this->repository->getCount();
    }

    /**
     * store school year
     *
     * @param SalaryRequest $request
     * @return void
     */
    public function handleCreate(SalaryRequest $request): void
    {
        $data = $request->user_id;
        $data = $request->validated();
        $data['photo'] = $request->file('photo')->store('salary_file', 'public');

        $salary = $this->repository->store($data);
    }

    /**
     * update school year
     *
     * @param SalaryRequest $request
     * @param User $school
     * @return void
     */
    public function handleUpdate(SalaryRequest $request, Salary $salery): void
    {
        $data = $request->validated();
        if($request->hasFile('photo')){
            Storage::delete('public/' . $salery->photo);
            $data['photo'] = $request->file('photo')->store('salery_file', 'public');
        }
        $this->repository->update($salery->id, $data);
    }

    /**
     * handle delete school year
     *
     * @param Salary $school
     * @return bool
     */
    public function handleDelete(Salary $salery): bool
    {
        if($salery->photo){
            $delete = Storage::delete('public/' . $salery->photo);
        }
        return $this->repository->destroy($salery->id);
    }

    public function handleGetSalaryByUser(string $userId):mixed
    {
        return $this->repository->get_salary_by_user($userId);
    }
}
