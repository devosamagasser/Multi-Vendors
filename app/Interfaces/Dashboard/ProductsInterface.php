<?php

namespace App\Interfaces\Dashboard;

interface ProductsInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index();

    /**
     * Show the form for creating a new resource.
     */
    public function create();

    /**
     * Store a newly created resource in storage.
     */
    public function store($request);

    /**
     * Display the specified resource.
     */
    public function show($category);

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category);

    /**
     * Update the specified resource in storage.
     */
    public function update($request, $category);

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category);

    public function trash();

    public function restore($request, $category);

    public function kill($request, $category);
}
