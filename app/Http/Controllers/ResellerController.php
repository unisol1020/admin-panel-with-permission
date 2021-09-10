<?php

namespace App\Http\Controllers;
use App\Http\Requests\Reseller\StoreRequest;
use App\Http\Requests\Reseller\UpdateRequest;
use App\Models\Reseller;
use App\Traits\PaginationTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ResellerHash\StoreRequest as ResellerHashStore;

class ResellerController extends Controller
{
    use PaginationTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $resellers = Reseller::paginate($this->perPage);

        return response()->json($resellers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        Reseller::create($request->all());

        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $reseller = Reseller::findOrFail($id);

        return response()->json($reseller);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request , int $id): JsonResponse
    {
        $reseller = Reseller::findOrFail($id);
        $reseller->fill($request->except(['id']));
        $reseller->save();

        return response()->json([] , 204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        $reseller = Reseller::findOrFail($id);

        return response()->json($reseller->delete());
    }

    public function getHashes(int $reseller_id): JsonResponse
    {
        $resellerHashes = Reseller::findOrFail($reseller_id)->reseller_hashes()->paginate($this->perPage);

        return response()->json($resellerHashes);
    }

    public function storeHash(ResellerHashStore $request , int $reseller_id): JsonResponse
    {
        Reseller::findOrFail($reseller_id)->reseller_hashes()->create($request->toArray());

        return response()->json(['message' => 'Created'], 201);
    }

    public function destroyHash(int $reseller_id , int $id): JsonResponse
    {
        $resellerHash = Reseller::findOrFail($reseller_id)->reseller_hashes()->findOrFail($id);

        return response()->json($resellerHash->delete());
    }
}
