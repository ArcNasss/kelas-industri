<?php

namespace App\Services;

use App\Repositories\PointRepository;
use Illuminate\Http\Request;

class PointService
{
    private PointRepository $repository;

    public function __construct(PointRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handleGetPointStudent(){
        return $this->repository->get_point_stundet();
    }

}
