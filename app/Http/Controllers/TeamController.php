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
        //$this->authorizeResource(Team::class, 'team');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'team' => auth()->user()->team,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $field): JsonResponse
    {
        $validator = Validator::make($request['team'], [
            $field => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $team = auth()->user()->team;
        $team->fill($validator->validated())->save();

        return response()->json([
            $field => $team[$field],
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
            'team' => $team,
        ]);
    }

    /**
     * Get hero
     * 
     * @param int $id
     * @return JsonResponse
     */
    public function getHero(string $field): JsonResponse
    {
        return response()->json([
            'hero' => auth()->user()->team[$field],
        ]);
    }

    /**
     * Delete hero
     * 
     * @param string $hero
     * @return JsonResponse
     */
    public function deleteHero(string $hero): JsonResponse
    {
        $team = auth()->user()->team;
        $team->$hero = null;
        $team->save();

        return response()->json([
            'team' => $team,
        ]);
    }
}
