<?php

namespace App\Http\Controllers;

use App\Facades\UserService;
use App\Http\Requests\Auth\RegisterFormRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Traits\PaginationTrait;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $users = User::paginate($this->perPage);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterFormRequest $request): JsonResponse
    {
        User::create($request->toArray());

        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request , int $id): JsonResponse
    {
        $data = UserService::update($id , $request->except(['id' , 'roles']) , $request->roles);

        return response()->json($data['message'], $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $data = UserService::delete($id);

        return response()->json($data['message'] , $data['code']);
    }
}
