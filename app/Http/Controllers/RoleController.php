<?php

namespace App\Http\Controllers;

use App\Facades\RoleService;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\Role;
use App\Traits\PaginationTrait;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    use PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $roles = Role::paginate($this->perPage);

        return response()->json($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        Role::create($request->all());

        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $data = RoleService::get($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request , int $id): JsonResponse
    {
        $data = RoleService::update($id , $request->except(['id' , 'permissions']) , $request->only('permissions')['permissions'] ?? null);

        return response()->json($data['message'] , $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $data = RoleService::delete($id);

        return response()->json($data['message'] , $data['code']);
    }
}
