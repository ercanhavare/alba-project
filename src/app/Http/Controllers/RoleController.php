<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

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
            $roles = Role::all();
            return response()->json(["roles" => $roles]);
        } catch (\Exception $exception) {
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = new Role();
            /*
             *
             * */
            $role->save();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        try {
            return \response()->json(["role" => $role]);
        } catch (\Exception $exception) {
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return void
     */
    public function edit(Role $role)
    {
        //return view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        DB::beginTransaction();
        try {
            /*
             *
             * */
            $role->update();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role)
    {
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return \response()->json(["message" => "success"]);
        } catch (\Exception $exception) {
            DB::rollBack();
            return \response()->json(["error" => $exception->getMessage()]);
        }
    }
}
