<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\PostRequest;
use App\Http\Requests\Product\PutRequest;
use App\Models\Product;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use function response;

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
            if ($products = Redis::get("products.all")) {
                return json_decode($products);
            }

            /** @var Product[]|Collection $products */
            $products = Product::with(["category", "user.role", "images"])->get();

            Redis::setex("products.all", 60 * 60, $products);

            return response()->json(["products" => $products]);
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
     * @throws AuthorizationException
     */
    public function store(PostRequest $request)
    {
        $this->authorize("create", Product::class);

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->code = $request->code;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->desc = $request->desc;
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;
            $product->save();

            /*foreach ($request->file("images") as $image) {
                $product->images()->save(new Image([
                    "name" => pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME),
                    "path" => Image::uploadImage($image),
                    "user_id" => Auth::user()->id,
                ]));
            }*/

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
     * @param  Product  $product
     * @return JsonResponse
     */
    public function show(Product $product)
    {
        try {
            return response()->json(["product" => $product]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return void
     */
    public function edit(Product $product)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  Product  $product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(PutRequest $request, Product $product)
    {
        $this->authorize("update", $product);

        DB::beginTransaction();
        try {
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->desc = $request->desc;
            $product->category_id = $request->category_id;
            $product->user_id = $request->user_id;
            $product->update();
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
     * @param  Product  $product
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Product $product)
    {
        $this->authorize("delete", $product);

        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
