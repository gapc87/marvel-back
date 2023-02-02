<?php

namespace Helpers\Marvel;


/**
 * Datos necesarios para hacer llamada a la API de Marvel
 * 
 * @param string $ts
 * @param string $publicKey
 * 
 * @return array
 */
function mMd5(string $ts, string $publicKey): array {
    $privateKey = env('MARVEL_PRIVATE_KEY');
    $has        = md5($ts . $privateKey . $publicKey);

    return [
        'ts'        => $ts,
        'publicKey' => $publicKey,
        'hash'      => $has
    ];
}
