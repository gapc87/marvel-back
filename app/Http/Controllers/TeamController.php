<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Team::class, 'team');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Team $team): JsonResponse
    {
        return response()->json([
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Team $team): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'sometimes|required|text',
            'description' => 'sometimes|required|text',
            'hero_1'      => 'sometimes|required|numeric',
            'hero_2'      => 'sometimes|required|numeric',
            'hero_3'      => 'sometimes|required|numeric',
            'hero_4'      => 'sometimes|required|numeric',
            'hero_5'      => 'sometimes|required|numeric',
            'hero_6'      => 'sometimes|required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $team->fill($validator->validated());

        return response()->json([
            'team' => $team
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Team $team): JsonResponse
    {
        $team->emptyRows();

        return response()->json([
            'team' => $team
        ]);
    }
}
