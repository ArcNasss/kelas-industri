<?php

namespace App\Services;

use App\Http\Requests\PresentationRequest;
use App\Repositories\PresentationRepository;
use GuzzleHttp\Psr7\Request;
use PhpParser\Node\Expr\Cast\String_;

class PresentationService
{
    private PresentationRepository $repository;

    public function __construct(PresentationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * handleGetByProject
     *
     * @param  mixed $projectId
     * @return mixed
     */
    public function handleGetByProject(string $projectId): mixed
    {
        return $this->repository->getByProject($projectId);
    }

    /**
     * handleGetByProjectApproved
     *
     * @param  mixed $projectId
     * @return mixed
     */
    public function handleGetByProjectApproved(string $projectId): mixed
    {
        return $this->repository->getByProjectApproved($projectId);
    }

    /**
     * handleCreate
     *
     * @param  mixed $request
     * @return mixed
     */
    public function handleCreate(PresentationRequest $request): mixed
    {
        $data = $request->validated();

        return $this->repository->store([
            'name' => $data['name'],
            'description' => $data['description'],
            'date' => $data['date'],
            'project_id' => $data['project_id'],
            'presentation_status' => $data['presentation_status'],
        ]);
    }

    public function handleApprovalPresentation(String $presentationId): mixed
    {
        return $this->repository->approvalPresentation($presentationId);
    }
    public function handleRejectPresentation(String $presentationId, mixed $pendingDate): mixed
    {
        return $this->repository->rejectPresentation($presentationId, $pendingDate);
    }

    public function getNearestPresentation(mixed $mentor): mixed {
        return $this->repository->getNearestPresentation($mentor);
    }
}
