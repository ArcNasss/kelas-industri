<?php

namespace App\Services;

use App\Models\Journal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\SchoolYearHelper;
use App\Http\Requests\JournalRequest;
use App\Repositories\JournalRepository;
use Illuminate\Support\Facades\Storage;
use App\Repositories\GenerationRepository;

class JournalService
{
    private JournalRepository $repository;

    public function __construct(JournalRepository $journalRepository)
    {
        $this->repository = $journalRepository;
    }

    /**
     * handle get all
     *
     * @return mixed
     */
    public function handleGetAll(): mixed
    {
        return $this->repository->getAll();
    }

    public function handleGetJurnalByAdminAndSchool(string $classroomId): mixed
    {
        return $this->repository->get_journal_by_admin_and_school($classroomId);
    }

    public function handleGetJournalByUser($schoolYearId): mixed
    {
        return $this->repository->get_journal_by_user($schoolYearId);
    }

    public function handleGetBySchool(): mixed
    {
        return $this->repository->get_journal_by_school();
    }

    /**
     * handle get paginated
     *
     * @param int $schoolYearId
     * @return mixed
     */
    public function handleGetPaginate(int $schoolYearId): mixed
    {
        return $this->repository->get_paginate_by_school_year($schoolYearId, 8);
    }

    /**
     * store generation year
     *
     * @param JournalRequest $request
     * @return void
     */
    public function handleCreate(JournalRequest $request): void
    {
        if (auth()->user()->roles->pluck('name')[0] == 'mentor') {
            $data = $request->validated();
            $data['date'] = Carbon::now();
            $data['photo'] = $request->file('photo')->store('journal_file', 'public');
            $this->repository->store($data);
        } else if (auth()->user()->roles->pluck('name')[0] == 'teacher') {
            $data = $request->validated();
            $data['date'] = Carbon::now();
            $data['photo'] = $request->file('photo')->store('journal_file', 'public');
            $data['classroom_id'] = Auth()->user()->teacherSchool->teacherClassroom->classroom->id;
            $this->repository->store($data);
        }
    }

    /**
     * update generation year
     *
     * @param JournalRequest $request
     * @param int $id
     * @return void
     */
    public function handleUpdate(JournalRequest $request, Journal $journal): void
    {
        $data = $request->validated();
        if($request->hasFile('photo')){
            Storage::delete('public/' . $journal->photo);
            $data['photo'] = $request->file('photo')->store('journal_file', 'public');
        }
        $this->repository->update($journal->id, $data);
    }

    /**
     * handle delete generation year
     *
     * @param int $id
     * @return bool
     */
    public function handleDelete(Journal $journal): bool
    {
        Storage::delete('public/' . $journal->photo);
        return $this->repository->destroy($journal->id);
    }

    public function handleCountJournalTeacher(string $teacherId) :mixed
    {
        return $this->repository->get_count_journal_teacher($teacherId);
    }

    public function handleCountJournalMentor(string $mentorId) :mixed
    {
        return $this->repository->get_count_journal_mentor($mentorId);
    }
}
