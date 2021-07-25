<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Http\Requests\ApartmentRequest;
use App\Http\Resources\ApartmentResource;
use App\Search\SearchHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ApartmentRequest $request
     * @return JsonResponse
     */
    public function index(ApartmentRequest $request) {
        $per_page = $request->get("per_page", env("DEFAULT_PAGINATION_SIZE", 15));

        return ApartmentResource::collection(Apartment::paginate($per_page))->response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApartmentRequest $request
     * @return JsonResponse
     */
    public function store(ApartmentRequest $request) {
        $validatedData = $request->validated();

        $apartment = Apartment::create($validatedData);

        return (new ApartmentResource($apartment))->response();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id) {
        return (new ApartmentResource(Apartment::findOrFail($id)))->response();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ApartmentRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ApartmentRequest $request, $id) {
        $validatedData = $request->validated();

        $apartment = Apartment::findOrFail($id);
        $apartment->update($validatedData);

        return (new ApartmentResource($apartment))->response();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id) {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return response()->json(null, 204);
    }

    /**
     * Search the specified resource in storage.
     *
     * @param ApartmentRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function search(ApartmentRequest $request) {
        $validatedData = $request->validated();
        $per_page = $request->get("per_page", env("DEFAULT_PAGINATION_SIZE", 15));
        $apartmentQuery = Apartment::query();

        if(isset($validatedData['price']) &&
            isset($validatedData['currency']) &&
            strtoupper($validatedData['currency']) != env('DEFAULT_CURRENCY', 'EUR')) {
            $validatedData['price']['value'] = convert_currency($validatedData['price']['value'], $validatedData['currency'], env('DEFAULT_CURRENCY', 'EUR'));
            $validatedData['currency'] = env('DEFAULT_CURRENCY', 'EUR');
        }

        return ApartmentResource::collection(
            SearchHelper::searchAndSort($validatedData, $apartmentQuery, Apartment::$APARTMENT_HTTP_PARAMS_DB_COLUMNS_MAP, $per_page, 'apartments'))
            ->response();
    }
}
