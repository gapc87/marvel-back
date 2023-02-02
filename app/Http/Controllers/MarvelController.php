<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Helpers\Marvel\mMd5;

class MarvelController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        $ts         = (string) $request->ts;
        $publicKey  = (string) $request->publicKey;

        $data       = mMd5($ts, $publicKey);

        return response()->json( $data );
    }
}
