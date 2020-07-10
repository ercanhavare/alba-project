<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\PostRequest;
use App\Http\Requests\Category\PutRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            /** @var Category[]|Collection $categories */
            $categories = Category::all();
            return response()->json(["categories" => $categories]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //return view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        try {
            return response()->json(["category" => $category]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category  $category
     * @return void
     */
    public function edit(Category $category)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  Category  $category
     * @return JsonResponse
     */
    public function update(PutRequest $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->name = $request->name;
            $category->update();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        DB::beginTransaction();
        try {
            $category->delete();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
