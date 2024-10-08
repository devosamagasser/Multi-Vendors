<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\Categories\StoreCategoryRequest;
use App\Http\Requests\dashboard\Categories\UpdateCategoryRequest;
use App\Interfaces\Dashboard\CategoriesInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function __construct(CategoriesInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->interface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->interface->show($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return $this->interface->edit($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->interface->update($request,$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->interface->destroy($category);
    }


    public function trash()
    {
        return $this->interface->trash();
    }

    public function restore(Request $request, $category)
    {
        return $this->interface->restore($request,$category);
    }

    public function kill(Request $request, $category)
    {
        return $this->interface->kill($request,$category);
    }
}
