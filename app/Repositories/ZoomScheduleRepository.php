<?php

namespace App\Repositories;

use App\Models\ZoomSchedule;
use Illuminate\Support\Carbon;

class ZoomScheduleRepository extends BaseRepository
{
    public function __construct(ZoomSchedule $model)
    {
        $this->model = $model;
    }

    public function get_zoom_schedule_student()
    {
        $classroomId = Auth()->user()->studentSchool->studentClassroom->classroom->id;
            return $this->model->query()
            ->where('classroom_id', $classroomId)
            ->where('date', '>', Carbon::now())
            ->orderBy('date', 'desc')->first();
    }
}
