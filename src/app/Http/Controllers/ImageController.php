<?php

namespace App\Http\Controllers;

use App\Http\Requests\Image\PostRequest;
use App\Http\Requests\Image\PutRequest;
use App\Models\Image;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function response;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            /** @var Image[]|Collection $images */
            $images = Image::all();
            return response()->json(["images" => $images]);
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
            $image = new Image();
            $image->name = $request->name;
            $image->path = $request->path;
            $image->product = $request->product_id;
            $image->save();
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
     * @param  Image  $image
     * @return JsonResponse
     */
    public function show(Image $image)
    {
        try {
            return response()->json(["image" => $image]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Image  $image
     * @return void
     */
    public function edit(Image $image)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  Image  $image
     * @return JsonResponse
     */
    public function update(PutRequest $request, Image $image)
    {
        DB::beginTransaction();
        try {
            $image->name = $request->name;
            $image->path = $request->path;
            $image->product_id = $request->product_id;
            $image->update();
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
     * @param  Image  $image
     * @return JsonResponse
     */
    public function destroy(Image $image)
    {
        DB::beginTransaction();
        try {
            $image->delete();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
