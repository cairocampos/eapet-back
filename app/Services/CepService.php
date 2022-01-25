<?php

namespace App\Services;

use App\Exceptions\WarningException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CepService
{
    public static function buscaCep(string $cep)
    {
        $response =  Http::get("https://viacep.com.br/ws/{$cep}/json/");
        $data = $response->json();

        if(is_null($data))
            throw new WarningException('CEP inválido', Response::HTTP_UNPROCESSABLE_ENTITY);

        return $data;
    }
}
