<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

if(!function_exists('error_exception')) {
    function error_exception(\Exception $e) {
        $code = preg_replace('/\D/', '', $e->getCode());
        $code = $code != 0 ? $code : 500;

        return response()->json([
            'message' => 'Algo de inesperado aconteceu. Tente novamente mais tarde!',
            'error' => $e->getMessage()
        ], intval($code));
    }
}

if(!function_exists('notfound_exception')) {
    function notfound_exception(\Exception $e) {
        return response()->json([
            'message' => 'Não encontrado',
        ], Response::HTTP_NOT_FOUND);
    }
}

if(!function_exists('makeException')) {
    function makeException(\Exception $e) {
        throw $e;
    }
}

if(!function_exists('toObject')) {
    function toObject(array $data) {
        return json_decode(json_encode($data, true));
    }
}

if(!function_exists('estadosBrasileiros')) {
    function estadosBrasileiros($sigla = null) {
        $estadosBrasileiros = array(
            'AC'=>'Acre',
            'AL'=>'Alagoas',
            'AP'=>'Amapá',
            'AM'=>'Amazonas',
            'BA'=>'Bahia',
            'CE'=>'Ceará',
            'DF'=>'Distrito Federal',
            'ES'=>'Espírito Santo',
            'GO'=>'Goiás',
            'MA'=>'Maranhão',
            'MT'=>'Mato Grosso',
            'MS'=>'Mato Grosso do Sul',
            'MG'=>'Minas Gerais',
            'PA'=>'Pará',
            'PB'=>'Paraíba',
            'PR'=>'Paraná',
            'PE'=>'Pernambuco',
            'PI'=>'Piauí',
            'RJ'=>'Rio de Janeiro',
            'RN'=>'Rio Grande do Norte',
            'RS'=>'Rio Grande do Sul',
            'RO'=>'Rondônia',
            'RR'=>'Roraima',
            'SC'=>'Santa Catarina',
            'SP'=>'São Paulo',
            'SE'=>'Sergipe',
            'TO'=>'Tocantins'
        );

        if($sigla && isset($estadosBrasileiros[$sigla])) {
            return $estadosBrasileiros[$sigla];
        }

        return $estadosBrasileiros;
    }
}


function apenasNumeros($value) {
    return preg_replace('/\D/', '', $value);
}

function formataCep($cep) {
    return preg_replace("/^([0-9]{5})([0-9]{3})$/", "$1-$2", $cep);
}

function formataCpf($cpf) {
    return preg_replace("/^([0-9]{3})([0-9]{3})([0-9]{3})([0-9]{2})$/", "$1.$2.$3-$4", $cpf);
}

/**
 * Trasnforma um valor em reais para um valor float.
 *
 * @param string $string
 * @return int
 */
function realToFloat($string, $multiply = 1)
{
    // preg_replace('/(\d+),(\d{2})[^.]/', '$1.$2', $string);

    $string = preg_replace('/[^0-9,]/', '', $string);

    return (float) preg_replace('/,/', '.', $string) * $multiply;
}


function storageDisk() {
    return \Illuminate\Support\Facades\App::environment() == 'local' ? 'local' : 'local';
}

function tirarAcentos($string){
    if(!$string) return  '';

    return preg_replace([
        "/(á|à|ã|â|ä)/",
        "/(Á|À|Ã|Â|Ä)/",
        "/(é|è|ê|ë)/",
        "/(É|È|Ê|Ë)/",
        "/(í|ì|î|ï)/",
        "/(Í|Ì|Î|Ï)/",
        "/(ó|ò|õ|ô|ö)/",
        "/(Ó|Ò|Õ|Ô|Ö)/",
        "/(ú|ù|û|ü)/",
        "/(Ú|Ù|Û|Ü)/",
        "/(ñ)/",
        "/(Ñ)/",
        "/(ç)/",
        "/(Ç)/"
    ]
    ,explode(" ","a A e E i I o O u U n N c C"),
    $string);
}

function sanitizeString($value) {
    $value = tirarAcentos($value);
    $value = trim($value);
    return ucwords($value);
}
