<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubMaterialRequest;
use App\Models\Material;
use App\Models\SubMaterial;
use App\Services\SubMaterialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubMaterialController extends Controller
{
    private SubMaterialService $service;

    public function __construct(SubMaterialService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Material $material
     * @return View
     */
    public function create(Material $material): View
    {
        return view('dashboard.admin.pages.submaterial.create', compact('material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubMaterialRequest $request
     * @return RedirectResponse
     */
    public function store(SubMaterialRequest $request): RedirectResponse
    {
        $this->service->handleCreate($request);
        return to_route('admin.materials.show', $request->material_id)->with('success', trans('alert.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param SubMaterial $submaterial
     * @return View
     */
    public function show(SubMaterial $submaterial): View
    {
        $data = [
            'subMaterial'   => $submaterial
        ];
        return view('dashboard.admin.pages.submaterial.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Material $material
     * @param SubMaterial $subMaterial
     * @return View
     */
    public function edit(Material $material, SubMaterial $subMaterial): View
    {
        return view('dashboard.admin.pages.submaterial.edit', compact('subMaterial', 'material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubMaterialRequest $request
     * @param SubMaterial $submaterial
     * @return RedirectResponse
     */
    public function update(SubMaterialRequest $request, SubMaterial $submaterial): RedirectResponse
    {
        $this->service->handleUpdate($request, $submaterial->id);
        return to_route('admin.materials.show', $request->material_id)->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SubMaterial $submaterial
     * @return RedirectResponse
     */
    public function destroy(SubMaterial $submaterial): RedirectResponse
    {
        $data = $this->service->handleDelete($submaterial->id);

        if(!$data) return back()->with('error', trans('alert.delete_constrained'));

        return back()->with('success', trans('alert.delete_success'));
    }
}
