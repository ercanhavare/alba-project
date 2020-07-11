<?php

namespace App\Http\Controllers;

use App\Http\Requests\Basket\PostRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PostRequest  $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        try {
            auth()->loginUsingId(1);
            $product = Product::findOrFail($request->product_id);
            Cart::add((int) $product->id, $product->name, (int) $product->price, (int) $request->quantity);
            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        try {

            $cartItem = Cart::add($product->id, $product->name, $product->price, $product->quantity);
            Cart::remove($cartItem->getUniqueId());

            return \response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }
}
