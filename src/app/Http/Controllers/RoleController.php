<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\PostRequest;
use App\Http\Requests\Role\PutRequest;
use App\Models\Role;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use function response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            /** @var Role[]|Collection $roles */
            $roles = Role::with("user")->get();
            return response()->json(["roles" => $roles]);
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
            $role = new Role();
            $role->name = $request->name;
            $role->authority = $request->authority;
            $role->save();
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
     * @param  Role  $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        try {
            return response()->json(["role" => $role]);
        } catch (Exception $exception) {
            return response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return void
     */
    public function edit(Role $role)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PutRequest  $request
     * @param  Role  $role
     * @return JsonResponse
     */
    public function update(PutRequest $request, Role $role)
    {
        DB::beginTransaction();
        try {
            $role->name = $request->name;
            $role->update();
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
     * @param  Role  $role
     * @return JsonResponse
     */
    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return response()->json(["message" => "success"]);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(["error" => $exception->getMessage()]);
        }
    }
}
