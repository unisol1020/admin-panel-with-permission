<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hostname\StoreRequest;
use App\Http\Requests\Hostname\UpdateRequest;
use App\Models\Hostname;
use App\Traits\PaginationTrait;
use Illuminate\Http\JsonResponse;

class HostnameController extends Controller
{
    use PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $hostnames = Hostname::paginate();

        return response()->json($hostnames);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        Hostname::create($request->all());

        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $hostname = Hostname::findOrFail($id);

        return response()->json($hostname);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request , int $id):  JsonResponse
    {
        $hostname = Hostname::findOrFail($id);
        $hostname->fill($request->except(['id']));
        $hostname->save();

        return response()->json([] , 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $hostname = Hostname::findOrFail($id);

        return response()->json($hostname->delete());
    }
}
