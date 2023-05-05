<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Classroom;
use Illuminate\View\View;
use App\Models\SubMaterial;
use App\Services\StudentService;
use App\Services\MaterialService;
use App\Services\ClassroomService;
use App\Services\SubMaterialService;

class StudentClassroomController extends Controller
{
    private ClassroomService $classroomService;
    private StudentService $studentService;
    private MaterialService $materialService;
    private SubMaterialService $subMaterialService;

    public function __construct(ClassroomService $classroomService, StudentService $studentService, MaterialService $materialService, SubMaterialService $subMaterialService)
    {
        $this->classroomService = $classroomService;
        $this->studentService = $studentService;
        $this->materialService = $materialService;
        $this->subMaterialService = $subMaterialService;

    }

    public function index(): View
    {
        $data = [
            'classrooms' => $this->classroomService->handleGetClassroomByStudent(auth()->id()),
        ];
        return view('dashboard.user.pages.classroom.index', $data);
    }

    public function show(Classroom $classroom): View
    {
        $data = [
            'classroom' => $classroom,
            'students' => $this->studentService->handleGetBySchool(auth()->id())
        ];
//        dd($data);
        return \view('dashboard.user.pages.classroom.detail', $data);
    }

    public function materials(Classroom $classroom) :View
    {
        $data = [
            'materials' => $this->materialService->handleByClassroom($classroom->id)
        ];

        return \view('dashboard.user.pages.material.index', $data);
    }

    public function showMaterial(Material $material): View
    {
        $data = [
            'material'  => $material,
            'subMaterials' => $this->subMaterialService->handleGetPaginate($material->id),
            'parameters' => [
                'material'  => $material->id
            ]
        ];
        return view('dashboard.user.pages.submaterial.index', $data);
    }

    public function showSubMaterial(SubMaterial $submaterial): View
    {
        $data = [
            'subMaterial' => $submaterial
        ];
        return view('dashboard.user.pages.submaterial.detail', $data);
    }

    public function showDocument(SubMaterial $submaterial, string $role): View
    {
        return view('dashboard.user.pages.submaterial.view', compact('submaterial', 'role'));
    }
}
