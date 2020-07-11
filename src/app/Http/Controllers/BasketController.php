<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\PostRequest;
use App\Http\Requests\Basket\PutRequest;
use App\Models\Basket;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            /** @var Basket $baskets */
            $baskets = Basket::query()->where("user_id", "=", auth()->user()->id)->get();
            return \response()->json(["baskets" => $baskets]);
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
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        DB::beginTransaction();
        try {
            /** @var Product $product */
            $product = Product::query()->findOrFail($request->product_id);

            /** @var Basket $is_available_product */
            $is_available_product = Basket::query()->where("product_id", "=", $product->id)
                ->where("user_id", "=", auth()->user()->id)->first();

            if (isset($is_available_product)) {

                $is_available_product->quantity += 1;
                $is_available_product->price += $product->price;
                $is_available_product->update();
                DB::commit();
                return response()->json(["message" => "update success"]);
            }

            $basket = new Basket();
            $basket->product_id = $request->product_id;
            $basket->price = $product->price;
            $basket->quantity = $request->quantity;
            $basket->user_id = auth()->user()->id;
            $basket->save();
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
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        //return view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(PutRequest $request, $id)
    {
        try {
            /** @var Product $product */
            $product = Product::query()->findOrFail($request->product_id);

            /** @var Basket $is_available_product */
            $is_available_product = Basket::query()->where("product_id", "=", $product->id)
                ->where("user_id", "=", auth()->user()->id)->first();

            if (empty($is_available_product)) {
                return response()->json(["message" => "basket is empty"]);
            }

            $is_available_product->quantity -= 1;
            if ($is_available_product->quantity <= 0) {
                $is_available_product->delete();
                DB::commit();
                return response()->json(["message" => "basket is empty"]);
            }
            $is_available_product->price -= $product->price;
            $is_available_product->update();
            DB::commit();
            return response()->json(["message" => "update success"]);

        } catch (Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Basket::query()->where("product_id", "=", $id)
                ->where("user_id", "=", auth()->user()->id)->delete();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }
}
