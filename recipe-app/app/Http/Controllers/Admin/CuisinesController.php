<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuisine;
use App\Http\Requests\CuisineStoreRequest;


class CuisinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuisines = Cuisine::all();
        return view('admin.cuisines.index', compact('cuisines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cuisines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuisineStoreRequest $request)
    {
        Cuisine::create([
            'name' => $request->name,
        ]);
        return to_route('admin.cuisines.index')->with('success', 'Cuisine created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuisine $cuisine)
    {
        return view('admin.cuisines.edit', compact('cuisine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CuisineStoreRequest $request, Cuisine $cuisine)
    {
        $cuisine->update($request->validated());
        return to_route('admin.cuisines.index')->with('success', 'Cuisine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuisine $cuisine)
    {
        $cuisine->delete();
        return to_route('admin.cuisines.index')->with('danger', 'Cuisine daleted successfully.');
    }
}