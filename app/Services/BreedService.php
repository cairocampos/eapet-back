<?php

namespace App\Services;

use App\Models\Breed;
use App\Services\Providers\HttpStatus;

class BreedService
{
    public function index()
    {
        return Breed::paginate();
    }

    public function show($id)
    {
        return Breed::findOrFail($id);
    }

    public function store(array $params)
    {
        $breed = Breed::create($params);
        return response()->json(['data' => $breed], HttpStatus::HTTP_CREATED);
    }

    public function update(array $params, $id)
    {
        $breed = Breed::findOrFail($id);
        $breed->fill($params);
        $breed->save();

        return [
            'data' => $breed
        ];
    }

    public function destroy($id)
    {
        $breed = Breed::findOrFail($id);
        $breed->delete();

        return response()->json([], HttpStatus::HTTP_NO_CONTENT);
    }
}
