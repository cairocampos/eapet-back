<?php

namespace App\Services;

use App\Models\Specie;
use App\Services\Providers\HttpStatus;

class SpecieService
{
    public function index()
    {
        return Specie::paginate();
    }

    public function show($id)
    {
        return Specie::findOrFail($id);
    }

    public function store(array $params)
    {
        $specie = Specie::create($params);
        return response()->json(['data' => $specie], HttpStatus::HTTP_CREATED);
    }

    public function update(array $params, $id)
    {
        $specie = Specie::findOrFail($id);
        $specie->fill($params);
        $specie->save();

        return [
            'data' => $specie
        ];
    }

    public function destroy($id)
    {
        $specie = Specie::findOrFail($id);
        $specie->delete();

        return response()->json([], HttpStatus::HTTP_NO_CONTENT);
    }
}
