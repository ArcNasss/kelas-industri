<?php

namespace App\Services;

use App\Http\Requests\MentorRequest;
use App\Http\Requests\TeacherRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\YajraTable;
use Exception;

class UserServices
{
    use YajraTable;

    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * handle get all school
     *
     * @return mixed
     */
    public function handleGetAllSchool(): mixed
    {
        return $this->repository->get_schools();
    }

    /**
     * handle get all mentor
     *
     * @return mixed
     */
    public function handleGetAllMentor(): mixed
    {
        return $this->repository->get_mentors();
    }

    /**
     * handle get mentors
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function handleGetMentor(): mixed
    {
        return $this->MentorMockup($this->repository->get_mentors());
    }

    /**
     * store mentor
     *
     * @param MentorRequest $request
     * @return void
     */
    public function handleCreateMentor(MentorRequest $request): void
    {
        $data = $request->validated();
        $data['password'] = bcrypt('password');

        $user = $this->repository->store($data);
        $user->assignRole('mentor');
    }

    /**
     * update mentor
     *
     * @param MentorRequest $request
     * @param User $mentor
     * @return void
     */
    public function handleUpdateMentor(MentorRequest $request, User $mentor): void
    {
        $data = $request->validated();

        $this->repository->update($mentor->id, $data);
    }

    /**
     * handle delete mentor
     *
     * @param User $mentor
     * @return bool
     */
    public function handleDeleteMentor(User $mentor): bool
    {
        return $this->repository->destroy($mentor->id);
    }

    /**
     * handle get mentors
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function handleGetTeacher(): mixed
    {
        return $this->TeacherMockup($this->repository->get_mentors());
    }

    /**
     * store mentor
     *
     * @param TeacherRequest $request
     * @return void
     */
    public function handleCreateTeacher(TeacherRequest $request): void
    {
        $data = $request->validated();
        $data['password'] = bcrypt('password');

        $user = $this->repository->store($data);
        $user->assignRole('mentor');
    }

    /**
     * update mentor
     *
     * @param TeacherRequest $request
     * @param User $mentor
     * @return void
     */
    public function handleUpdateTeacher(TeacherRequest $request, User $mentor): void
    {
        $data = $request->validated();

        $this->repository->update($mentor->id, $data);
    }

    /**
     * handle delete mentor
     *
     * @param User $mentor
     * @return bool
     */
    public function handleDeleteTeacher(User $mentor): bool
    {
        return $this->repository->destroy($mentor->id);
    }
}
