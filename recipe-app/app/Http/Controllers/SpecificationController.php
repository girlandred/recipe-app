<?php

namespace App\Http\Controllers;

use App\Models\Specification;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreSpecificationRequest;
use App\Http\Requests\UpdateSpecificationRequest;

class SpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('admin.specifications.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('admin.specifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecificationRequest $request): RedirectResponse
    {
        $specification = Specification::create($request->validated());

        return redirect($specification->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Specification $specification): View
    {
        return view('admin.specifications.show', compact('specification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Specification $specification): View
    {
        return view('admin.specifications.edit', compact('specification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecificationRequest $request, Specification $specification): RedirectResponse
    {
        $specification->update($request->validated());

        return redirect($specification->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specification $specification): RedirectResponse
    {
        $specification->delete();

        return redirect()->route('admin.specifications.index');
    }
}
