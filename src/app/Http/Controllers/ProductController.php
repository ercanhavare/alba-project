<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\PostRequest;
use App\Http\Requests\Product\PutRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $products = Product::all();
            return response()->json(["products" => $products]);
        } catch (Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
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
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            $product = new Product();
            /*
             *
             * */
            $product->save();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        try {
            return \response()->json(["product" => $product]);
        } catch (Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PutRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(PutRequest $request, Product $product)
    {
        DB::beginTransaction();
        try {
            /*
             *
             *
             * */
            $product->update();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }
}
