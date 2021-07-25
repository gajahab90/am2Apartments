<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function index(CategoryRequest $request) {
        $per_page = $request->get("per_page", env("DEFAULT_PAGINATION_SIZE", 15));

        return CategoryResource::collection(Category::paginate($per_page))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request) {
        $validatedData = $request->validated();

        $category = Category::create($validatedData);

        return (new CategoryResource($category))->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id) {
        return (new CategoryResource(Category::findOrFail($id)))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, $id) {
        $validatedData = $request->validated();

        $category = Category::findOrFail($id);
        $category->update($validatedData);

        return (new CategoryResource($category))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
