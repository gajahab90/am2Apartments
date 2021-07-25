<?php

namespace App\Http\Controllers;

use App\Rating;
use Auth;
use Illuminate\Http\Request;

class RatingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'rating' => 'required|numeric|gte:1|lte:5'
        ]);

        Rating::firstOrCreate([
                'user_id' =>  Auth::guard('api')->id(),
                'apartment_id' => $validatedData['apartment_id'],
            ],
            ['rating' => $validatedData['rating']]
        );

        return response()->json(['message' => 'Thanks for rating!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
