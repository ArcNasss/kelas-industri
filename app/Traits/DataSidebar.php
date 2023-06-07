<?php

namespace App\Traits;

use App\Helpers\SchoolYearHelper;
use App\Models\Assignment;
use App\Models\Challenge;
use App\Models\Point;
use App\Models\ZoomSchedule;
use Carbon\Carbon;

trait DataSidebar
{
    function AssignmentMockup()
    {
        if(auth()->user()->roles->pluck('name')[0] == 'mentor' || auth()->user()->roles->pluck('name')[0] == 'teacher' || auth()->user()->roles->pluck('name')[0] == 'admin' || auth()->user()->roles->pluck('name')[0] == 'school'){
            return [];
        }
        $generationId = Auth()->user()->studentSchool->studentClassroom->classroom->generation_id;
        return Assignment::whereIn('sub_material_id', function ($query) use ($generationId) {
        $query->select('id')
            ->from('sub_materials')
            ->whereIn('material_id', function ($query) use ($generationId) {
                $query->select('id')
                    ->from('materials')
                    ->whereIn('generation_id', function ($query) use ($generationId) {
                        $query->select('id')
                            ->from('generations')
                            ->where('id', $generationId);
                    });
            });
        })->orderBy('end_date','desc')->take(5)->get();
    }

    function RankMockup()
    {
        $currentSchoolYear = SchoolYearHelper::get_current_school_year();
        return Point::whereHas('student.studentSchool.studentClassroom.classroom.generation.schoolYear', function ($query) use ($currentSchoolYear) {
            $query->where('id', $currentSchoolYear->id);
        })
        ->groupBy('student_id')
        ->selectRaw('student_id, sum(point) as point')
        ->orderBy('point','desc')
        ->get();
    }

    function ChallengeMockup()
    {
        if(auth()->user()->roles->pluck('name')[0] == 'mentor' || auth()->user()->roles->pluck('name')[0] == 'teacher' || auth()->user()->roles->pluck('name')[0] == 'admin' || auth()->user()->roles->pluck('name')[0] == 'school'){
            return [];
        }
        $classroomId = Auth()->user()->studentSchool->studentClassroom->classroom->id;
        return Challenge::where('classroom_id',$classroomId)->orderBy('end_date','desc')->take(5)->get();
    }

    function ScheduleMockup()
    {
        if(auth()->user()->roles->pluck('name')[0] == 'mentor'){
            return ZoomSchedule::where('mentor_id',Auth()->id())->where('date', '>',Carbon::now())->orderBy('date','desc')->take(5)->get();
        }else if(auth()->user()->roles->pluck('name')[0] == 'student'){
            $classroomId = Auth()->user()->studentSchool->studentClassroom->classroom->id;
            return ZoomSchedule::where('classroom_id',$classroomId)->where('date','>',Carbon::now())->orderBy('date','desc')->take(5)->get();
        }else if(auth()->user()->roles->pluck('name')[0] == 'teacher'){
            $classroomId = Auth()->user()->teacherSchool->teacherClassrooms->pluck('classroom_id')->toArray();
            return ZoomSchedule::whereIn('classroom_id',$classroomId)->where('date','>',Carbon::now())->orderBy('date','desc')->take(5)->get();
        }
    }

    function GetDataSidebar()
    {
        $data = [
            'SidebarRank' => $this->RankMockup(),
            'SidebarSchedule' => $this->ScheduleMockup(),
            'SidebarAssignment' => $this->AssignmentMockup(),
            'SidebarChallenge' => $this->ChallengeMockup(),
        ];
        return $data;
    }
}
